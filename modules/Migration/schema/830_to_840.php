<?php
if (defined('VTIGER_UPGRADE')) {
    global $adb, $current_user;
    $db = PearDatabase::getInstance();

    // MailScanner
    $db->pquery("ALTER TABLE vtiger_mailscanner ADD COLUMN auth_type VARCHAR(20) AFTER sslmethod");
    $db->pquery("ALTER TABLE vtiger_mailscanner ADD COLUMN auth_expireson LONG AFTER auth_type");
    $db->pquery("ALTER TABLE vtiger_mailscanner ADD COLUMN mail_proxy VARCHAR(50) AFTER auth_expireson");

    // Webforms: Shift foreign key from (fieldname to fieldid) and set existing values.
    $db->pquery("ALTER TABLE vtiger_webforms_field drop foreign key fk_3_vtiger_webforms_field"); /* on fieldname */
    $db->pquery("ALTER TABLE vtiger_webforms_field add column fieldid int(19) after webformid"); 
    $db->pquery("ALTER TABLE vtiger_webforms_field add constraint fk_4_vtiger_webforms_field foreign key (fieldid) references vtiger_field(fieldid) on delete cascade");
    $db->pquery("UPDATE vtiger_webforms_field wf_field join vtiger_webforms wf on wf.id=wf_field.webformid join vtiger_tab m on m.name=wf.targetmodule join vtiger_field field on field.tabid=m.tabid and field.fieldname=wf_field.fieldname set wf_field.fieldid=field.fieldid where wf_field.fieldid is NULL");

}