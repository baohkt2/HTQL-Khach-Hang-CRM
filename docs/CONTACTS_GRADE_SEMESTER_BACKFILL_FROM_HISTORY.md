# Contacts Grade Semester Backfill From History

Script khôi phục 3 trường điểm học kỳ từ lịch sử cập nhật (ModTracker) cho Contacts:

- `grade_semester_1_class_11` (fieldname: `cf_1444`)
- `grade_semester_2_class_11` (fieldname: `cf_1446`)
- `grade_semester_1_class_12` (fieldname: `cf_1448`)

Script path:

- `/var/www/html/cusc/migrate/20260416_contacts_grade_semester_backfill_from_history.php`

## Rule khôi phục

Script chỉ khôi phục khi thoa man tat ca dieu kien sau:

1. Gia tri hien tai cua ca 3 cot tren contact deu rong hoac bang `0`.
2. Trong `vtiger_modtracker_detail`, moi field (`cf_1444`, `cf_1446`, `cf_1448`) lay ban ghi `postvalue` moi nhat co gia tri khac rong va khac `0`.
3. Truoc khi `UPDATE`, script kiem tra lai dieu kien “ca 3 cot hien tai deu rong/0” ngay trong `WHERE` de tranh ghi de neu contact vua duoc cap nhat boi user khac.

Neu contact khong co du history hop le thi script se skip.

## Cach chay

### 1) Dry-run (khong ghi DB)

```bash
cd /var/www/html/cusc
php migrate/20260416_contacts_grade_semester_backfill_from_history.php --dry-run --verbose
```

### 2) Chay that

```bash
cd /var/www/html/cusc
php migrate/20260416_contacts_grade_semester_backfill_from_history.php --verbose
```

### 3) Co gioi han pham vi ID

```bash
cd /var/www/html/cusc
php migrate/20260416_contacts_grade_semester_backfill_from_history.php --start-id=140000 --end-id=170000 --limit=200 --sleep-ms=50 --verbose
```

### 4) Chi dinh file report

```bash
cd /var/www/html/cusc
php migrate/20260416_contacts_grade_semester_backfill_from_history.php --report-file=docs/reports/contacts_grade_semester_backfill_manual_check.md --verbose
```

## Report doi soat

Moi lan chay, script tao 1 file markdown report (mac dinh trong `docs/reports/`) voi ten dang:

- `contacts_grade_semester_backfill_YYYYMMDD_HHMMSS.md`

Report gom:

- Thong ke tong quan: scanned, restored, skipped, errors.
- Danh sach contact da khoi phuc theo **Ma lien he** (`contact_no`), kem:
  - `contactid`
  - 3 gia tri grade da restore
  - ModTracker ID nguon cua tung field (`cf_1444/cf_1446/cf_1448`)

## Kiem tra nhanh sau khi chay

```bash
cd /var/www/html/cusc
ls -1t docs/reports/contacts_grade_semester_backfill_*.md | head -n 3
```

Mo report moi nhat de doi soat list **Ma lien he** da duoc khoi phuc.
