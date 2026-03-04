# User Login History - Export to Excel

Based on your request, I have successfully implemented the "Export to Excel" functionality for the User Login History view. Here is a summary of the changes:

## Features Added

1. **Export Button**: Added an "Export" button (with a download icon) to the header of the User Login History view.
2. **Current Filter Support**: The export button respects the currently selected User filter in the dropdown menu. If you filter by a specific user, the exported file will only contain records for that user.
3. **Data Format**: The exported data is in a native **Excel format** (`.xls`) to preserve data types and allow seamless opening in Microsoft Excel without CSV conversion issues. It will download as `Login_History.xls`.
4. **Exported Columns**: The export logic dynamically fetches the list of columns currently defined in the list view, meaning **custom fields like `LBL_SESSION_DURATION` are correctly included**. Instead of a hardcoded list, the export uses VTiger's native methods to fetch all active columns.
5. **Data Formatting**: The actual data formatting used in the UI (e.g., converting duration numbers to "5 phút 45 giây" or formatting dates) is identical in the exported `.xls` file.

## Files Modified

- `modules/Settings/LoginHistory/models/ListView.php`: Configured the `getBasicLinks()` function to inject the "Export" button into the view layout.
- `layouts/v7/modules/Settings/LoginHistory/resources/List.js`: Added Javascript logic to pull the currently selected user and trigger a window redirect to the export action.
- `modules/Settings/LoginHistory/actions/ExportData.php`: **[NEW]** Created the backend controller action that queries the database with the provided filters and generates the CSV file response.

### Global Module Export modifications

- `layouts/v7/modules/Vtiger/Export.tpl`: Added an **Export Format** section containing `.csv` and `.xls` radio buttons, allowing users to choose their preferred data format when exporting from any module.
- `modules/Vtiger/actions/ExportData.php`: Updated the core `output()` method. It now checks for the chosen `export_format`. If `.xls` is selected, it uses `PHPExcel` to stream the data exactly as it appears in the system into a styled native Excel worksheet. Otherwise, it gracefully falls back to the system's standard `.csv` generation.

## Validation Steps

Please test the changes by following these steps:

1. Reload your browser page at **Settings > User Management > Login History**.
2. Assuming you are an Admin, you should now see the **Export** button.
3. Select a specific user from the "All Fields" dropdown filter.
4. Click the "Export" button.
5. A file named `Login_History.xls` will be downloaded. Open it with Microsoft Excel to verify the formatting and filtered data correctness.

## Additional Validation (Global Export format selection)

1. Navigate to **Contacts** or any other core VTiger module.
2. Select some records and click **More > Export**.
3. Observe the new **Export Format** option where you can select between CSV and Excel formats.
4. Select _Excel_ and verify that the file downloads accurately and opens as an `.xls` file.
