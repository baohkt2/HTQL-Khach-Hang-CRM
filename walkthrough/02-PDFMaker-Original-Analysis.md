# PDFMaker (Original) — Complete Analysis

## Overview

The original PDFMaker is **ITS4You PDFMaker Free** (v0.11), a third-party vtiger module for generating PDF documents from CRM records. It supports Quotes, Invoice, SalesOrder, PurchaseOrder and all entity modules.

---

## Architecture

### Database Tables

| Table | Purpose |
|-------|---------|
| `vtiger_pdfmaker` | Template storage (templateid, filename, module, body, description, deleted) |
| `vtiger_pdfmaker_seq` | Auto-increment sequence counter |
| `vtiger_pdfmaker_settings` | Per-template settings: margins, format, orientation, decimals, encoding, header, footer |
| `vtiger_pdfmaker_breakline` | Breakline config for product layouts in inventory modules |
| `vtiger_pdfmaker_images` | Image attachments for templates |
| `vtiger_pdfmaker_releases` | Release version tracking |
| `vtiger_pdfmaker_productbloc_tpl` | Predefined product block HTML templates |

### Key Limitation: **One template per module**
The `vtiger_pdfmaker.module` column ties each template to a single module. There's no M:N relationship.

---

## Core Components

### 1. PDFMaker_PDFContent_Model (models/PDFContent.php)
**The heart of the system.** Extends `PDFMaker_PDFContentUtils_Model`.

- Handles template data loading from DB
- Inventory module detection (Quotes, Invoice, SalesOrder, PurchaseOrder, etc.)
- Product line item processing with:
  - Prices, quantities, discounts, taxes
  - Per-item and group tax calculations  
  - VAT block processing
  - Product images
  - Sub-products
  - Custom inventory fields
- Variable replacement in HTML templates
- Number formatting (decimal point, thousands separator, decimals)
- Pagebreak support for multi-page PDFs
- Section separator: `&#%ITS%%%@@@%%%ITS%#&` splits header/body/footer
- Barcode support: `[BARCODE|...|BARCODE]` → `<barcode>`

### 2. PDFMaker_PDFContentUtils_Model (models/PDFContentUtils.php)
Utility base class with helper methods:

- `getOwnerNameCustom($id)` — Resolve user/group name
- `getAccountNo($account_id)` — Get account number
- `convertVatBlock($content)` — Process VAT block markers
- `getUITypeName($uitype)` — Map UIType to data type category
- `fixImg($content)` — Fix image paths (relative→absolute)
- `GetFieldModuleRel()` — Get field→module relations (uitype 10)
- `getUserImage($id)` — Get user profile image
- `getSettingsForId($templateid)` — Load page settings
- `getInventoryBreaklines($id)` — Breakline configuration

### 3. PDFMaker_Fields_Model (models/Fields.php)
Field discovery and mapping:

- Fetches blocks and fields from `vtiger_blocks` / `vtiger_field`
- Special handling for Calendar (tabid 9+16), inventory modules, Users
- **Related module resolution** by UIType:
  - 51 → Accounts
  - 57 → Contacts
  - 58 → Campaigns
  - 59 → Products
  - 73 → Accounts
  - 75, 81 → Vendors
  - 76 → Potentials
  - 78 → Quotes
  - 80 → SalesOrder
  - 101 → Users
  - 68 → Accounts/Contacts
  - 10 → Dynamic (from `vtiger_fieldmodulerel`)
- Permission checking: `$fieldModel->getPermissions('readonly')`
- Language-aware labels

### 4. PDFMaker_checkGenerate_Model (models/checkGenerate.php)
PDF generation controller:

- Receives request parameters: record, mode, language, source_module, templateid
- Delegates to `PDFMaker_PDFMaker_Model::GetPreparedMPDF()` method
- Supports print mode (AutoPrint)
- Supports attachment and inline output modes

### 5. PDFMaker_PDFMaker_Model (models/PDFMaker.php)
Core model:

- Version type: "Free"
- `GetBasicModules()` — Allowed modules (20,21,22,23 = Quotes, PO, SO, Invoice)
- `GetAllEntityModules()` — All available entity modules
- `GetListviewData()` — Template list
- `GetDetailViewData($templateid)` — Single template with settings
- `GetPreparedMPDF()` — Main entry point for PDF generation

---

## Variable Syntax

The original uses `$MODULENAME_FIELDNAME$` format:

```
$CONTACTS_FIRSTNAME$     → maps to field "firstname" in Contacts
$CONTACTS_EMAIL$         → maps to field "email" in Contacts  
$PRODUCTS_PRODUCTNAME$   → Product name
$ACCOUNTS_ACCOUNTNAME$   → Company name from related Account
```

**Special variables for inventory modules:**
```
$PRODUCTNAME$, $PRODUCTQUANTITY$, $PRODUCTPRICE$
$PRODUCTDISCOUNT$, $PRODUCTTOTAL$, $PRODUCTTOTALSUM$
$NETTOTAL$, $TAXTOTAL$, $TOTALAFTERDISCOUNT$
$FINALDISCOUNT$, $SHTAXAMOUNT$, $TOTALWITHVAT$
$VATPERCENT_INDIVIDUAL$
```

**Organization variables:**
```
$ORG_NAME$, $ORG_ADDRESS$, $ORG_CITY$, etc.
```

**Other:**
```
$siteurl$, ##PAGE##, [BARCODE|...|BARCODE]
```

---

## How PDF Generation Works (Flow)

```
1. User clicks "PDF" button on record detail view
2. CreatePDFFromTemplate action receives: record, module, templateid
3. checkGenerate model calls PDFMaker_PDFMaker_Model::GetPreparedMPDF()
4. PDFContent model is constructed with module, focus, language, templateid
   → Loads template data (header, body, footer, settings)
   → Detects inventory module
5. getContent() is called:
   → Builds replacement map (field values → $VARIABLE$ keys)
   → For inventory modules: processes product line items
   → Handles related module fields
   → Handles special variables (barcode, page number, site URL)
   → Applies character encoding fixes
6. mPDF library renders HTML to PDF
7. PDF is streamed to browser as download/inline
```

---

## Weaknesses of Original PDFMaker (Free Edition)

1. **One template per module** — No multi-template support per module
2. **Limited to basic modules** (Free version restricts to 4 modules)
3. **No M:N module-template relationship** 
4. **Complex, monolithic code** — PDFContent.php is 400+ lines of tightly coupled logic
5. **Browser-injected HTML pollution** — Chrome extensions inject `<ddict-div>`, `<script>` tags into saved templates
6. **No template preview** capability
7. **Hard-coded inventory modules** list
8. **No batch/mass export** support in Free version
9. **Static properties everywhere** — Makes testing and extension difficult
10. **No CSRF protection** on forms

---

## What PDFMaker2 Should Inherit / Improve

### Must Keep:
- mPDF rendering engine (already reused)
- UIType-aware field formatting
- Related module resolution via UIType mapping
- Inventory module product block processing (CRITICAL for actual use)

### Must Improve:
- M:N template-module relationship ✅ (already in PDFMaker2)
- Multi-template support per module ✅ (already in PDFMaker2)
- Clean HTML (no browser extension pollution)
- Field picker sidebar in editor ✅ (already in PDFMaker2)
- Batch/Mass export with ZIP ✅ (already in PDFMaker2)
- Related module field resolution in FieldResolver (MISSING)
- Actually working Export button (currently shows "Feature In Development")
- User/Owner field resolution
- Better image path handling
- PDF preview before download
