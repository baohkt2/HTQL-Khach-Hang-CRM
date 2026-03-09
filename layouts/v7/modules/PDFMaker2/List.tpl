{*
    PDFMaker2 — List View Template
    Settings context: shows all PDF templates in a management table.
*}
{strip}
<div class="col-sm-12 col-xs-12">
    <div class="clearfix">
        <div class="pull-right">
            <a class="btn btn-success" href="index.php?module=PDFMaker2&view=Edit">
                <i class="fa fa-plus"></i>&nbsp;{vtranslate('LBL_NEW_TEMPLATE', 'PDFMaker2')}
            </a>
        </div>
        <h4>{vtranslate('LBL_PDFMAKER2_TEMPLATES', 'PDFMaker2')}</h4>
    </div>
    <hr>

    <div id="table-content" class="table-container">
        <table id="listview-table" class="table listview-table">
            <thead>
                <tr class="listViewContentHeader">
                    <th style="width:5%">#</th>
                    <th>{vtranslate('LBL_TEMPLATE_NAME', 'PDFMaker2')}</th>
                    <th>{vtranslate('LBL_DESCRIPTION', 'PDFMaker2')}</th>
                    <th>{vtranslate('LBL_TARGET_MODULES', 'PDFMaker2')}</th>
                    <th>{vtranslate('LBL_FORMAT', 'PDFMaker2')}</th>
                    <th>{vtranslate('LBL_STATUS', 'PDFMaker2')}</th>
                    <th>{vtranslate('LBL_MODIFIED', 'PDFMaker2')}</th>
                    <th style="width:8%">{vtranslate('LBL_ACTIONS', 'PDFMaker2')}</th>
                </tr>
            </thead>
            <tbody>
                {if count($TEMPLATES) > 0}
                    {foreach item=TEMPLATE from=$TEMPLATES name=tplLoop}
                        <tr class="listViewEntries" data-id="{$TEMPLATE.templateid}">
                            <td>{$smarty.foreach.tplLoop.iteration + (($PAGE - 1) * 20)}</td>
                            <td>
                                <a href="index.php?module=PDFMaker2&view=Edit&templateid={$TEMPLATE.templateid}">
                                    <strong>{$TEMPLATE.template_name|escape:'html'}</strong>
                                </a>
                            </td>
                            <td>{$TEMPLATE.description|escape:'html'|truncate:80}</td>
                            <td>
                                {if !empty($TEMPLATE.modules)}
                                    {assign var=MODULE_LIST value=explode(', ', $TEMPLATE.modules)}
                                    {foreach $MODULE_LIST as $mod}
                                        <span class="label label-primary" style="margin-right:3px">{$mod}</span>
                                    {/foreach}
                                {else}
                                    <span class="text-muted">{vtranslate('LBL_NONE', 'PDFMaker2')}</span>
                                {/if}
                            </td>
                            <td>{$TEMPLATE.format|default:'A4'} / {$TEMPLATE.orientation|default:'portrait'}</td>
                            <td>
                                {if $TEMPLATE.status == 1}
                                    <span class="label label-success">{vtranslate('LBL_ACTIVE', 'PDFMaker2')}</span>
                                {else}
                                    <span class="label label-default">{vtranslate('LBL_INACTIVE', 'PDFMaker2')}</span>
                                {/if}
                            </td>
                            <td>{$TEMPLATE.modified_at|date_format:'%d/%m/%Y %H:%M'}</td>
                            <td>
                                <div class="table-actions">
                                    <span class="more dropdown action">
                                        <span class="dropdown-toggle" data-toggle="dropdown">
                                            <i class="fa fa-ellipsis-v icon"></i>
                                        </span>
                                        <ul class="dropdown-menu dropdown-menu-right">
                                            <li>
                                                <a href="index.php?module=PDFMaker2&view=Edit&templateid={$TEMPLATE.templateid}">
                                                    <i class="fa fa-pencil"></i>&nbsp;{vtranslate('LBL_EDIT', 'PDFMaker2')}
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="deleteTemplate" data-id="{$TEMPLATE.templateid}">
                                                    <i class="fa fa-trash"></i>&nbsp;{vtranslate('LBL_DELETE', 'PDFMaker2')}
                                                </a>
                                            </li>
                                        </ul>
                                    </span>
                                </div>
                            </td>
                        </tr>
                    {/foreach}
                {else}
                    <tr class="emptyRecordsDiv">
                        <td colspan="8">
                            <div class="textAlignCenter" style="padding:30px">
                                <i class="fa fa-file-pdf-o" style="font-size:48px;color:#ccc;margin-bottom:15px"></i><br>
                                {vtranslate('LBL_NO_TEMPLATES', 'PDFMaker2')}<br><br>
                                <a class="btn btn-success" href="index.php?module=PDFMaker2&view=Edit">
                                    <i class="fa fa-plus"></i>&nbsp;{vtranslate('LBL_CREATE_FIRST_TEMPLATE', 'PDFMaker2')}
                                </a>
                            </div>
                        </td>
                    </tr>
                {/if}
            </tbody>
        </table>
    </div>

    {* Pagination *}
    {if $TOTAL_COUNT > 20}
        <div class="textAlignCenter" style="margin-top:15px">
            {assign var=TOTAL_PAGES value=ceil($TOTAL_COUNT/20)}
            {if $PAGE > 1}
                <a class="btn btn-default btn-sm" href="index.php?module=PDFMaker2&view=List&page={$PAGE - 1}">
                    <i class="fa fa-chevron-left"></i> {vtranslate('LBL_PREV', 'PDFMaker2')}
                </a>
            {/if}
            <span class="muted" style="margin:0 15px">
                {vtranslate('LBL_PAGE', 'PDFMaker2')} {$PAGE} / {$TOTAL_PAGES}
                ({$TOTAL_COUNT} {vtranslate('LBL_TEMPLATES', 'PDFMaker2')})
            </span>
            {if $PAGE < $TOTAL_PAGES}
                <a class="btn btn-default btn-sm" href="index.php?module=PDFMaker2&view=List&page={$PAGE + 1}">
                    {vtranslate('LBL_NEXT', 'PDFMaker2')} <i class="fa fa-chevron-right"></i>
                </a>
            {/if}
        </div>
    {/if}
</div>
{/strip}
