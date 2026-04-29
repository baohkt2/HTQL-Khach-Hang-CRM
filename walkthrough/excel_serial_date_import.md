# Walkthrough: Supporting Excel Serial Dates in Import

## Overview
This enhancement allows the CRM to correctly process Excel files where date columns contain raw numeric values (Excel Serial Dates) instead of formatted date strings. 

## Problem
Excel stores dates as the number of days since January 1, 1900. For example, `10/19/2008` (MM/DD/YYYY) is stored as `39740`. If a cell is not explicitly formatted as a "Date" in Excel, libraries like PHPExcel might read it as a raw number. When this number is imported into a date field in the CRM, it fails validation or results in incorrect data (like the year 39740).

## Implementation Detail
The fix was implemented in `modules/Import/readers/XLSReader.php`.

### 1. Identifying Date Fields
During the `read()` process, the system now identifies which fields in the target module are of type `date` or `datetime`.
```php
$dateFields = array();
$moduleFields = $this->moduleModel->getFields();
// ... merge with additional import fields ...
foreach ($moduleFields as $fieldName => $fieldModel) {
    $dataType = $fieldModel->getFieldDataType();
    if ($dataType == 'date' || $dataType == 'datetime') {
        $dateFields[$fieldName] = $dataType;
    }
}
```

### 2. Automatic Conversion
For every mapped field, if the target is a date field and the source value is numeric (without date separators), the system attempts to convert it using `PHPExcel_Shared_Date::ExcelToPHP()`.

```php
if (isset($dateFields[$fieldName]) && is_numeric($fieldValue) && $fieldValue !== '') {
    if (strpos($fieldValue, '-') === false && strpos($fieldValue, '/') === false) {
        $timestamp = PHPExcel_Shared_Date::ExcelToPHP($fieldValue);
        if ($dateFields[$fieldName] == 'datetime') {
            $fieldValue = date('m/d/Y H:i:s', $timestamp);
        } else {
            $fieldValue = date('m/d/Y', $timestamp);
        }
    }
}
```

## Verification
-   **Input**: An Excel file with a cell containing `39740` mapped to a date field (e.g., Birthday).
-   **Behavior**: The staging table will now store `10/19/2008`.
-   **Result**: The CRM correctly saves the date as `2008-10-19`.

## Instructions for Testing
1. Create an Excel file where a date column is intentionally formatted as "General" or "Number" (e.g., type `45412`).
2. Import this file into a module (like Contacts).
3. Map that column to a Date field (like "Date of Birth").
4. **Expected Result**: The record should be created/merged with the correct date (e.g., `2024-05-01`) instead of failing or importing the raw number.
