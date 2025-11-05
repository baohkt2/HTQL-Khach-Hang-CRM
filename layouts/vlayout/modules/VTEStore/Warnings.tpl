<div id="globalmodal">
    <div id="massEditContainer" class="modelContainer" style="width: 950px;">
        <div class="modal-header contentsBackground">
            <button aria-hidden="true" class="close " data-dismiss="modal" type="button">×</button>
            <h3>{vtranslate('Warnings', 'VTEStore')} ({$WARNINGS})</h3>
        </div>
        <div class="slimScrollDiv" style="position: relative; overflow: scroll; width: auto; height: auto; max-height: 600px">
            <div name="massEditContent" style="overflow: hidden; width: auto; height: auto;">
                <div class="modal-body tabbable">
                    <div>
                        {vtranslate('It is recommended to have php.ini values set as above.','VTEStore')}
                    </div>
                    <div class="padding1per" style="border:1px solid #ccc;">
                        <div style="float: left;text-align: center;width: 100%;">
                            <span style="font-size: 15px;"><strong>PHP.ini {vtranslate('Requirements','VTEStore')}:</strong></span>
                            <span style="text-decoration: underline"><strong><br>{vtranslate('php_ini_desc','VTEStore')}</strong></span>
                        </div>
                        <table cellspacing="2px" cellpadding="2px">
                            <tr>
                                <td width="200"></td>
                                <td width="150"><strong>{vtranslate('Current Value','VTEStore')}</strong></td>
                                <td width="150"><strong>{vtranslate('Minimum Requirement','VTEStore')}</strong></td>
                                <td><strong>{vtranslate('Recommended Value','VTEStore')}</strong></td>
                            </tr>
                            <tr style="color: {if $default_socket_timeout>=60}#009900{else}#ff8000{/if}">
                                <td>default_socket_timeout</td>
                                <td>{$default_socket_timeout}</td>
                                <td>60</td>
                                <td style="color: {if $default_socket_timeout<600}#ff8000{else}#009900{/if}">600</td>
                            </tr>
                            <tr style="color: {if $max_execution_time>=60}#009900{else}#ff8000{/if}">
                                <td>max_execution_time</td>
                                <td>{$max_execution_time}</td>
                                <td>60</td>
                                <td style="color: {if $max_execution_time<600}#ff8000{else}#009900{/if}">600</td>
                            </tr>
                            <tr style="color: {if $max_input_time>=60 || $max_input_time==-1}#009900{else}#ff8000{/if}">
                                <td>max_input_time</td>
                                <td>{$max_input_time}</td>
                                <td>60</td>
                                <td style="color: {if $max_input_time<600 && $max_input_time!=-1}#ff8000{else}#009900{/if}">600</td>
                            </tr>
                            <tr style="color: {if $memory_limit>=256}#009900{else}#ff8000{/if}">
                                <td>memory_limit</td>
                                <td>{$memory_limit}M</td>
                                <td>256M</td>
                                <td style="color: {if $memory_limit<1028}#ff8000{else}#009900{/if}">1028M</td>
                            </tr>
                            <tr style="color: {if $post_max_size>=12}#009900{else}#ff8000{/if}">
                                <td>post_max_size</td>
                                <td>{$post_max_size}M</td>
                                <td>12M</td>
                                <td style="color: {if $post_max_size<50}#ff8000{else}#009900{/if}">50M</td>
                            </tr>
                            <tr style="color: {if $upload_max_filesize>=12}#009900{else}#ff8000{/if}">
                                <td>upload_max_filesize</td>
                                <td>{$upload_max_filesize}M</td>
                                <td>12M</td>
                                <td style="color: {if $upload_max_filesize<50}#ff8000{else}#009900{/if}">50M</td>
                            </tr>
                            <tr style="color: {if $simplexml==1}#009900{else}#ff8000{/if}">
                                <td>SimpleXML</td>
                                <td>{if $simplexml==1}{vtranslate('OK','VTEStore')}{else}{vtranslate('Not Installed','VTEStore')}{/if}</td>
                                <td></td>
                                <td></td>
                            </tr>
                            <tr style="color: {if $dieOnError=='false'}#009900{else}#ff8000{/if}">
                                <td>dieOnError</td>
                                <td>{$dieOnError}</td>
                                <td></td>
                                <td style="color: {if $dieOnError=='true'}#ff8000{else}#009900{/if}">false</td>
                            </tr>
                            <tr style="color: {if $mysqlStrictMode=='false'}#009900{else}#ff8000{/if}">
                                <td>Mysql Strict Mode</td>
                                <td>{if $mysqlStrictMode=='false'}{vtranslate('Correct','VTEStore')}{else}{vtranslate('Incorrect','VTEStore')}{/if}</td>
                                <td></td>
                                <td style="color: {if $mysqlStrictMode=='true'}#ff8000{else}#009900{/if}"></td>
                            </tr>
                            <tr>
                                <td colspan="4" style="text-align: center;">
                                    <a class="btn btn-primary" href="https://www.vtexperts.com/premium-extension-pack-php-ini-requirements/" target="_blank">Click here for php.ini instructions</a>
                                </td>
                            </tr>
                        </table>
                    </div>

                    <br><br>
                    <div class="padding1per" style="border:1px solid #ccc;">
                        <div style="text-align: center;width: 100%;">
                            <span style="font-size: 15px;"><strong>{vtranslate('Errors', 'VTEStore')} ({$ERROR_NUM})</strong></span>
                            <span style="text-decoration: underline"><strong><br>{vtranslate('error_desc','VTEStore')}</strong></span>
                        </div>

                        <div class="summaryWidgetContainer" style="border:1px solid #ccc; max-height: 350px; overflow: auto">
                            <table>
                                <tr>
                                    <td style="vertical-align: top;">
                                        <strong>{vtranslate('File Permissions', 'VTEStore')}:</strong>
                                        <br>{vtranslate('Folder', 'VTEStore')} layouts/vlayout/modules: {if $MESSAGES.layouts_vlayout_modules==1}<font color="green">OK</font>{else}<font color="red">{vtranslate('Insufficient permissions', 'VTEStore')}</font> <a href="https://www.vtexperts.com/vtiger-extension-insufficient-permissions/" target="_blank" style="text-decoration: underline!important;" style="text-decoration: underline!important;"> {vtranslate('LBL_MORE_DETAILS', 'VTEStore')}</a>{/if}
                                        <br>{vtranslate('Folder', 'VTEStore')} layouts/vlayout/modules/Settings: {if $MESSAGES.layouts_vlayout_modules_settings==1}<font color="green">OK</font>{else}<font color="red">{vtranslate('Insufficient permissions', 'VTEStore')}</font> <a href="https://www.vtexperts.com/vtiger-extension-insufficient-permissions/" target="_blank" style="text-decoration: underline!important;" style="text-decoration: underline!important;"> {vtranslate('LBL_MORE_DETAILS', 'VTEStore')}</a>{/if}
                                        {if $VTVERSION=='vt7'}
                                            <br>Folder layouts/v7/modules: {if $MESSAGES.layouts_v7_modules==1}<font color="green">OK</font>{else}<font color="red">{vtranslate('Insufficient permissions', 'VTEStore')}</font> <a href="https://www.vtexperts.com/vtiger-extension-insufficient-permissions/" target="_blank" style="text-decoration: underline!important;"> {vtranslate('LBL_MORE_DETAILS', 'VTEStore')}</a>{/if}
                                            <br>Folder layouts/v7/modules/Settings: {if $MESSAGES.layouts_v7_modules_settings==1}<font color="green">OK</font>{else}<font color="red">{vtranslate('Insufficient permissions', 'VTEStore')}</font>{/if}
                                            <br>Folder layouts/v7/modules/Settings/Workflows/Tasks: {if $MESSAGES.layouts_v7_modules_settings_workflows_tasks==1}<font color="green">OK</font>{else}<font color="red">{vtranslate('Insufficient permissions', 'VTEStore')}</font>{/if}
                                        {/if}
                                        <br>{vtranslate('Folder', 'VTEStore')} modules: {if $MESSAGES.modules==1}<font color="green">OK</font>{else}<font color="red">{vtranslate('Insufficient permissions', 'VTEStore')}</font> <a href="https://www.vtexperts.com/vtiger-extension-insufficient-permissions/" target="_blank" style="text-decoration: underline!important;"> {vtranslate('LBL_MORE_DETAILS', 'VTEStore')}</a>{/if}
                                        <br>{vtranslate('Folder', 'VTEStore')} user_privileges: {if $MESSAGES.user_privileges==1}<font color="green">OK</font>{else}<font color="red">{vtranslate('Insufficient permissions', 'VTEStore')}</font> <a href="https://www.vtexperts.com/vtiger-extension-insufficient-permissions/" target="_blank" style="text-decoration: underline!important;"> {vtranslate('LBL_MORE_DETAILS', 'VTEStore')}</a>{/if}
                                        <br>{vtranslate('User Ids Insufficient permissions', 'VTEStore')} sharing_file: {if !empty($MESSAGES.insufficient_permissions_sharing_file)}<font color="red">{', '|implode:$MESSAGES.insufficient_permissions_sharing_file} </font> {else}<font color="green">0</font>{/if}
                                        <br>{vtranslate('User Ids Insufficient permissions', 'VTEStore')} privileges_file: {if !empty($MESSAGES.insufficient_permissions_privileges_file)}<font color="red">{', '|implode:$MESSAGES.insufficient_permissions_privileges_file} </font> {else}<font color="green">0</font>{/if}
                                        <br>{vtranslate('Folder', 'VTEStore')} test: {if $MESSAGES.test==1}<font color="green">OK</font>{else}<font color="red">{vtranslate('Insufficient permissions', 'VTEStore')}</font> <a href="https://www.vtexperts.com/vtiger-extension-insufficient-permissions/" target="_blank" style="text-decoration: underline!important;"> {vtranslate('LBL_MORE_DETAILS', 'VTEStore')}</a>{/if}
                                        <br>{vtranslate('Folder', 'VTEStore')} test/templates_c/v7: {if $MESSAGES.test_templates_c_vlayout==1}<font color="green">OK</font>{else}<font color="red">{vtranslate('Insufficient permissions', 'VTEStore')}</font> <a href="https://www.vtexperts.com/vtiger-extension-insufficient-permissions/" target="_blank" style="text-decoration: underline!important;"> {vtranslate('LBL_MORE_DETAILS', 'VTEStore')}</a>{/if}
                                        <br>{vtranslate('Folder', 'VTEStore')} test/vtlib: {if $MESSAGES.test_vtlib==1}<font color="green">OK</font>{else}<font color="red">{vtranslate('Insufficient permissions', 'VTEStore')}</font> <a href="https://www.vtexperts.com/vtiger-extension-insufficient-permissions/" target="_blank" style="text-decoration: underline!important;"> {vtranslate('LBL_MORE_DETAILS', 'VTEStore')}</a>{/if}
                                        <br>{vtranslate('Folder', 'VTEStore')} storage: {if $MESSAGES.storage==1}<font color="green">OK</font>{else}<font color="red">{vtranslate('Insufficient permissions', 'VTEStore')}</font> <a href="https://www.vtexperts.com/vtiger-extension-insufficient-permissions/" target="_blank" style="text-decoration: underline!important;"> {vtranslate('LBL_MORE_DETAILS', 'VTEStore')}</a>{/if}
                                        <br>{vtranslate('Folder', 'VTEStore')} cache: {if $MESSAGES.cache==1}<font color="green">OK</font>{else}<font color="red">{vtranslate('Insufficient permissions', 'VTEStore')}</font> <a href="https://www.vtexperts.com/vtiger-extension-insufficient-permissions/" target="_blank" style="text-decoration: underline!important;"> {vtranslate('LBL_MORE_DETAILS', 'VTEStore')}</a>{/if}
                                    </td>
                                    <td style="vertical-align: top; padding-left: 10px">
                                        <br>{vtranslate('File', 'VTEStore')} tabdata.php: {if $MESSAGES.tabdata==1}<font color="green">OK</font>{else}<font color="red">{vtranslate('Insufficient permissions', 'VTEStore')}</font> <a href="https://www.vtexperts.com/vtiger-extension-insufficient-permissions/" target="_blank" style="text-decoration: underline!important;"> {vtranslate('LBL_MORE_DETAILS', 'VTEStore')}</a>{/if}
                                        <br>{vtranslate('File', 'VTEStore')} parent_tabdata.php: {if $MESSAGES.parent_tabdata==1}<font color="green">OK</font>{else}<font color="red">{vtranslate('Insufficient permissions', 'VTEStore')}</font> <a href="https://www.vtexperts.com/vtiger-extension-insufficient-permissions/" target="_blank" style="text-decoration: underline!important;"> {vtranslate('LBL_MORE_DETAILS', 'VTEStore')}</a>{/if}
                                        <br>{vtranslate('File', 'VTEStore')} config.inc.php: {if $MESSAGES.config==1}<font color="green">OK</font>{else}<font color="red">$root_directory missing '/' at the end</font> <a href="https://www.vtexperts.com/vtiger-extension-insufficient-permissions/" target="_blank" style="text-decoration: underline!important;"> {vtranslate('LBL_MORE_DETAILS', 'VTEStore')}</a>{/if}
                                        <br>{vtranslate('Folder', 'VTEStore')} languages: {if !empty($MESSAGES.language_folder_missing) || !empty($MESSAGES.insufficient_permissions_language_folder)}<font color="red">{$MESSAGES.language_folder_missing|@count + $MESSAGES.insufficient_permissions_language_folder|@count}</font>{else}<font color="green">OK</font>{/if}
                                        {if !empty($MESSAGES.language_folder_missing)}<br>{vtranslate('Language Folder Missing', 'VTEStore')}: <font color="red">{', '|implode:$MESSAGES.language_folder_missing}</font>{/if}
                                        {if !empty($MESSAGES.insufficient_permissions_language_folder)}<br>{vtranslate('Insufficient Permissions Language Folder', 'VTEStore')}: <font color="red">{', '|implode:$MESSAGES.insufficient_permissions_language_folder}</font>{/if}
                                        <br>{vtranslate('Folder', 'VTEStore')} modules/Settings: {if $MESSAGES.modules_settings==1}<font color="green">OK</font>{else}<font color="red">{vtranslate('Insufficient permissions', 'VTEStore')}</font>{/if}
                                        <br>{vtranslate('Folder', 'VTEStore')} modules/com_vtiger_workflow/tasks: {if $MESSAGES.modules_com_vtiger_workflow_tasks==1}<font color="green">OK</font>{else}<font color="red">{vtranslate('Insufficient permissions', 'VTEStore')}</font>{/if}
                                    </td>
                                    <td style="vertical-align: top; padding-left: 10px">
                                        <strong>{vtranslate('Users and Roles', 'VTEStore')}:</strong>
                                        <br>{vtranslate('User Ids Invalid Id', 'VTEStore')}: {if !empty($MESSAGES.user_ids_invalid)}<font color="red">{', '|implode:$MESSAGES.user_ids_invalid} </font> <a class="user_ids_invalid" data-url="index.php?module=VTEStore&action=ActionAjax&mode=userIdsInvalid&userids={','|implode:$MESSAGES.user_ids_invalid}" style="text-decoration: underline!important;">{vtranslate('Click here to fix', 'VTEStore')}</a>{else}<font color="green">0</font>{/if}
                                        <br>{vtranslate('User Ids Invalid Role', 'VTEStore')}: {if !empty($MESSAGES.user_ids_invalid_role)}<font color="red">{', '|implode:$MESSAGES.user_ids_invalid_role} </font> <a class="user_ids_invalid_role" data-url="index.php?module=VTEStore&action=ActionAjax&mode=userIdsInvalidRole&userids={','|implode:$MESSAGES.user_ids_invalid_role}" style="text-decoration: underline!important;">{vtranslate('Click here to fix', 'VTEStore')}</a>{else}<font color="green">0</font>{/if}
                                        <br>{vtranslate('User Ids Missing', 'VTEStore')} sharing_file: {if !empty($MESSAGES.user_ids_missing_sharing_file)}<font color="red">{', '|implode:$MESSAGES.user_ids_missing_sharing_file} </font> <a class="user_ids_missing_file" data-url="index.php?module=VTEStore&action=ActionAjax&mode=userIdsMissingFile&userids={','|implode:$MESSAGES.user_ids_missing_sharing_file}" style="text-decoration: underline!important;">{vtranslate('Click here to fix', 'VTEStore')}</a>{else}<font color="green">0</font>{/if}
                                        <br>{vtranslate('User Ids Missing', 'VTEStore')} privileges_file: {if !empty($MESSAGES.user_ids_missing_privileges_file)}<font color="red">{', '|implode:$MESSAGES.user_ids_missing_privileges_file} </font> <a class="user_ids_missing_file" data-url="index.php?module=VTEStore&action=ActionAjax&mode=userIdsMissingFile&userids={','|implode:$MESSAGES.user_ids_missing_privileges_file}" style="text-decoration: underline!important;">{vtranslate('Click here to fix', 'VTEStore')}</a>{else}<font color="green">0</font>{/if}
                                        {*<br>User Ids sharing_file syntax errors: {if !empty($MESSAGES.user_ids_sharing_file_syntax_errors)}<font color="red">{', '|implode:$MESSAGES.user_ids_sharing_file_syntax_errors}</font>{else}<font color="green">0</font>{/if}
                                        <br>User Ids privileges_file syntax errors: {if !empty($MESSAGES.user_ids_privileges_file_syntax_errors)}<font color="red">{', '|implode:$MESSAGES.user_ids_privileges_file_syntax_errors} </font> {else}<font color="green">0</font>{/if}*}
                                        {if $USER_AND_ROLE_ERROR==1}
                                            <br><br><span style="color: #0000ff">{vtranslate('fix_user_and_role', 'VTEStore')}</span>
                                        {/if}
                                        <br /><br />
                                        <strong>{vtranslate('PHP.ini Requirements', 'VTEStore')}:</strong>
                                        <br>max_input_vars: {if $max_input_vars>=10000}<font color="green">OK</font>{else}<font color="red">{vtranslate('`max_input_vars` should be greater than 10.000', 'VTEStore')}</font> <a href="https://www.vtexperts.com/premium-extension-pack-php-ini-requirements/" target="_blank" style="text-decoration: underline!important;"> {vtranslate('LBL_MORE_DETAILS', 'VTEStore')}</a>{/if}
                                    </td>
                                </tr>
                            </table>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div style="float: left;padding-top: 10px;text-align: center;width: 100%; line-height: 24px;">
                        Need help? Contact us - the support is free.<br>
                        <b>Email</b>: help@vtexperts.com&nbsp;-&nbsp;<b>Phone</b>: +1 (818) 495-5557<br>
                        <a href="javascript:void(0);" onclick="window.open('https://v2.zopim.com/widget/livechat.html?&amp;key=1P1qFzYLykyIVMZJPNrXdyBilLpj662a=en', '_blank', 'location=yes,height=600,width=500,scrollbars=yes,status=yes');"> <img src="layouts/vlayout/modules/VTEStore/resources/images/livechat.png" style="height: 28px"></a><br>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <div class="pull-right cancelLinkContainer" style="margin-top: 0px;"><a class="cancelLink" type="reset" data-dismiss="modal"><strong>{vtranslate('LBL_CLOSE', $MODULE)}</strong></a></div>
        </div>
    </div>
</div>
