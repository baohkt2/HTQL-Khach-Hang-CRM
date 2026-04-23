# Walkthrough: Accounts follow/network/email stats

## Goal
Update Accounts statistics from linked Contacts with minimum data scope:
- `cf_2140 = total_statuses - pending_contact`
- network counters from Contacts field `mobile_networks`
- email counter from Contacts field `email` (exclude empty/default)

## Runtime flow
1. Database trigger on `vtiger_accountscf` keeps `cf_2140` in sync whenever `total_statuses` or `pending_contact` changes.
2. Contacts realtime event handler (`vtiger.entity.aftersave/afterdelete/afterrestore`) recalculates:
   - `cf_2142`, `cf_2144`, `cf_2146`, `cf_2148`, `cf_2156`
3. Contacts batch event handler (`vtiger.batchevent.save`) recalculates the same fields for import/bulk save paths.
4. Backfill script updates only in-scope fields for all active Accounts.

## Test checklist
1. Create or update a Contact linked to an Account with `mobile_networks='Viettel'` and valid email.
2. Save Contact and verify target Account fields update.
3. Change Contact to another network and verify previous/new network counters are adjusted.
4. Set Contact email to empty or `example@gmail.com`; verify `cf_2156` decreases.
5. Change Contact `account_id`; verify both old and new Accounts are recalculated.
6. Run backfill script and verify no unexpected field updates outside:
   - `cf_2140`, `cf_2142`, `cf_2144`, `cf_2146`, `cf_2148`, `cf_2156`.
