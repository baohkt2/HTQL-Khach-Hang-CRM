# Hướng dẫn Debug Badge Count "1968" trong Organizations Detail View

## Đã thêm Console.log vào các vị trí sau:

### 1. File: `layouts/v7/modules/Vtiger/resources/Detail.js`

#### Function `registerEvents()` (dòng ~2737)

- Log khi detail view được khởi tạo
- Hiển thị module name và record ID

#### Function `getRelatedRecordsCount()` (dòng ~2097)

- Log khi gọi API để lấy count của các related records
- Hiển thị parameters và response data

#### Function `updateRelatedRecordsCount()` (dòng ~2120)

- Log chi tiết quá trình cập nhật badge count
- Hiển thị data nhận được từ API
- Log cho mỗi relation ID và count value
- Log khi tìm element `.numberCircle`
- Log khi show/hide badge

### 2. File: `layouts/v7/modules/Vtiger/resources/RelatedList.js`

#### Function `updateRelatedRecordsCount()` (dòng ~52)

- Log chi tiết khi cập nhật count cho một relation cụ thể
- Hiển thị relationId, recordId, moduleName
- Log data trả về và quá trình cập nhật badge

## Cách kiểm tra:

1. **Mở Organizations detail view** trong trình duyệt
2. **Mở Developer Console** (F12)
3. **Xem tab Console**
4. **Refresh lại trang**

## Những gì bạn sẽ thấy trong console:

```
=== Detail.registerEvents CALLED ===
Module: Accounts Record: [ID]

=== CALLING updateRelatedRecordsCount from registerEvents ===

=== updateRelatedRecordsCount CALLED ===
recordId: [ID]
moduleName: Accounts

=== getRelatedRecordsCount CALLED ===
Parameters - recordId: [ID] moduleName: Accounts
Request params: {data: {...}}

Request completed - err: null data: {4: "1968", 13: "50", ...}

=== getRelatedRecordsCount RESPONSE ===
Full data: {4: "1968", 13: "50", ...}

Processing relation - ID: 4 Count: 1968
Element found: true
numberCircle element: true Current text: 0
Updated numberCircle text to: 1968
Showed badge (removed hide class)
```

## Giải thích:

- **Relation ID 4**: Có thể là Contacts module
- **Count: 1968**: Số lượng contacts thuộc về organization này
- Element `li[data-relation-id="4"]`: Tab Contacts trong related list
- `.numberCircle`: Span hiển thị số count

## Các file liên quan:

1. **Template**: `layouts/v7/modules/Vtiger/ModuleRelatedTabs.tpl`
   - Dòng 61, 86, 120: `<span class="numberCircle hide">0</span>`
2. **Backend API**:

   - Action: `RelatedRecordsAjax`
   - Mode: `getRelatedRecordsCount`
   - Trả về object: `{relationId: count, ...}`

3. **CSS**:
   - Class `.numberCircle` định nghĩa style cho badge
   - Class `.hide` ẩn/hiện badge

## Tìm vị trí hiển thị badge:

Dựa vào console log, bạn sẽ thấy:

- Relation ID nào tương ứng với Contacts
- Badge được update ở element nào
- Giá trị count là bao nhiêu

Từ đó có thể tùy chỉnh CSS hoặc JavaScript để thay đổi cách hiển thị badge.
