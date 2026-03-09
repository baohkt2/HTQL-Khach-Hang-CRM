{*
    PDFMaker2 — Export PDF Modal Template
    Displayed inside a vtiger modal when user clicks "Export PDF" on any module.
    Shows template selector and download/preview actions.
*}
{strip}
<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title">
                <i class="fa fa-file-pdf-o"></i>&nbsp;{vtranslate('LBL_EXPORT_PDF', 'PDFMaker2')}
            </h4>
        </div>
        <div class="modal-body" id="pdfmaker2ExportModalBody">
            <div id="pdfmaker2TemplateList">
                {* Populated dynamically by ExportPDF.js *}
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-success" id="pdfmaker2DownloadBtn" disabled>
                <i class="fa fa-download"></i>&nbsp;{vtranslate('LBL_DOWNLOAD_PDF', 'PDFMaker2')}
            </button>
            <button type="button" class="btn btn-default" data-dismiss="modal">
                {vtranslate('LBL_CANCEL', 'PDFMaker2')}
            </button>
        </div>
    </div>
</div>
{/strip}
