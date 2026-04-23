# Walkthrough: Accounts follow/network/email/phone/zalo stats

## Goal
Update Accounts statistics from linked Contacts with minimum data scope:
- `cf_2140 = total_statuses - pending_contact`
- network counters from Contacts field `mobile_networks`
- email counter from Contacts field `email` (exclude empty/default)
- phone counter from Contacts field `mobile` (exclude empty)
- Contacts `cf_2162` (Da follow zalo) derived from `follow_result_zalo` and `follow_result_zalo_2`
- Accounts `cf_2164` as total linked Contacts where `cf_2162 = 1`

## Runtime flow
1. Database trigger on `vtiger_accountscf` keeps `cf_2140` in sync whenever `total_statuses` or `pending_contact` changes.
2. Contacts realtime event handler (`vtiger.entity.aftersave/afterdelete/afterrestore`) recalculates:
   - `cf_2142`, `cf_2144`, `cf_2146`, `cf_2148`, `cf_2156`, `cf_2158`, `cf_2164`
3. Contacts realtime handler `ContactLastFollowupHandler` maintains `cf_2162`:
   - if at least one of `follow_result_zalo`, `follow_result_zalo_2` is not empty => `cf_2162 = 1`
   - if both are empty => `cf_2162 = 0`
4. Contacts batch event handler (`vtiger.batchevent.save`) recalculates the same fields for import/bulk save paths.
5. Backfill script updates only in-scope fields for all active Accounts.

## Test checklist
1. Create or update a Contact linked to an Account with `mobile_networks='Viettel'` and valid email.
2. Save Contact and verify target Account fields update.
3. Change Contact to another network and verify previous/new network counters are adjusted.
4. Set Contact email to empty or `example@gmail.com`; verify `cf_2156` decreases.
5. Set Contact mobile to empty/non-empty and verify `cf_2158` changes.
6. Set/clear `follow_result_zalo` and `follow_result_zalo_2`; verify `cf_2162` toggles correctly.
7. Verify `cf_2164` equals number of linked Contacts where `cf_2162 = 1`.
8. Change Contact `account_id`; verify both old and new Accounts are recalculated.
9. Run backfill script and verify no unexpected field updates outside:
   - Contacts: `cf_2162`
   - Accounts: `cf_2140`, `cf_2142`, `cf_2144`, `cf_2146`, `cf_2148`, `cf_2156`, `cf_2158`, `cf_2164`.
