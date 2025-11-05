{*
/*********************************************************************************
 * The content of this file is subject to the PDF Maker license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 ********************************************************************************/
*}
{if $ENABLE_PDFMAKER eq 'true'}

    <input type="hidden" name="email_function" id="email_function" value="{$EMAIL_FUNCTION}"/>
    {* Export to PDF*}
    <li>
        <a href="javascript:;" class="PDFMakerDownloadPDF PDFMakerTemplateAction">{vtranslate('LBL_DOWNLOAD','PDFMaker')}</a>
    </li>
    <li class="dropdown-header">
        <i class="fa fa-settings"></i> {vtranslate('LBL_SETTINGS', 'PDFMaker')}
    </li>
        <li>
            <a href="javascript:;" class="showPDFBreakline">{vtranslate('LBL_PRODUCT_BREAKLINE','PDFMaker')}</a>
        </li>
    <li>
        <a href="javascript:;" class="showProductImages">{vtranslate('LBL_PRODUCT_IMAGE', 'PDFMaker')}</a>
    </li>

    {if $TEMPLATE_LANGUAGES|@sizeof > 1}
        <li class="dropdown-header">
            <i class="fa fa-settings"></i> {vtranslate('LBL_PDF_LANGUAGE', 'PDFMaker')}
        </li>
        <li>
            <select name="template_language" id="template_language" class="col-lg-12">
                {html_options  options=$TEMPLATE_LANGUAGES selected=$CURRENT_LANGUAGE}
            </select>
        </li>
    {else}
        {foreach from="$TEMPLATE_LANGUAGES" item="lang" key="lang_key"}
            <input type="text" name="template_language" id="template_language" value="{$lang_key}"/>
        {/foreach}
    {/if}
{/if}
