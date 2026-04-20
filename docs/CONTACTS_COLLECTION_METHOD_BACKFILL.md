# Contacts Collection Method Backfill

Script dong bo gia tri tu truong text `information_collection_method` sang picklist `collection_method` cho module Contacts.

Script path:

- `/var/www/html/cusc/migrate/20260420_contacts_collection_method_backfill.php`

## Rang buoc bat buoc

Script chi cho phep chay tren DB:

- `cusc_db_bk_200426`

Neu `target-db` khac DB tren, script se dung ngay.

## Rule cap nhat

Chi xu ly contact thoa tat ca dieu kien:

1. `information_collection_method` khac rong va khac `0`.
2. `collection_method` hien tai dang rong (`NULL`, chuoi rong, hoac `0`).
3. Gia tri `information_collection_method` thuoc bang map duoi day.

Bang map:

| information_collection_method | collection_method |
|---|---|
| Trực tiếp | Trực tiếp |
| Ghi danh | Ghi danh |
| Tư vấn trực tiếp | Tư vấn trực tiếp |
| Thu thập thông tin | Thu thập thông tin |

Gia tri ngoai bang map se bi bo qua.

Luu y chuan hoa truoc khi map:

- Trim khoang trang dau/cuoi.
- Chuan hoa nhieu khoang trang lien tiep thanh 1 khoang trang.
- Chuyen ve lowercase de so khop khong phan biet hoa/thuong.
- Decode HTML entity (vi du `th&ocirc;ng` -> `thông`) truoc khi doi chieu.

## Cach chay

### 1) Dry-run (khong ghi DB)

```bash
cd /var/www/html/cusc
php migrate/20260420_contacts_collection_method_backfill.php --dry-run --verbose
```

### 2) Chay that

```bash
cd /var/www/html/cusc
php migrate/20260420_contacts_collection_method_backfill.php --verbose
```

### 3) Chay theo pham vi ID

```bash
cd /var/www/html/cusc
php migrate/20260420_contacts_collection_method_backfill.php --start-id=140000 --end-id=170000 --limit=300 --sleep-ms=25 --verbose
```

## Output va doi soat

Moi lan chay script tao:

1. Report markdown: `docs/reports/contacts_collection_method_backfill_YYYYMMDD_HHMMSS.md`
2. Backup CSV (khi chay that): `logs/backfill_contacts_collection_method_YYYYMMDD_HHMMSS.csv`

Backup CSV luu cac cot:

- `contactid`
- `contact_no`
- `old_collection_method`
- `information_collection_method`
- `new_collection_method`

## Kiem tra nhanh sau khi chay

Kiem tra report moi nhat:

```bash
cd /var/www/html/cusc
ls -1t docs/reports/contacts_collection_method_backfill_*.md | head -n 3
```

Kiem tra so ban ghi da dong bo:

```sql
SELECT COUNT(*) AS synced_count
FROM vtiger_contactscf scf
INNER JOIN vtiger_crmentity ce ON ce.crmid = scf.contactid
WHERE ce.deleted = 0
  AND ce.setype = 'Contacts'
  AND TRIM(COALESCE(scf.information_collection_method, '')) <> ''
  AND TRIM(COALESCE(scf.information_collection_method, '')) NOT REGEXP '^(0+|0+\\.0+)$'
  AND TRIM(COALESCE(scf.collection_method, '')) IN ('Trực tiếp', 'Ghi danh', 'Tư vấn trực tiếp', 'Thu thập thông tin');
```

## Ghi chu rollback

Neu can rollback, dung file CSV backup vua tao de cap nhat lai gia tri `collection_method` theo `old_collection_method`.
