{*
    PDFMaker2 — Edit View Template
    Template editor with CKEditor and field picker sidebar.
*}
{strip}
<div class="editViewPageDiv">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="editViewContainer">
            <form name="EditTemplate" action="index.php" method="post" id="pdfmaker2EditForm" class="form-horizontal">
                <input type="hidden" name="module" value="PDFMaker2">
                <input type="hidden" name="action" value="Save">
                <input type="hidden" name="parent" value="Settings">
                {if $TEMPLATE_DATA}
                    <input type="hidden" name="templateid" value="{$TEMPLATE_DATA->get('templateid')}">
                {/if}

                <h4>
                    {if $TEMPLATE_DATA}
                        {vtranslate('LBL_EDIT_TEMPLATE', 'PDFMaker2')} - {$TEMPLATE_DATA->get('template_name')|escape:'html'}
                    {else}
                        {vtranslate('LBL_NEW_TEMPLATE', 'PDFMaker2')}
                    {/if}
                </h4>
                <hr>

                <div class="editViewBody">
                    {* Template Name *}
                    <div class="form-group row">
                        <label class="col-lg-2 fieldLabel control-label">
                            {vtranslate('LBL_TEMPLATE_NAME', 'PDFMaker2')}&nbsp;<span class="redColor">*</span>
                        </label>
                        <div class="fieldValue col-lg-10">
                            <div class="row"><div class="col-lg-6">
                                <input class="inputElement" type="text" name="template_name"
                                       value="{if $TEMPLATE_DATA}{$TEMPLATE_DATA->get('template_name')|escape:'html'}{/if}"
                                       data-rule-required="true" placeholder="{vtranslate('LBL_ENTER_TEMPLATE_NAME', 'PDFMaker2')}">
                            </div></div>
                        </div>
                    </div>

                    {* Description *}
                    <div class="form-group row">
                        <label class="col-lg-2 fieldLabel control-label">
                            {vtranslate('LBL_DESCRIPTION', 'PDFMaker2')}
                        </label>
                        <div class="fieldValue col-lg-10">
                            <div class="row"><div class="col-lg-6">
                                <textarea class="inputElement" name="description" rows="2"
                                    placeholder="{vtranslate('LBL_ENTER_DESCRIPTION', 'PDFMaker2')}">{if $TEMPLATE_DATA}{$TEMPLATE_DATA->get('description')|escape:'html'}{/if}</textarea>
                            </div></div>
                        </div>
                    </div>

                    {* Target Modules *}
                    <div class="form-group row">
                        <label class="col-lg-2 fieldLabel control-label">
                            {vtranslate('LBL_TARGET_MODULES', 'PDFMaker2')}&nbsp;<span class="redColor">*</span>
                        </label>
                        <div class="fieldValue col-lg-10">
                            <div class="row"><div class="col-lg-6">
                                <select class="inputElement select2" name="target_modules[]" id="targetModules" multiple="multiple" data-rule-required="true">
                                    {foreach item=MOD from=$ENTITY_MODULES}
                                        <option value="{$MOD.name}"
                                            {if $TEMPLATE_DATA}
                                                {foreach item=AM from=$TEMPLATE_DATA->get('assigned_modules')}
                                                    {if $AM.module_name == $MOD.name}selected{/if}
                                                {/foreach}
                                            {/if}
                                        >{$MOD.label}</option>
                                    {/foreach}
                                </select>
                            </div></div>
                        </div>
                    </div>

                    {* Page Settings Row *}
                    <div class="form-group row">
                        <label class="col-lg-2 fieldLabel control-label">
                            {vtranslate('LBL_PAGE_SETTINGS', 'PDFMaker2')}
                        </label>
                        <div class="fieldValue col-lg-10">
                            <div class="row">
                                <div class="col-lg-2">
                                    <label class="muted">{vtranslate('LBL_FORMAT', 'PDFMaker2')}</label>
                                    <select class="inputElement" name="format">
                                        {foreach item=FMT from=['A4','A3','A5','Letter','Legal']}
                                            <option value="{$FMT}" {if $TEMPLATE_DATA && $TEMPLATE_DATA->get('format') == $FMT}selected{/if}>{$FMT}</option>
                                        {/foreach}
                                    </select>
                                </div>
                                <div class="col-lg-2">
                                    <label class="muted">{vtranslate('LBL_ORIENTATION', 'PDFMaker2')}</label>
                                    <select class="inputElement" name="orientation">
                                        <option value="portrait" {if !$TEMPLATE_DATA || $TEMPLATE_DATA->get('orientation') == 'portrait'}selected{/if}>{vtranslate('LBL_PORTRAIT', 'PDFMaker2')}</option>
                                        <option value="landscape" {if $TEMPLATE_DATA && $TEMPLATE_DATA->get('orientation') == 'landscape'}selected{/if}>{vtranslate('LBL_LANDSCAPE', 'PDFMaker2')}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row" style="margin-top:8px">
                                <div class="col-lg-1">
                                    <label class="muted">{vtranslate('LBL_MARGIN_TOP', 'PDFMaker2')}</label>
                                    <input class="inputElement" type="number" name="margin_top" value="{if $TEMPLATE_DATA}{$TEMPLATE_DATA->get('margin_top')}{else}10{/if}" min="0" step="1">
                                </div>
                                <div class="col-lg-1">
                                    <label class="muted">{vtranslate('LBL_MARGIN_BOTTOM', 'PDFMaker2')}</label>
                                    <input class="inputElement" type="number" name="margin_bottom" value="{if $TEMPLATE_DATA}{$TEMPLATE_DATA->get('margin_bottom')}{else}10{/if}" min="0" step="1">
                                </div>
                                <div class="col-lg-1">
                                    <label class="muted">{vtranslate('LBL_MARGIN_LEFT', 'PDFMaker2')}</label>
                                    <input class="inputElement" type="number" name="margin_left" value="{if $TEMPLATE_DATA}{$TEMPLATE_DATA->get('margin_left')}{else}10{/if}" min="0" step="1">
                                </div>
                                <div class="col-lg-1">
                                    <label class="muted">{vtranslate('LBL_MARGIN_RIGHT', 'PDFMaker2')}</label>
                                    <input class="inputElement" type="number" name="margin_right" value="{if $TEMPLATE_DATA}{$TEMPLATE_DATA->get('margin_right')}{else}10{/if}" min="0" step="1">
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {* Editor + Field Picker Side by Side *}
                    <div class="row">
                        {* CKEditor *}
                        <div class="col-lg-9">
                            <h5>{vtranslate('LBL_HEADER', 'PDFMaker2')}</h5>
                            <textarea name="header" id="pdfmaker2Header" class="ckeditor-input" rows="4">{if $TEMPLATE_DATA}{$TEMPLATE_DATA->get('header')}{/if}</textarea>

                            <h5 style="margin-top:15px">{vtranslate('LBL_BODY', 'PDFMaker2')}&nbsp;<span class="redColor">*</span></h5>
                            <textarea name="body" id="pdfmaker2Body" class="ckeditor-input" rows="20">{if $TEMPLATE_DATA}{$TEMPLATE_DATA->get('body')}{/if}</textarea>

                            <h5 style="margin-top:15px">{vtranslate('LBL_FOOTER', 'PDFMaker2')}</h5>
                            <textarea name="footer" id="pdfmaker2Footer" class="ckeditor-input" rows="4">{if $TEMPLATE_DATA}{$TEMPLATE_DATA->get('footer')}{/if}</textarea>
                        </div>

                        {* Field Picker Sidebar *}
                        <div class="col-lg-3">
                            <div id="fieldPickerPanel" style="border:1px solid #ddd;border-radius:4px;padding:10px;max-height:700px;overflow-y:auto">
                                <h5>
                                    <i class="fa fa-list"></i>&nbsp;{vtranslate('LBL_FIELD_PICKER', 'PDFMaker2')}
                                </h5>
                                <p class="text-muted small">{vtranslate('LBL_FIELD_PICKER_HELP', 'PDFMaker2')}</p>

                                <div id="fieldPickerContent">
                                    {if count($MODULE_FIELDS) > 0}
                                        {foreach item=BLOCK from=$MODULE_FIELDS}
                                            <div class="fieldPickerBlock" style="margin-bottom:8px">
                                                <strong class="small" style="cursor:pointer;display:block;padding:4px;background:#f5f5f5;border-radius:3px"
                                                    onclick="jQuery(this).next('.fieldList').toggle()">
                                                    <i class="fa fa-caret-right"></i>&nbsp;{$BLOCK.label}
                                                </strong>
                                                <div class="fieldList" style="display:none;padding-left:8px">
                                                    {foreach item=FIELD from=$BLOCK.fields}
                                                        <div class="fieldPickerItem" style="padding:2px 0;cursor:pointer"
                                                             data-variable="{$FIELD.variable}"
                                                             title="{vtranslate('LBL_CLICK_TO_INSERT', 'PDFMaker2')} {$FIELD.variable}">
                                                            <code class="small">{$FIELD.variable}</code><br>
                                                            <span class="text-muted small">{$FIELD.fieldlabel}</span>
                                                        </div>
                                                    {/foreach}
                                                </div>
                                            </div>
                                        {/foreach}
                                    {else}
                                        <p class="text-muted" id="fieldPickerEmpty">
                                            {vtranslate('LBL_SELECT_MODULE_FIRST', 'PDFMaker2')}
                                        </p>
                                    {/if}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {* Footer Buttons *}
                <div class="modal-overlay-footer clearfix" style="margin-top:20px">
                    <div class="textAlignCenter col-lg-12">
                        <button type="submit" class="btn btn-success saveButton" id="pdfmaker2SaveBtn">
                            <i class="fa fa-check"></i>&nbsp;{vtranslate('LBL_SAVE', 'PDFMaker2')}
                        </button>&nbsp;&nbsp;
                        <a class="cancelLink" href="index.php?module=PDFMaker2&parent=Settings&view=List">
                            {vtranslate('LBL_CANCEL', 'PDFMaker2')}
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
{/strip}
