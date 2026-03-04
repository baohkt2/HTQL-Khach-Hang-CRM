/********************************************************************************
 * The content of this file is subject to the PDF Maker Free license.
 * ("License"); You may not use this file except in compliance with the License
 * The Initial Developer of the Original Code is IT-Solutions4You s.r.o.
 * Portions created by IT-Solutions4You s.r.o. are Copyright(C) IT-Solutions4You s.r.o.
 * All Rights Reserved.
 * ******************************************************************************/
Vtiger_Detail_Js("PDFMaker_DetailFree_Js",{

    setPreviewContent : function(type){
        var previewcontent =  jQuery('#previewcontent_'+type).html();
        var previewFrame = document.getElementById('preview_'+type);
        var preview =  previewFrame.contentDocument ||  previewFrame.contentWindow.document;
        preview.open();
        preview.write(previewcontent);
        preview.close();
        jQuery('#previewcontent_'+type).html('');
    }

    },{
});