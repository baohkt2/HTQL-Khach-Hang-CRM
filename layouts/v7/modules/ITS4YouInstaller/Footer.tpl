{*<!--
/* * *******************************************************************************
* The content of this file is subject to the MultiWarehouses4You license.
* ("License"); You may not use this file except in compliance with the License
* The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
* Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
* All Rights Reserved.
* ****************************************************************************** */
-->*}

{strip}
    <br>
    <div class="small" style="color: rgb(153, 153, 153);text-align: center;">{vtranslate($MODULE,$MODULE)} {ITS4YouInstaller_Version_Helper::$version} {vtranslate("COPYRIGHT",$QUALIFIED_MODULE)}</div>
    {include file="Footer.tpl"|@vtemplate_path:'Vtiger'}
{/strip}