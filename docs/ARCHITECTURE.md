## vtiger CRM - Architecture and Request Lifecycle

This document explains the core structure of this vtiger CRM codebase, including the main entry points, HTTP request lifecycle, routing to modules, database layer, templating, security, and auxiliary subsystems (Mobile, Webservices, Customer Portal, Cron).

### Overview
- Entry point: `index.php`
- Core runtime: `includes/runtime/*`
- Web UI orchestration: `includes/main/WebUI.php`
- HTTP request wrapper: `includes/http/Request.php`
- Modules (MVC-style): `modules/<Module>/{views,actions,models}/*.php`
- Templates/themes: `layouts/v7` and `layouts/vlayout`
- Database abstraction: `include/database/PearDatabase.php` using ADOdb
- Configuration: `config.inc.php` (+ overrides/templates)
- Security helpers: `vtlib_purify`, CSRF Magic, referer & POST checks
- Other entry points: `webservice.php`, `modules/Mobile/index.php`, `modules/CustomerPortal/api.php`, `vtigercron.php`

---

## Bootstrapping and Entry Points

### index.php (main web entry)
1. Requires Composer autoload and base `config.php`.
2. Includes `includes/main/WebUI.php` and constructs `Vtiger_WebUI`.
3. Wraps globals (`$_REQUEST`) into a `Vtiger_Request` and calls `$webUI->process($request)`.

Key responsibilities:
- Ensure dependencies loaded.
- Delegate to `Vtiger_WebUI` for lifecycle handling.

### Auxiliary entry points
- `webservice.php`: SOAP/REST-like webservice endpoint using `include/Webservices/*`.
- `modules/Mobile/index.php`: Mobile HTML app entry with its own session handling and viewer.
- `modules/CustomerPortal/api.php`: Customer Portal API entry that dispatches by `operation`.
- `vtigercron.php` and `cron/*`: CLI/daemon cron tasks.

---

## Request Lifecycle (Vtiger_WebUI)
Location: `includes/main/WebUI.php`

High-level flow in `Vtiger_WebUI->process(Vtiger_Request $request)`:
1. Load utilities and runtime EntryPoint (`includes.runtime.EntryPoint`).
2. Resolve current user session and set global `current_user`.
3. Enforce host/protocol consistency against `$site_URL`.
4. Load language packs for app and current module.
5. If app not installed, redirect to installer.
6. If `module` is missing:
   - For authenticated users: route to default landing module/view (e.g., `Home/DashBoard` or module list).
   - For guests: route to `Users` module `Login` view.
7. Determine component type:
   - `action` param present ➔ `Action` handler
   - otherwise ➔ `View` handler (default `Index`)
8. Resolve handler class: `Vtiger_Loader::getComponentClassName($type, $name, $qualifiedModuleName)`.
9. Instantiate handler, call `validateRequest($request)`.
10. If `loginRequired()`, run `checkLogin($request)`; redirect if not authenticated.
11. Run `triggerPreProcess`, handler `process($request)`, and `triggerPostProcess`.
12. If handler returns a `Vtiger_Response`, emit via `$response->emit()`.

Notes:
- `Vtiger_EntryPoint` base class provides session/login plumbing.
- Some special-case redirects exist (e.g., Reports heavy views, dashboards, not-permitted modules in list view).

---

## HTTP Request Normalization (Vtiger_Request)
Location: `includes/http/Request.php`

Purpose:
- Wrap incoming `$_REQUEST` and optionally a separate raw map.
- Normalize magic quotes, optionally decode JSON strings safely.
- Purify all scalar values via `vtlib_purify` before returning.
- Provide helpers: `getBoolean`, `getForSql`, `getAllPurified`, `getReturnURL`, `setViewerReturnValues`.
- Enforce security on write operations via `validateWriteAccess()` which requires POST and CSRF token.
- Referer validation (for authenticated users): referer must start with `$site_URL` (except `Install`).

Important methods:
- `get($key, $default='')`: decode JSON when value starts with `[` or `{`, then purify.
- `getForSql($key, $skipEmpty=true)`: validate safe-for-SQL string via `Vtiger_Util_Helper::validateStringForSql`.
- `validateWriteAccess($skipRequestTypeCheck=false)`: ensures request method is POST (unless skipped), then referer and CSRF checks.
- `isAjax()`: detects common AJAX headers.

Security implications:
- Any action that mutates state should call `validateWriteAccess()` (directly or via handler validation) to ensure CSRF and method checks.

---

## Routing and MVC Modules

### Module structure
- Directory: `modules/<Module>/`
- Views: `modules/<Module>/views/*.php` (e.g., `Index.php`, `List.php`, `Detail.php`, `Edit.php`)
- Actions: `modules/<Module>/actions/*.php` (e.g., `Save.php`, `MassDelete.php`)
- Models/Helpers: `modules/<Module>/*.php` or `modules/<Module>/models/*.php`

### Handler resolution
- From `module` and `view`/`action` parameters, `Vtiger_Loader::getComponentClassName($type, $name, $qualifiedModuleName)` constructs the class name and file path.
- Handler lifecycle:
  - `validateRequest($request)` (sanity/security)
  - `loginRequired()` (boolean)
  - `process($request)` returns either rendered HTML via a viewer or a `Vtiger_Response` (JSON, file, etc.).

### Qualified modules
- Settings pages often use qualified module names like `Settings:Users`.
- `Vtiger_Request->getModule(false)` returns parent-qualified name when `parent` param is present.

---

## Views, Templates, and Assets

- Themes: `layouts/v7` (modern) and `layouts/vlayout` (legacy)
- Templates: `.tpl` files organized by module and view.
- Client assets: JS/CSS live in the same layout tree and global `resources/` and `libraries/`.
- Server-side rendering typically uses a `Vtiger_Viewer` to assign variables and render a template.

---

## Database Layer

### Configuration
- Main config file: `config.inc.php`
  - `$dbconfig['db_*']` for host, port, user, password, database name, driver (`mysqli` default)
  - `$site_URL`, `$root_directory`, and cache/upload directories
  - Optional overrides: `config_override.php`, performance/security configs

### Connection & Queries
- Class: `include/database/PearDatabase.php`
- Uses ADOdb: `ADONewConnection($dbType)`; persistent connect `PConnect(...)`.
- On successful connect, enables SQL logging based on configuration.
- Ensures UTF-8 via `SET NAMES UTF8` when flagged.
- Provides query helpers, fetchers, and general DB utilities used throughout the app.

### Data Model Layer
- Many modules rely on `data/CRMEntity.php` as a base model for CRUD operations, field metadata, and event hooks.
- `VTEntityDelta`, `Tracker` provide change tracking and audit utilities.

---

## Security

- Input sanitization: `vtlib_purify` (called by `Vtiger_Request->get`).
- CSRF protection: `libraries/csrf-magic/csrf-magic.php` loaded by `WebUI`; enforced via `csrf_check()`.
- Referer check: ensures requests originate from `$site_URL` for authenticated sessions (except during install).
- Method checks: write operations expected to be `POST`.
- Session management: uses PHP sessions and, in some flows, `HTTP_Session`/`HTTP_Session2`.

Best practices when adding handlers:
- Use `validateRequest()` and call `$request->validateWriteAccess()` for mutating actions.
- Avoid directly reading from `$_REQUEST`; prefer `Vtiger_Request` accessors.
- Use `getForSql()` or parameterized queries through DB layer.

---

## Internationalization (i18n)

- App language files: `languages/<locale>/*.php`
- Module strings loaded based on current user language and current module in `WebUI->process`.
- Vietnamese resources present under `languages/vi_vn/`.

---

## Mobile, Webservices, Customer Portal

### Mobile (`modules/Mobile/index.php`)
- Parses `module` and `view` from request.
- Manages its own session (via `Mobile_API_Session`).
- Uses a simple `Mobile_HTML_Viewer` to render output.
- Redirects unauthenticated users to `Users/Login`.

### Webservices (`webservice.php` and `include/Webservices/*`)
- Provides programmatic access for integrations.
- Implements metadata discovery, CRUD, query, and relation APIs.

### Customer Portal (`modules/CustomerPortal/api.php`)
- Dispatches based on `operation` parameter to `apis/<operation>.php` classes.
- The controller layer authenticates and sets the active user language before processing.

---

## Cron and Background Jobs

- Entrypoint: `vtigercron.php`
- Scripts and service wrappers: `cron/`
- Provides scheduled task execution for workflows, mailers, and maintenance.

---

## File & Directory Highlights

- `index.php`: main entry
- `includes/main/WebUI.php`: request lifecycle and routing
- `includes/http/Request.php`: input wrapper and security checks
- `include/database/PearDatabase.php`: DB adapter via ADOdb
- `data/CRMEntity.php`: core entity base class
- `layouts/v7`, `layouts/vlayout`: templates and assets
- `languages/*`: localization
- `modules/*`: module MVC implementations
- `webservice.php`, `modules/Mobile/index.php`, `modules/CustomerPortal/api.php`: alt entry points
- `vtigercron.php`, `cron/*`: scheduled jobs

---

## Adding a New View/Action (Quick Guide)

1. Choose target module directory: `modules/<Module>/`.
2. Create a View handler (read-only page): `modules/<Module>/views/MyView.php` with a class `MyView_View` or `Vtiger_View`-derived naming per loader conventions.
3. Or create an Action handler (state-changing): `modules/<Module>/actions/MyAction.php` with proper validation and `loginRequired()`.
4. In handler `process($request)`, fetch inputs via `$request->get()`; for mutations call `$request->validateWriteAccess()`.
5. Render with a `Vtiger_Viewer` and corresponding template under `layouts/<theme>/modules/<Module>/MyView.tpl`.
6. Access via URL: `index.php?module=<Module>&view=MyView` or `&action=MyAction`.

---

## Configuration and Deployment Notes

- Ensure `vendor/autoload.php` exists (`composer install`).
- Configure `config.inc.php`: database credentials, `$site_URL`, `$root_directory`.
- Set correct permissions for `cache/` and `logs/` directories for uploads and compiled templates.
- Verify PHP extensions required by ADOdb, GD (for PDFs/images), and others from `libraries/`.

---

## Troubleshooting Tips

- White page on load: check `vendor/autoload.php` and PHP error logs.
- Login redirect loop: verify session storage and `$site_URL` host/protocol.
- CSRF errors on form submit: ensure forms include CSRF token and use POST.
- DB connection errors: confirm `config.inc.php` credentials and MySQL accessibility; check `include/database/PearDatabase.php` logs.
- Missing translations: verify locale files under `languages/<locale>/` and module strings loading in `WebUI`.

---

## Glossary

- Handler: A class that implements a View or Action for a module.
- Qualified Module: A module name with a parent prefix, e.g., `Settings:Users`.
- Viewer: Server-side renderer that feeds data to a Smarty/Smarty-like `.tpl` template.
- CRMEntity: Abstracts CRUD and metadata for records across modules.


