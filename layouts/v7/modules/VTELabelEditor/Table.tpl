{*+***********************************************************************************
* The contents of this file are subject to the vtiger CRM Public License Version 1.0
* ("License"); You may not use this file except in compliance with the License
* The Original Code is: vtiger CRM Open Source
* The Initial Developer of the Original Code is vtiger.
* Portions created by vtiger are Copyright (C) vtiger.
* All Rights Reserved.
*************************************************************************************}
{strip}
    <table class="table table-bordered">
        <thead>
            <tr>
                <th style="width: 40%">Language Variable</th>
                <th style="width: 40%">Current Value</th>
                <th style="width: 20%">Action</th>
            </tr>
        </thead>
        <tbody>
        {foreach key=KEY item=VALUE from=$LANGUAGESTRINGS}
            <tr class="lang_element">
                <td>{$KEY}</td>
                <td><span class="current_value">{htmlentities($VALUE)}</span><input type="text" value="{htmlentities($VALUE)}" class="new_value inputElement hide"/></td>
                <td>
                    <a data-type='NOTJS' data-key="{$KEY}" data-value="{htmlentities($VALUE)}" href="javascript:void(0)" class="edit_label"><i class="fa fa-pencil"></i> Edit</a>
                    <button data-file_patch="{$FILE_PATCH}" data-type="NOTJS" data-key="{$KEY}" data-old_value="{htmlentities($VALUE)}" class="btn btn-success hide save_new_label">Save</button>
                    &nbsp;&nbsp;&nbsp;<button class="btn btn-warning hide cancel_save_new_label">Cancel</button>
                </td>
            </tr>
        {/foreach}
        {foreach key=KEY item=VALUE from=$JSLANGUAGESTRINGS}
            <tr class="lang_element">
                <td>{$KEY}</td>
                <td><span class="current_value">{htmlentities($VALUE)}</span><input type="text" value="{htmlentities($VALUE)}" class="new_value inputElement hide"/></td>
                <td>
                    <a data-type='NOTJS' data-key='{$KEY}' data-value="{htmlentities($VALUE)}" href="javascript:void(0)" class="edit_label"><i class="fa fa-pencil"></i> Edit</a>
                    <button data-file_patch='{$FILE_PATCH}' data-type='NOTJS' data-key='{$KEY}' data-old_value="{htmlentities($VALUE)}" class="btn btn-success hide save_new_label">Save</button>
                    &nbsp;&nbsp;&nbsp;<button class="btn btn-warning hide cancel_save_new_label">Cancel</button>
                </td>
            </tr>
        {/foreach}
        {*Start new row for add new label*}
        <tr class="lang_element row_new_label hide">
            <td><input type="text" value="" class="key_new_label inputElement"/></td>
            <td class="second"><input type="text" value="" class="new_value inputElement"/></td>
            <td>
                <a data-type='NOTJS' data-key='' data-value="" href="javascript:void(0)" class="edit_label hide"><i class="fa fa-pencil"></i> Edit</a>
                <button data-file_patch='{$FILE_PATCH}' data-type='NOTJS' data-key='' data-old_value='' data-is_new = '1' class="btn btn-success save_new_label">Save</button>
                &nbsp;&nbsp;&nbsp;<button class="btn btn-warning more_cancel_save_new_label">Cancel</button>
            </td>
        </tr>
        {*End new row for add new label*}
        </tbody>
    </table>
    <div class="setting-field col-sm-2" style="margin-left: -16px;margin-bottom: 13px;">
        <button class="btn btn-default" id="add_label" title="Add more Label"><i class="fa fa-plus"></i></button>
    </div>
{/strip}