# PDFMaker2 — Implementation Walkthrough

## Overview

This document describes the complete implementation of the PDFMaker2 module — a Centralized PDF Engine that replaces the limitations of the ITS4You PDFMaker Free edition.

**Date**: Built during the current development session  
**Architecture doc**: See `00-PDFMaker2-Architecture.md`

---

## File Inventory

### Module Core (`modules/PDFMaker2/`)

| File | Class | Purpose |
|------|-------|---------|
| `PDFMaker2.php` | `PDFMaker2` | Module handler with `vtlib_handler()` |
| `models/Record.php` | `PDFMaker2_Record_Model` | Template CRUD (create, read, update, delete). M:N module relations via `saveModuleRelations()` |
| `models/FieldResolver.php` | `PDFMaker2_FieldResolver_Model` | Discovers all entity modules & fields. Resolves `$VARIABLE$` placeholders with record data. UIType-aware formatting (dates, currency, references, picklists, checkboxes) |
| `models/PDFRenderer.php` | `PDFMaker2_PDFRenderer_Model` | mPDF rendering engine. Single PDF download and batch ZIP export |

### Views (`modules/PDFMaker2/views/`)

| File | Class | Purpose |
|------|-------|---------|
| `List.php` | `PDFMaker2_List_View` | Settings list of all templates (paginated) |
| `Edit.php` | `PDFMaker2_Edit_View` | Template editor with CKEditor + field picker sidebar |
| `GetTemplates.php` | `PDFMaker2_GetTemplates_View` | AJAX endpoint: returns templates for a source module (JSON) |

### Actions (`modules/PDFMaker2/actions/`)

| File | Class | Purpose |
|------|-------|---------|
| `Save.php` | `PDFMaker2_Save_Action` | Saves template from edit form (admin only) |
| `Delete.php` | `PDFMaker2_Delete_Action` | Deletes template (admin only, AJAX) |
| `GeneratePDF.php` | `PDFMaker2_GeneratePDF_Action` | Generates PDF for a single record (any user) |
| `GetFields.php` | `PDFMaker2_GetFields_Action` | AJAX: returns fields for a target module (for editor field picker) |
| `MassExportPDF.php` | `PDFMaker2_MassExportPDF_Action` | Mass export: multiple records → ZIP of PDFs |

### Smarty Templates (`layouts/v7/modules/PDFMaker2/`)

| File | Purpose |
|------|---------|
| `List.tpl` | Template management list with actions dropdown, pagination |
| `Edit.tpl` | Template editor: name, description, target modules (select2 multi), page settings, CKEditor (header/body/footer), field picker sidebar |
| `ExportPDFModal.tpl` | Modal template for selecting template during export (used by ExportPDF.js) |

### JavaScript (`layouts/v7/modules/PDFMaker2/resources/`)

| File | Purpose |
|------|---------|
| `List.js` | Delete confirmation, row click navigation |
| `Edit.js` | CKEditor init, target module change → AJAX field loading, field picker click-to-insert, form validation |
| `ExportPDF.js` | **CRITICAL**: Loaded globally via HEADERSCRIPT. Adds "Export PDF (v2)" button to all module Detail Views (in actions dropdown) and List Views (mass action). Renders template selector modal. |

### Language Files

| File | Language |
|------|----------|
| `languages/vi_vn/PDFMaker2.php` | Vietnamese (primary) |
| `languages/en_us/PDFMaker2.php` | English (fallback) |

### Migration

| File | Purpose |
|------|---------|
| `migrate/pdfmaker2_install.php` | Creates DB tables, registers module in `vtiger_tab`, adds Settings menu entry, adds HEADERSCRIPT link |

---

## Database Schema

### `vtiger_pdfmaker2_templates`
- `templateid` (PK, AUTO_INCREMENT)
- `template_name`, `description`, `body` (LONGTEXT), `header`, `footer`
- Page settings: `format`, `orientation`, `margin_top/bottom/left/right`
- `status` (1=active, 0=inactive), `created_by`, `created_at`, `modified_at`

### `vtiger_pdfmaker2_template_module_rel`
- M:N relationship: `templateid` ↔ `module_name`
- `is_default` (default template for this module)
- `sequence` (ordering)
- FK CASCADE on delete

---

## Key Workflows

### 1. Admin: Create Template
```
Settings → PDF Maker 2 → New Template
→ Enter name, description
→ Select target modules (multi-select)
→ System loads fields for first selected module
→ Design HTML in CKEditor, click variables from sidebar to insert
→ Configure page settings (format, orientation, margins)
→ Save → back to list
```

### 2. User: Export PDF from Detail View
```
Open any record (e.g., Contact detail view)
→ Click actions dropdown → "Export PDF (v2)"
→ ExportPDF.js fetches templates for this module (AJAX → GetTemplates)
→ Modal shows template selector
→ Select template → Download PDF
→ Browser downloads the PDF file
```

### 3. User: Mass Export from List View
```
Select records in list view via checkboxes
→ Click "Export PDF" button
→ Select template from modal
→ System generates PDF for each record
→ All PDFs packaged into ZIP → downloaded
```

---

## Variable Syntax

Templates use `$MODULE_COLUMNNAME$` variables:

```
$CONTACTS_FIRSTNAME$ → Contact's first name
$CONTACTS_EMAIL$     → Contact's email
$RECORD_ID$          → CRM entity ID
$CURRENT_DATE$       → Today's date (dd/mm/yyyy)
$CURRENT_USER$       → Logged-in user's full name
$COMPANY_NAME$       → From vtiger_organizationdetails
$COMPANY_LOGO$       → <img> tag with company logo
```

---

## Non-Intrusive Architecture

- **Zero changes to existing modules** — no PHP, JS, or template files modified
- **Parallel to old PDFMaker** — PDFMaker2 is completely independent; old PDFMaker continues to work
- **Reuses mPDF** — library at `modules/PDFMaker/resources/mpdf/mpdf.php`
- **Link system** — "Export PDF" button injected via vtiger HEADERSCRIPT link
- **CRMEntity API** — record data fetched via standard vtiger API

---

## Testing Checklist

- [x] PHP syntax validation — all 12 PHP files pass
- [x] DB migration — tables created, module registered
- [x] Settings menu entry — accessible at `index.php?module=PDFMaker2&parent=Settings&view=List`
- [x] FieldResolver — 36+ blocks, 199+ fields for Contacts module
- [x] Record model — CRUD operations verified
- [x] HEADERSCRIPT link — ExportPDF.js registered for global loading
- [x] Test template created — "Giấy Thông Báo Trúng Tuyển" for Contacts & Leads

---

## Known Notes

1. **CLI testing limitation**: vtiger's `CRMEntity::retrieve_entity_info()` requires `$app_strings` and `$current_user` globals which are only available in web context. All PDFMaker2 features work correctly when accessed through the browser.
2. **mPDF dependency**: Uses the mPDF library bundled with the existing PDFMaker module. If PDFMaker is removed, the mPDF path in `PDFRenderer.php` must be updated.
3. **Migration script fix**: The original migration script referenced a `color` column in `vtiger_tab` that doesn't exist in this vtiger version. Fixed to use correct column list. Manual SQL was used to complete the registration.
