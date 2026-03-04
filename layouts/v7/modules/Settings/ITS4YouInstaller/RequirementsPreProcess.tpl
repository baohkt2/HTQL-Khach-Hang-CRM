<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <br>
            <div class="clearfix">
                <h4 class="pull-left"><b>{vtranslate($REQUIREMENTS_TITLE, $QUALIFIED_MODULE)}</b></h4>
                <div class="pull-right">
                    <select id="source_module" class="select2" style="width: 300px;">
                        <optgroup label="{vtranslate('LBL_SYSTEM_REQUIREMENTS', $QUALIFIED_MODULE)}">
                            <option value="index.php?module=ITS4YouInstaller&parent=Settings&view=Requirements">{vtranslate('LBL_SYSTEM', $QUALIFIED_MODULE)}</option>
                        </optgroup>
                        <optgroup label="{vtranslate('LBL_MODULE_REQUIREMENTS', $QUALIFIED_MODULE)}">
                            {foreach from=$SOURCE_MODULES item=SOURCE_MODULE}
                                <option value="{$SOURCE_MODULE->getDefaultUrl()}" {if $SOURCE_MODULE_NAME eq $SOURCE_MODULE->getModuleName()} selected="selected" {/if}>{$SOURCE_MODULE->getModuleLabel()}</option>
                            {/foreach}
                        </optgroup>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>