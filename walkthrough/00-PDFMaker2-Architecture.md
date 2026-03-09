# PDFMaker2 — Centralized PDF Engine Architecture

## 1. Problem Statement

The current PDFMaker (Free edition by ITS4You) has a **1-template-per-module** limitation:
- Template stored in `vtiger_pdfmaker` with `module` as single VARCHAR field
- `getTemplateData()` in `PDFContent.php` queries `WHERE module=? AND module IN ('Invoice','Quotes','SalesOrder','PurchaseOrder')`
- Only 4 inventory modules are supported (hardcoded `basicModules` = tabids 20,21,22,23)

**Current workaround**: Invoice and SalesOrder modules were hijacked to serve as PDF containers for "Giấy Thông Báo Trúng Tuyển" and "Giấy Đăng Ký Ứng Tuyển", causing massive technical debt.

## 2. Solution: PDFMaker2 Module

A **new, parallel module** (`PDFMaker2`) that:
- Does NOT modify the old `PDFMaker` module at all (non-intrusive)
- Supports **unlimited templates per module**
- Works with **ALL entity modules** in the system
- Uses the existing **mPDF library** from `modules/PDFMaker/resources/mpdf/`
- Leverages vtiger's native **field metadata** for dynamic variable insertion

## 3. Database Schema

### 3.1 `vtiger_pdfmaker2_templates`
Primary template storage.

```sql
CREATE TABLE vtiger_pdfmaker2_templates (
    templateid INT AUTO_INCREMENT PRIMARY KEY,
    template_name VARCHAR(255) NOT NULL,
    description TEXT,
    body LONGTEXT NOT NULL,           -- HTML template with $FIELD$ placeholders
    header TEXT,                        -- HTML header
    footer TEXT,                        -- HTML footer
    -- Page settings
    format VARCHAR(50) DEFAULT 'A4',
    orientation VARCHAR(20) DEFAULT 'portrait',
    margin_top DECIMAL(6,1) DEFAULT 10,
    margin_bottom DECIMAL(6,1) DEFAULT 10,
    margin_left DECIMAL(6,1) DEFAULT 10,
    margin_right DECIMAL(6,1) DEFAULT 10,
    -- Metadata
    status TINYINT(1) DEFAULT 1,       -- 1=active, 0=inactive
    created_by INT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
    modified_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX idx_status (status)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### 3.2 `vtiger_pdfmaker2_template_module_rel`
Many-to-many: which templates are available for which modules.

```sql
CREATE TABLE vtiger_pdfmaker2_template_module_rel (
    id INT AUTO_INCREMENT PRIMARY KEY,
    templateid INT NOT NULL,
    module_name VARCHAR(100) NOT NULL,  -- e.g. 'Contacts', 'Potentials', 'Invoice'
    is_default TINYINT(1) DEFAULT 0,    -- default template for this module
    sequence INT DEFAULT 0,             -- ordering
    UNIQUE KEY uk_template_module (templateid, module_name),
    INDEX idx_module (module_name),
    FOREIGN KEY (templateid) REFERENCES vtiger_pdfmaker2_templates(templateid) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
```

### 3.3 `vtiger_pdfmaker2_seq` (vtiger convention)
```sql
CREATE TABLE vtiger_pdfmaker2_seq (
    id INT NOT NULL DEFAULT 0
) ENGINE=InnoDB;
INSERT INTO vtiger_pdfmaker2_seq VALUES (0);
```

## 4. Module Structure

```
modules/PDFMaker2/
├── PDFMaker2.php                    # Module handler (vtlib_handler)
├── models/
│   ├── Module.php                   # Module model
│   ├── Record.php                   # Template record model (CRUD)
│   ├── ListView.php                 # List view model
│   ├── FieldResolver.php            # Dynamic field/variable resolver
│   └── PDFRenderer.php              # mPDF rendering engine
├── views/
│   ├── List.php                     # Template list view
│   ├── Edit.php                     # Template create/edit view
│   ├── Detail.php                   # Template detail view
│   ├── ExportPDF.php                # PDF generation + download
│   └── GetTemplates.php             # AJAX: get templates for a module
├── actions/
│   ├── Save.php                     # Save template
│   ├── Delete.php                   # Delete template  
│   ├── GeneratePDF.php              # Generate PDF for record(s)
│   ├── GetFields.php                # AJAX: fetch fields for target module
│   └── MassExportPDF.php            # Mass export from list view
└── schema.xml                       # Database schema

layouts/v7/modules/PDFMaker2/
├── List.tpl                         # Template list
├── Edit.tpl                         # Template editor with CKEditor
├── Detail.tpl                       # Template detail view
├── ExportPDFModal.tpl               # Modal: select template for PDF export
├── resources/
│   ├── List.js                      # List view JS
│   ├── Edit.js                      # Editor JS (field insertion, CKEditor)
│   └── ExportPDF.js                 # Export PDF JS (loaded globally)

languages/vi_vn/PDFMaker2.php
languages/en_us/PDFMaker2.php
```

## 5. Core Workflow

### 5.1 Template Creation Flow
```
Admin → PDFMaker2 List → "New Template"
    → Select Target Module(s) from multi-select
    → System fetches fields for selected module via AJAX (GetFields action)
    → Admin designs HTML template with CKEditor
    → Insert $FIELDNAME$ variables from field picker sidebar
    → Set page format, margins, header/footer
    → Save → INSERT into vtiger_pdfmaker2_templates + vtiger_pdfmaker2_template_module_rel
```

### 5.2 PDF Export Flow (from any module)
```
User on Contact Detail View → clicks "Export PDF" button
    → AJAX: GET index.php?module=PDFMaker2&view=GetTemplates&source_module=Contacts
    → Returns list of templates assigned to Contacts
    → User selects template from dropdown/modal
    → POST index.php?module=PDFMaker2&action=GeneratePDF&record=123&templateid=5
    → Server:
        1. Load template from vtiger_pdfmaker2_templates
        2. Load record data via CRMEntity::getInstance + retrieve_entity_info
        3. FieldResolver: Replace $FIELDNAME$ with actual values
        4. PDFRenderer: Create mPDF, set margins/header/footer, WriteHTML, Output
    → PDF downloaded
```

### 5.3 Hook Integration (Non-intrusive)
The "Export PDF" button is injected via vtiger's **Link system**:
- `HEADERSCRIPT` link loads `ExportPDF.js` globally
- JS adds "Export PDF" to detail view actions dropdown
- No modification to any existing module code

## 6. Variable Syntax

Template variables follow the pattern: `$MODULE_FIELDNAME$`

Examples:
- `$CONTACTS_FIRSTNAME$` → Contact's first name
- `$CONTACTS_LASTNAME$` → Contact's last name
- `$CONTACTS_EMAIL$` → Contact's email

Special variables:
- `$RECORD_ID$` → CRM entity ID
- `$CURRENT_DATE$` → Current date
- `$CURRENT_USER$` → Logged-in user's name
- `$COMPANY_NAME$`, `$COMPANY_ADDRESS$`, etc. → Company info
- `$R_MODULENAME_FIELDNAME$` → Related module fields

## 7. Key Design Decisions

1. **Separate module, not upgrade**: PDFMaker2 is independent from PDFMaker. No risk of breaking existing PDF functionality.
2. **Reuse mPDF**: The existing `modules/PDFMaker/resources/mpdf/` library is reused. No duplicate dependencies.
3. **vtiger Link system**: "Export PDF" buttons are injected via standard vtiger link mechanism — zero modification to existing module views.
4. **CRMEntity API**: All record data is fetched via vtiger's standard `CRMEntity` API, ensuring compatibility with all modules including custom fields.
5. **Parameterized queries**: All SQL uses `pquery()` with bound parameters for security.
