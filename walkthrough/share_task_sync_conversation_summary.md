# Tong hop buoi debug Share Task va Share List (2026-03-07)

## Muc tieu ban dau

User bao 2 van de sau khi merge code custom "Share the list" thanh "Share task":

1. UI Edit list bi mat selected users va mo ta task sau reload.
2. Quyen hien thi list bi sai: userC van thay list/task du userA chi share cho userB.

## Phan tich va root cause

### 1. Van de UI mat selected users/description

- Du lieu `members` trong `vtiger_cv_share_tasks` co the bi HTML-encode (`&quot;`) gay loi parse JSON neu khong decode.
- Select2 v3 khong on dinh neu chi dua vao selected option, can preselect ro rang tu hidden value.
- Sau merge co xung dot logic giua template + js nen prefill bi vo hieu hoa.

### 2. Van de user khong duoc share van thay list

- Trong qua trinh save, logic cu tung ep `status = PUBLIC` khi co `share_tasks`.
- `PUBLIC` (status=3) la co che default cua vtiger de moi user co the thay list.
- Vi vay userC van thay list du khong nam trong member duoc giao task.

### 3. Van de khong dong bo giua `vtiger_cv_share_tasks` va bang default

User cung cap bang chung:

- Khi xoa user khoi share task thi `vtiger_cv_share_tasks` da thay doi,
- Nhung `vtiger_cv2users` van con du lieu cu.

Root cause:

- Logic save truoc do phu thuoc payload frontend (`sharelist/members`),
- Co truong hop request gui thieu hoac du lieu cu ton dong nen `vtiger_cv2*` khong duoc don sach dung.

## Bang default cua vtiger lien quan Share List

Khong chi 1 bang, ma la nhom bang:

- `vtiger_customview` (metadata list/filter + status)
- `vtiger_cv2users`
- `vtiger_cv2group`
- `vtiger_cv2role`
- `vtiger_cv2rs`

Map format member:

- `Users:14` -> `vtiger_cv2users.userid = 14`
- `Groups:17` -> `vtiger_cv2group.groupid = 17`
- `Roles:H2` -> `vtiger_cv2role.roleid = H2`
- `RoleAndSubordinates:H4` -> `vtiger_cv2rs.rsid = H4`

## Cac file da duoc sua

### 1. `modules/CustomView/actions/Save.php`

- Khong ep list thanh PUBLIC mot cach may moc.
- Chuan hoa va dong bo `sharelist`, `status`, `members` theo du lieu thuc te.
- Khi share dang bat:
  - Co `All::Users` -> status PUBLIC
  - Khong co `All::Users` -> status PRIVATE
- Khi tat share -> status PRIVATE, members rong.
- Luon dua `sharelist` + `members` vao model de backend xu ly day du.

### 2. `modules/CustomView/CustomView.php`

- Mo rong logic quyen truy cap va query lay custom view cho non-admin,
- Bo sung kiem tra member tu bang `vtiger_cv2users/cv2group/cv2role/cv2rs`.
- Muc tieu: private shared list van hien cho dung user duoc cap quyen, khong bi lo ra toan bo.

### 3. `modules/CustomView/models/Record.php`

- Decode du lieu `members`/`task_description` khi load de tranh loi parse.
- Bo sung dong bo 2 chieu tu `vtiger_cv_share_tasks` sang bang default theo format member:
  - Cache member cu (`previousMembers`)
  - Lay member moi (`currentMembers`)
  - Diff: removed/add -> delete/insert vao `vtiger_cv2*`
  - Reconcile cuoi cung de ep `vtiger_cv2*` khop 100% voi `currentMembers`
- Cac ham moi:
  - `getShareTaskMembersFromDb()`
  - `normalizeQualifiedMembers()`
  - `syncDefaultShareMembersByDiff()`
  - `applyDefaultShareMemberMutation()`
  - `reconcileDefaultShareMembers()`
  - `buildMemberBuckets()`

### 4. `layouts/v7/modules/CustomView/EditView.tpl`

- Escape hidden saved members va task description de giu UI on dinh.

### 5. `layouts/v7/modules/CustomView/resources/CustomView.js`

- Cai thien preselect Select2 tu hidden members.
- Set value lai sau khi init Select2 de tranh mat selected khi reload/edit.

## Ket qua mong doi sau fix

1. Edit list se hien lai dung selected users va task description.
2. Xoa member trong share task se xoa dong bo quyen trong `vtiger_cv2*`.
3. User khong nam trong member se khong con thay list (neu khong co `All::Users`).
4. Du lieu custom table (`vtiger_cv_share_tasks`) va default table vtiger (`vtiger_cv2*`) duoc dong bo nhat quan.

## Lenh/kiem tra da su dung

### PHP lint

- `php -l modules/CustomView/actions/Save.php`
- `php -l modules/CustomView/models/Record.php`
- `php -l modules/CustomView/CustomView.php`

Tat ca deu khong co syntax error.

### SQL verify de test sau save

- Kiem tra custom table:
  - `SELECT * FROM vtiger_cv_share_tasks WHERE cvid = <CV_ID>;`
- Kiem tra bang default share:
  - `SELECT * FROM vtiger_cv2users WHERE cvid = <CV_ID>;`
  - `SELECT * FROM vtiger_cv2group WHERE cvid = <CV_ID>;`
  - `SELECT * FROM vtiger_cv2role WHERE cvid = <CV_ID>;`
  - `SELECT * FROM vtiger_cv2rs WHERE cvid = <CV_ID>;`
- Kiem tra status list:
  - `SELECT cvid, viewname, status, userid FROM vtiger_customview WHERE cvid = <CV_ID>;`

## Ghi chu

- Co da luu repository memory ve nguyen tac quan trong: khong force PUBLIC neu khong co `All::Users`, va phai decode + preselect members dung cach.
- Neu can, co the bo sung script SQL audit de tim toan bo `cvid` dang lech giua `vtiger_cv_share_tasks` va `vtiger_cv2*` trong he thong.
