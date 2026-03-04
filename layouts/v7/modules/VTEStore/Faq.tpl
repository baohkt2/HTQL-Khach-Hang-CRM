<div id="globalmodal">
    <div id="massEditContainer" class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header contentsBackground">
                <button aria-hidden="true" class="close " data-dismiss="modal" type="button"><span aria-hidden="true" class='fa fa-close'></span></button>
                <h4>{vtranslate('FAQ', 'VTEStore')}</h4>
            </div>
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: auto;">
                <div name="massEditContent" style="overflow: hidden; width: auto; height: auto;">
                    <div class="modal-body tabbable">
                        <ul class="nav nav-tabs massEditTabs">
                            <li class="active"><a data-toggle="tab" href="#block_1"><strong>{vtranslate('LBL_INSTALLATION', 'VTEStore')}</strong></a></li>
                            <li><a data-toggle="tab" href="#block_2"><strong>{vtranslate('LBL_EXTENSION_DETAILS', 'VTEStore')}</strong></a></li>
                            <li><a data-toggle="tab" href="#block_3"><strong>{vtranslate('LBL_USABILITY', 'VTEStore')}</strong></a></li>
                            <li><a data-toggle="tab" href="#block_4"><strong>{vtranslate('Subscription_Help', 'VTEStore')}</strong></a></li>
                            <li><a data-toggle="tab" href="#block_5"><strong>{vtranslate('Troubleshooting', 'VTEStore')}</strong></a></li>
                        </ul>
                        <div class="tab-content massEditContent">
                            <div id="block_1" class="tab-pane active" align="center"><img src="https://www.vtexperts.com/guides/guide1.png"></div>
                            <div id="block_2" class="tab-pane row-fluid" align="center"><img src="https://www.vtexperts.com/guides/guide2.png"></div>
                            <div id="block_3" class="tab-pane row-fluid" style="max-height: 500px; overflow-y: scroll;">{$USABILITY}</div>
                            <div id="block_4" class="tab-pane row-fluid" style="max-height: 500px; overflow-y: scroll;">{$SUBSCRIPTION_HELP}</div>
                            <div id="block_5" class="tab-pane row-fluid" style="max-height: 500px; overflow-y: scroll;">{$TROUBLESHOOTING}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="pull-right cancelLinkContainer" style="margin-top: 0px;"><a class="cancelLink" type="reset" data-dismiss="modal"><strong>{vtranslate('LBL_CLOSE', $MODULE)}</strong></a></div>
            </div>
        </div>
    </div>
</div>
