# PDFMaker2 Improvements — Session 2

## Date: 2026-03-09

## Overview of Changes

This document details the improvements made to PDFMaker2, inheriting key capabilities from the original PDFMaker module.

---

## 1. Export PDF Button — Fully Functional

### Problem
The "Export PDF" buttons on Detail View and List View were wired to `showFeatureInDevelopmentPopup()`, meaning users could never actually generate PDFs.

### Fix (ExportPDF.js)
- **Detail View button**: Now calls `showTemplateSelector(moduleName, [recordId], false)` which shows a template picker modal and triggers single-record PDF download.
- **List View button**: Now calls `showTemplateSelector(moduleName, selectedIds, true)` which shows a template picker and triggers mass PDF export as ZIP.
- Removed the `hide` CSS class from the list view mass export menu item.
- Removed the unused `showFeatureInDevelopmentPopup` method.

### Flow
1. User clicks "Export PDF" in the More dropdown
2. JS fetches templates via `GetTemplates` view for the current module
3. Template selector modal appears with available templates
4. User selects template and clicks "Download PDF"
5. Single record → `GeneratePDF` action (direct PDF download)
6. Multiple records → `MassExportPDF` action (ZIP download)

---

## 2. Related Module Field Resolution

### Problem
PDFMaker2 only resolved fields from the main record's module. No support for related module fields (e.g., getting Account name from a Contact record or assigned User's details).

### Solution (FieldResolver.php)
Added UIType-based related module detection, inherited from original PDFMaker:

```php
private static $uitypeRelatedModuleMap = [
    51 => ['Accounts'],     // Account reference
    57 => ['Contacts'],     // Contact reference
    58 => ['Campaigns'],    // Campaign reference
    59 => ['Products'],     // Product reference
    73 => ['Accounts'],     // Account (alternate)
    75 => ['Vendors'],      // Vendor reference
    76 => ['Potentials'],   // Potential reference
    78 => ['Quotes'],       // Quote reference
    80 => ['SalesOrder'],   // Sales Order reference
    81 => ['Vendors'],      // Vendor (alternate)
    68 => ['Accounts', 'Contacts'], // Multi-entity
];
```

Additional handlers:
- **UIType 10**: Dynamic `vtiger_fieldmodulerel` lookup
- **UIType 52/53/101**: Users module

### New Template Variables
For Contacts module, the template editor now shows:
- **Trường (Liên kết)**: 117+ Account fields like `$ACCOUNTS_ACCOUNTNAME$`, `$ACCOUNTS_CF_1484$`
- **Người sử dụng (Liên kết)**: 56 User fields like `$USERS_FULLNAME$`, `$USERS_EMAIL1$`

### Resolution Process
1. When resolving variables, the main record's fields are scanned
2. Reference fields (UIType 10, 51, 57, etc.) are detected
3. Related record IDs are extracted from the reference field values
4. Each related module's fields are loaded and resolved with actual data
5. Users are handled specially via direct DB query (for performance)

---

## 3. Improved UIType Handling

### Date Fields (UIType 5, 6, 23, 70)
- Format: `dd/mm/YYYY` (Vietnamese standard)
- Handles both `Y-m-d` and `Y-m-d H:i:s` formats

### Currency (UIType 71, 72)
- Vietnamese format: `1.000.000` (dot separator, no decimals)

### Numeric (UIType 7, 9)
- Integer detection: shows without decimals
- Float: 2 decimal places with Vietnamese formatting

### Reference Fields (UIType 10, 51, 57, 58, 59, 68, 73, 75, 76, 78, 80, 81)
- Resolves ID to entity name using `getEntityName()`

### User Fields (UIType 52, 53, 101)
- Resolves to full name via `getUserFullName()`
- Falls back to group name if the value is a group ID

### Checkbox (UIType 56)
- Displays "Có" / "Không" (Vietnamese)

### Picklist (UIType 15, 16)
- Translated via `vtranslate()`

### Multi-select Picklist (UIType 33)
- Splits `|##|` separator, translates each value

### Text Area (UIType 19, 20, 21)
- Preserves line breaks via `nl2br()`

### Image (UIType 69)
- Loads attachment from `vtiger_attachments` table
- Renders as inline `<img>` tag (max 150x150px)

---

## 4. HTML Encoding Fixes

### Discovery
vtiger's `PearDatabase` applies `to_html()` (which uses `htmlentities()`) to ALL data returned by `fetchByAssoc()`, `fetch_array()`, `query_result()`. This means DB query results are already HTML-encoded.

However, `CRMEntity::column_fields` values are plain UTF-8 (not encoded).

### Key Principle
```
column_fields   → plain UTF-8     → needs htmlspecialchars() for HTML output
PearDatabase    → HTML-encoded    → do NOT apply htmlspecialchars()
getUserFullName → HTML-encoded    → do NOT re-encode
getEntityName   → HTML-encoded    → do NOT re-encode
```

### Fixes Applied
1. `formatFieldValue()` UIType 52/53/101: Removed extra `htmlspecialchars()` around `getUserFullName()` return
2. `formatFieldValue()` UIType 10/51/57/etc: Removed extra `htmlspecialchars()` around `getEntityName()` return
3. `resolveUserFields()`: Removed `htmlspecialchars()` from all DB query results (already `to_html` encoded)
4. `getRecordImage()`: Removed double-encoding of file paths; added `html_entity_decode` for `file_exists()` check
5. Company logo: Removed `htmlspecialchars()` from `$companyDetails['logoname']` (already encoded by `to_html`)

---

## 5. Save Action — Template Name Encoding

### Problem
`Vtiger_Request::get()` applies `htmlspecialchars()` automatically. Template names with Vietnamese characters got double-encoded in the database (e.g., `Thông` → `Th&ocirc;ng`).

### Fix (Save.php)
Changed `$request->get('template_name')` to `$request->getRaw('template_name')` to store clean UTF-8 in the database.

The template name is safe because:
- Stored via parameterized query (SQL injection safe)
- Displayed via Smarty templates (auto-escape for XSS)
- PDF filenames use `html_entity_decode()` + regex sanitization

---

## 6. Test Results

### CLI Tests (all PASS)
1. `getEntityModules()` — 10 modules found
2. `getFieldsForModule('Contacts')` — 38 blocks (35 main + Accounts related + Users related + System vars)
3. `resolveVariables()` — All variables resolved correctly
4. Template loading — Template data loaded with correct format/status
5. Full PDF render — Valid 30KB PDF with `%PDF` header

### HTTP Tests (all PASS)
1. `GetTemplates` — Returns templates for Contacts module as JSON
2. `GetFields` — Returns 38 blocks with related modules and system variables
3. `GeneratePDF` — Returns valid PDF file (30KB, 1 page)
4. `MassExportPDF` — Returns valid ZIP with 3 PDFs (~84KB total)

### Bootstrap Discovery
vtiger CLI testing requires:
```php
require_once 'vendor/autoload.php';  // Monolog dependency
require_once 'config.php';           // includes config.inc.php
require_once 'include/utils/utils.php';
require_once 'includes/Loader.php';
vimport('includes.runtime.Globals');  // vglobal() function
vimport('includes.runtime.LanguageHandler');
```

---

## Files Modified

| File | Changes |
|------|---------|
| `modules/PDFMaker2/models/FieldResolver.php` | Related module support, UIType improvements, encoding fixes |
| `modules/PDFMaker2/actions/Save.php` | `getRaw()` for template_name/description |
| `layouts/v7/modules/PDFMaker2/resources/ExportPDF.js` | Wired buttons to actual export functionality |
| `languages/vi_vn/PDFMaker2.php` | Added `LBL_PAGE_NUMBER`, `LBL_RELATED` |
| `languages/en_us/PDFMaker2.php` | Added `LBL_PAGE_NUMBER`, `LBL_RELATED` |
| `languages/vi_vn/Settings/PDFMaker2.php` | Added `LBL_PAGE_NUMBER`, `LBL_RELATED` |
| `languages/en_us/Settings/PDFMaker2.php` | Added `LBL_PAGE_NUMBER`, `LBL_RELATED` |

## Database Changes

| Table | Change |
|-------|--------|
| `vtiger_pdfmaker2_templates` | Fixed HTML-encoded template_name for templateid=2 |
