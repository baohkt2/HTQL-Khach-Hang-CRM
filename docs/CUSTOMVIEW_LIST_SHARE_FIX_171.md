# Fix List Share: Contacts viewname=171

## Muc tieu
Khac phuc loi user da duoc share List (Custom View) nhung khi login khong tai du lieu list, khong thay request pjax/fetch nhu list khac.

## Boi canh loi
- URL bi loi: module=Contacts, view=List, viewname=171
- User bi anh huong: CTV_dptrang (id=40)
- Doi chieu: viewname=102 hoat dong binh thuong va co request pjax.

## Nguyen nhan goc
Trong `CustomView::getStatusAndUserid`, dieu kien cache truoc day:

```php
if (!isset(self::$cvStatusAndUser[$viewid]) && ($this->_status === false || $this->_userid === false)) {
```

Dieu kien nay phu thuoc them vao `_status/_userid` theo instance, dan den truong hop trong cung request, khi da check mot cvid truoc do thi cvid tiep theo co the khong duoc query/cached dung cach.
Ket qua la check quyen custom view co the sai, dan den list load khong dung luong mong doi.

## Ban sua
Thay dieu kien cache theo dung key `cvid`:

```php
if (!array_key_exists($viewid, self::$cvStatusAndUser)) {
```

File sua:
- `modules/CustomView/CustomView.php`

## Tac dong
- Moi custom view duoc cache quyen/trang thai doc lap theo `cvid`.
- Tranh nhiem cheo cache giua cac view trong cung request.
- Giam nguy co list da share nhung bi mat noi dung do check quyen sai.

## Kiem tra
1. Kiem tra syntax:

```bash
php -l modules/CustomView/CustomView.php
```

2. Kiem tra du lieu share trong DB:
- `vtiger_customview` co `cvid=171`
- `vtiger_cv2users` co mapping `cvid=171`, `userid=40`

3. Dang nhap user `CTV_dptrang`, mo lai list view 171:
- Ky vong list hien noi dung nhu list share khac.
- Network co request pjax cho list.

## Ghi chu van hanh
Neu trinh duyet van giu trang thai cu, thuc hien hard refresh (Ctrl+F5) hoac dang xuat/dang nhap lai de xoa cache phia client.
