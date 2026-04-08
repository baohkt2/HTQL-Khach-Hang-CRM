# Accounts Student Count Backfill and Daily Cron (2026-04-08)

## Context

- Field: `vtiger_accountscf.cf_2090`
- Functional meaning: Accounts student count, synchronized from linked active Contacts
- Existing realtime sync handler already exists:
  - `modules/Accounts/handlers/AccountStudentCountHandler.php`
- Issue: historical Accounts data had stale/incorrect values, so a backfill + daily correction cron was required.

## What was implemented

### 1) New backfill script

File:

- `migrate/20260408_accounts_student_count_backfill.php`

Behavior:

- Recomputes student count from `vtiger_contactdetails.accountid` + `vtiger_crmentity.deleted = 0`.
- Writes to `vtiger_accountscf.cf_2090` using `INSERT ... ON DUPLICATE KEY UPDATE`.
- Supports mode:
  - default: backfill all active Accounts
  - `--only-mismatched`: update only rows where current value differs from computed value
- Prints mismatch count before/after for verification.

### 2) New daily cron wrapper

File:

- `cron/backfill_account_student_count_daily.sh`

Behavior:

- Uses lock file (`flock`) to prevent overlapping runs.
- Uses `nice -n 10` to lower CPU priority.
- Logs to `logs/backfill_account_student_count_daily.log`.
- Default mode is lightweight daily correction (`BACKFILL_ONLY_MISMATCHED=1`).

### 3) Cron docs updated

Files:

- `cron/ACCOUNTS_STUDENT_COUNT_BACKFILL_CRON.md` (new)
- `cron/CRON_SETUP_GUIDE.md` (updated section)

## Execution performed

### Syntax checks

```bash
php -l migrate/20260408_accounts_student_count_backfill.php
bash -n cron/backfill_account_student_count_daily.sh
```

Result:

- PHP syntax OK.
- Shell script syntax OK.

### Manual backfill run

```bash
/bin/bash /var/www/html/cusc/cron/backfill_account_student_count_daily.sh
```

Observed result from log:

- `Mismatched before: 19`
- `Mismatched after: 0`
- Exit status `0`

## Cron installation (00:00 daily)

Installed crontab entry:

```cron
0 0 * * * /bin/bash /var/www/html/cusc/cron/backfill_account_student_count_daily.sh >> /var/www/html/cusc/logs/cron_output.log 2>&1
```

Verification:

- `crontab -l` contains the entry above.

## Operations notes

- Manual dry run command:

```bash
/bin/bash /var/www/html/cusc/cron/backfill_account_student_count_daily.sh
```

- Force full refresh (all active Accounts):

```bash
BACKFILL_ONLY_MISMATCHED=0 /bin/bash /var/www/html/cusc/cron/backfill_account_student_count_daily.sh
```
