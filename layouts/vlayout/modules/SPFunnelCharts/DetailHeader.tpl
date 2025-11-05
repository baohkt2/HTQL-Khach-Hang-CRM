{*<!--
/*+**********************************************************************************
 * Advanced Funnel Charts by SalesPlatform
 * Copyright (C) 2011-2016 SalesPlatform Ltd
 * All Rights Reserved.
 * This extension is licensed to be used within one instance of Vtiger CRM.
 * Source code or binaries may not be redistributed unless expressly permitted by SalesPlatform Ltd.
 * If you have any questions or comments, please email: extensions@salesplatform.ru
 ************************************************************************************/
-->*}

<br>
<div class="container-fluid">
    <div class="row-fluid reportHeader">
        <div class="textAlignCenter">
            <h3>{$MODEL->getName()}</h3>
        </div>
    </div>
    <div class="row-fluid">
        <div class="btn-toolbar pull-right">
            {if $MODEL->isEditable() eq true}
                <div class="btn-group">
                    <button onclick='window.location.href="{$MODEL->getEditViewUrl()}"' type="button" class="cursorPointer btn">
                        <strong>{vtranslate('LBL_EDIT', $MODULE)}</strong>&nbsp;
                        <i class="icon-pencil"></i>
                    </button>
                </div>
            {/if}
            <div class="btn-group">
                <button onclick='window.location.href="{$MODEL->getDuplicateRecordUrl()}"' type="button" class="cursorPointer btn">
                    <strong>{vtranslate('LBL_DUPLICATE', $MODULE)}</strong>
                </button>
            </div>
        </div>
   </div>
</div>
            