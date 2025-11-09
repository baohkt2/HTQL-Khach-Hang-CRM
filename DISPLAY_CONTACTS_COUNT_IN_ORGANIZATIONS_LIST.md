# Tài liệu: Hiển thị số lượng Contacts trong List View của Organizations

## Mục tiêu

Hiển thị số lượng contacts thuộc về mỗi organization ngay trong list view, theo format: **"THPT Cây Dương (1970)"**

## Quy trình thực hiện

### Bước 1: Backend - Truy vấn và lưu số lượng contacts

**File: `modules/Accounts/models/ListView.php`**

Tạo/sửa file model để override phương thức `getListViewEntries()`:

```php
<?php
class Accounts_ListView_Model extends Vtiger_ListView_Model {

    public function getListViewEntries($pagingModel) {
        // Gọi phương thức cha để lấy danh sách records
        $listViewRecordModels = parent::getListViewEntries($pagingModel);

        // Nếu có records, truy vấn số lượng contacts cho mỗi account
        if (!empty($listViewRecordModels)) {
            $db = PearDatabase::getInstance();

            // Lấy danh sách account IDs
            $accountIds = array_keys($listViewRecordModels);
            $accountIdsStr = implode(',', array_map('intval', $accountIds));

            // Query để đếm contacts cho mỗi account
            $sql = "SELECT vtiger_account.accountid,
                          COUNT(DISTINCT vtiger_contactdetails.contactid) as contact_count
                    FROM vtiger_account
                    LEFT JOIN vtiger_contactdetails
                        ON vtiger_account.accountid = vtiger_contactdetails.accountid
                    LEFT JOIN vtiger_crmentity
                        ON vtiger_contactdetails.contactid = vtiger_crmentity.crmid
                    WHERE vtiger_account.accountid IN ($accountIdsStr)
                        AND (vtiger_crmentity.deleted = 0 OR vtiger_crmentity.deleted IS NULL)
                    GROUP BY vtiger_account.accountid";

            $result = $db->pquery($sql, array());

            // Tạo mapping accountId => contact_count
            $contactCounts = array();
            while ($row = $db->fetchByAssoc($result)) {
                $contactCounts[$row['accountid']] = $row['contact_count'];
            }

            // Thêm contact_count vào mỗi record model
            foreach ($listViewRecordModels as $accountId => $recordModel) {
                $contactCount = isset($contactCounts[$accountId]) ? $contactCounts[$accountId] : 0;
                $recordModel->set('contacts_count', $contactCount);
            }
        }

        return $listViewRecordModels;
    }
}
```

**Giải thích:**

- Override `getListViewEntries()` để thêm logic custom
- Sử dụng LEFT JOIN để đếm contacts (bao gồm cả accounts không có contacts)
- Filter records đã xóa với `deleted = 0`
- COUNT(DISTINCT) để tránh đếm trùng
- Lưu kết quả vào field `contacts_count` của record model

---

### Bước 2: Frontend - Template - Truyền dữ liệu sang JavaScript

**File: `layouts/v7/modules/Accounts/ListViewContents.tpl`**

```smarty
{*+**********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.1
************************************************************************************}

{* Custom template for Accounts to show contacts count *}

<style>
.contacts-count-text {
    color: #999;
    font-weight: normal;
    margin-left: 3px;
}
</style>

{* Store contacts count for JavaScript *}
<script type="text/javascript">
    var accountsContactsCount = {ldelim}
    {foreach item=LISTVIEW_ENTRY from=$LISTVIEW_ENTRIES}
        {assign var=ACCOUNT_ID value=$LISTVIEW_ENTRY->getId()}
        {assign var=CONTACTS_COUNT value=$LISTVIEW_ENTRY->get('contacts_count')}
        '{$ACCOUNT_ID}': {if $CONTACTS_COUNT}{$CONTACTS_COUNT}{else}0{/if}{if !$LISTVIEW_ENTRY@last},{/if}
    {/foreach}
    {rdelim};
</script>

{* Include the parent template *}
{include file=vtemplate_path('ListViewContents.tpl', 'Vtiger')}
```

**Giải thích:**

- Tạo object JavaScript `accountsContactsCount` chứa mapping: `accountId => count`
- Duyệt qua tất cả records trong `$LISTVIEW_ENTRIES`
- Lấy `contacts_count` từ record model (đã set ở backend)
- Include parent template để giữ nguyên layout

---

### Bước 3: Frontend - JavaScript - Hiển thị số lượng

**File: `layouts/v7/modules/Accounts/resources/List.js`**

```javascript
/*+***********************************************************************************
 * The contents of this file are subject to the vtiger CRM Public License Version 1.1
 *************************************************************************************/

console.log("✓✓✓ Accounts/List.js is LOADED ✓✓✓");

Vtiger_List_Js(
  "Accounts_List_Js",
  {},
  {
    /**
     * Function to append contacts count to account names in list view
     */
    appendContactsCount: function () {
      console.log("appendContactsCount() called");

      // Check if accountsContactsCount variable exists
      if (typeof accountsContactsCount === "undefined") {
        console.log("accountsContactsCount is undefined");
        return;
      }

      console.log("accountsContactsCount:", accountsContactsCount);

      var thisInstance = this;
      var listViewTable = jQuery("#listview-table");

      console.log("Table found:", listViewTable.length > 0);

      var allRows = listViewTable.find("tr.listViewEntries");

      console.log("Rows found:", allRows.length);

      // Find all account name links in the list view
      allRows.each(function (index) {
        var row = jQuery(this);
        var recordId = row.data("id");

        console.log("--- Processing row " + index + ", recordId:", recordId);

        // Get the count for this account
        var contactsCount = accountsContactsCount[recordId];

        console.log("Count for record " + recordId + ":", contactsCount);

        if (typeof contactsCount !== "undefined") {
          // Find the account name cell - look for link with name field
          // Try to find the link in the column with field name 'accountname'
          var accountNameCell = row
            .find('td[data-field-type="string"] a[href*="view=Detail"]')
            .first();

          // If not found, try alternative selector
          if (accountNameCell.length === 0) {
            accountNameCell = row
              .find("td a.textOverflowEllipsis")
              .not('[title="Details"]')
              .first();
          }

          console.log("Account name cell found:", accountNameCell.length);

          if (accountNameCell.length > 0) {
            var accountName = accountNameCell.text().trim();
            console.log("Current account name:", accountName);
            console.log("Link href:", accountNameCell.attr("href"));
            console.log("Link title:", accountNameCell.attr("title"));

            // Check if count already appended to avoid duplication
            if (accountName.indexOf("(") === -1) {
              // Change the text to include count in parentheses
              var newText = accountName + " (" + contactsCount + ")";

              // Method 1: Try replacing text node
              var textNode = accountNameCell
                .contents()
                .filter(function () {
                  return this.nodeType === 3; // Text node
                })
                .first();

              if (textNode.length > 0) {
                textNode[0].nodeValue = newText;
                console.log("✓ Updated text node to:", newText);
              } else {
                // Method 2: If no text node, try setting text directly
                accountNameCell.text(newText);
                console.log("✓ Set text directly to:", newText);
              }
            } else {
              console.log("Already has parentheses, skipping");
            }
          } else {
            console.log("ERROR: Could not find account name cell");
            console.log("Row HTML:", row.html().substring(0, 200));
          }
        } else {
          console.log("No count data for record:", recordId);
        }
      });
    },

    /**
     * Override registerEvents to add our custom logic
     */
    registerEvents: function () {
      console.log("Accounts_List_Js.registerEvents() called");

      // Call parent registerEvents
      this._super();

      console.log("Parent registerEvents done");

      // Append contacts count after page load
      var thisInstance = this;

      // Use setTimeout to wait for DOM to be ready
      setTimeout(function () {
        console.log("Timeout 500ms - calling appendContactsCount");
        thisInstance.appendContactsCount();
      }, 500);

      // Also listen to Vtiger's list view loaded event
      jQuery(document).on("Vtiger.List.LoadComplete", function () {
        thisInstance.appendContactsCount();
      });

      // Setup MutationObserver for future updates
      var setupObserver = function () {
        var listViewTable = jQuery("#listview-table");
        if (listViewTable.length > 0) {
          var observer = new MutationObserver(function (mutations) {
            thisInstance.appendContactsCount();
          });

          observer.observe(listViewTable[0], {
            childList: true,
            subtree: true,
          });
        } else {
          setTimeout(setupObserver, 1000);
        }
      };

      setTimeout(setupObserver, 1000);
    },
  }
);
```

**Giải thích:**

1. **Class inheritance**: Extend từ `Vtiger_List_Js` cho module Accounts
2. **appendContactsCount()**:
   - Kiểm tra biến `accountsContactsCount` từ template
   - Tìm table và rows với selector `#listview-table` và `tr.listViewEntries`
   - Duyệt qua từng row, lấy recordId từ `data-id` attribute
   - Tìm link tên organization với selector phức tạp (để tránh nhầm với link "Details")
   - Thêm số lượng vào text node: `"Tên (số)"`, kiểm tra tránh trùng lặp
3. **registerEvents()**: Override để tích hợp logic
   - Gọi `this._super()` để giữ functionality cha
   - Sử dụng `setTimeout(500ms)` chờ DOM render
   - Lắng nghe event `Vtiger.List.LoadComplete`
   - Dùng MutationObserver để tự động cập nhật khi list view thay đổi (phân trang, search)

---

## Luồng hoạt động

```
1. User truy cập Organizations List View
   ↓
2. Backend: Accounts_ListView_Model::getListViewEntries()
   - Gọi parent để lấy records
   - Query COUNT contacts từ DB với LEFT JOIN
   - Set contacts_count cho mỗi record
   ↓
3. Template: ListViewContents.tpl render
   - Tạo JavaScript object accountsContactsCount
   - Include parent template (hiển thị bình thường)
   ↓
4. JavaScript: List.js load
   - registerEvents() được gọi
   - setTimeout 500ms → appendContactsCount()
   ↓
5. appendContactsCount() execution
   - Đọc accountsContactsCount object
   - Tìm table #listview-table
   - Duyệt từng row, tìm account name link
   - Update text: "Name" → "Name (count)"
   ↓
6. MutationObserver active
   - Tự động re-run khi list view update
   - Đảm bảo count luôn hiển thị đúng
```

## Key Points

### Backend:

- **Performance**: Single query với GROUP BY thay vì N queries
- **Correctness**: Filter deleted records, COUNT DISTINCT
- **Extensibility**: Dễ thêm logic khác vào model

### Frontend:

- **Selector strategy**: Tìm đúng element (tránh nhầm "Details" link)
- **Timing**: setTimeout + event listener + MutationObserver
- **Duplication prevention**: Check parentheses trước khi append
- **Debug friendly**: Console logs chi tiết

### Architecture:

- **Module isolation**: Chỉ ảnh hưởng Accounts module
- **Parent preservation**: Không phá vỡ template/logic gốc
- **Maintainability**: Code rõ ràng, comment đầy đủ

---

## Files Modified/Created

1. ✅ `modules/Accounts/models/ListView.php` - Backend logic
2. ✅ `layouts/v7/modules/Accounts/ListViewContents.tpl` - Template với data binding
3. ✅ `layouts/v7/modules/Accounts/resources/List.js` - Frontend JavaScript logic

---

## Testing Checklist

- [ ] Số lượng hiển thị đúng format "Organization Name (count)"
- [ ] Organizations không có contacts hiển thị (0)
- [ ] Phân trang: Count vẫn hiển thị sau khi chuyển trang
- [ ] Search: Count vẫn hiển thị sau khi search
- [ ] Filter: Count vẫn hiển thị sau khi filter
- [ ] Sort: Count vẫn hiển thị sau khi sort
- [ ] Performance: Không lag khi load list view
- [ ] Console log: Kiểm tra không có lỗi JavaScript

---

## Troubleshooting

### Vấn đề: Count không hiển thị

**Giải pháp:**

1. Mở Console (F12) kiểm tra:
   - `✓✓✓ Accounts/List.js is LOADED ✓✓✓` - File có load không?
   - `accountsContactsCount:` - Data có tồn tại không?
   - `Table found: true` - Table có tìm thấy không?
   - `Rows found: X` - Có rows không?
2. Clear cache trình duyệt (Ctrl+F5)
3. Kiểm tra backend: `modules/Accounts/models/ListView.php` có đúng không?

### Vấn đề: Hiển thị "Details (count)" thay vì tên

**Giải pháp:**

- Selector đang chọn nhầm link
- Kiểm tra console log xem `Link title` và `Link href`
- Sửa selector trong `appendContactsCount()` function

### Vấn đề: Count bị duplicate

**Giải pháp:**

- MutationObserver gọi nhiều lần
- Logic `if (accountName.indexOf('(') === -1)` sẽ prevent duplicate
- Nếu vẫn bị, thêm flag hoặc data attribute để mark processed

---

## Future Enhancements

1. **Clickable count**: Click vào count để filter contacts của organization đó
2. **Tooltip**: Hover vào count để xem thêm thông tin
3. **Color coding**: Màu sắc khác nhau dựa trên số lượng contacts
4. **Cache**: Cache count trong session để giảm DB queries
5. **Real-time update**: WebSocket để update count real-time khi thêm/xóa contacts

---

## Author & Date

- **Created by**: GitHub Copilot
- **Date**: November 2, 2025
- **Version**: 1.0
