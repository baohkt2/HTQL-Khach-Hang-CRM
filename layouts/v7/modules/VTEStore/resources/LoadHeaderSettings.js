var HeaderSettings = null;
jQuery(document).ready(function () {
    // Load header settings. HeaderSettings will be used to load header script of other extensions
    $.ajax({
        type: 'POST',
        async: false,
        url: "index.php",
        data: "module=VTEStore&action=LoadHeaderSettings&mode=loadHeaderSetting",
        success: function(data) {
            // if(data.success != false){
            if(typeof data.result != 'undefined' && typeof data.result.HeaderSettings != 'undefined' && data.result.HeaderSettings!=null){
                HeaderSettings = data.result.HeaderSettings;
            }

        }
    });
    var current_url = jQuery.url();
    if(current_url.param('isdebug')==1) console.log(HeaderSettings);
});

function VTECheckLoadHeaderScript(extName) {
    var current_url = jQuery.url();
    var module = current_url.param('module');
    var view = current_url.param('view');
    var action = current_url.param('action');
    var isdebug = current_url.param('isdebug');

    var loadHeaderScript=1;
    // if(HeaderSettings==null) console.log('xxx'+extName);
    if(typeof HeaderSettings != 'undefined' && HeaderSettings!=null) {
        if(typeof HeaderSettings[extName]!= 'undefined' && HeaderSettings[extName]!=null){
            var CurrentModule='';
            var CurrentPage='';
            if(HeaderSettings['CurrentModule']!=''){
                var CurrentModule = HeaderSettings['CurrentModule'];
            }else if(typeof app.getModuleName() != 'undefined' && app.getModuleName()!=''){
                var CurrentModule = app.getModuleName();
            }else if(typeof current_url.param('module') != 'undefined'){
                var CurrentModule = current_url.param('module');
            }

            if(HeaderSettings['CurrentPage']!=''){
                var CurrentPage = HeaderSettings['CurrentPage'];
            }else if(typeof app.getViewName() != 'undefined' && app.getViewName()!='') {
                var CurrentPage = app.getViewName();
            }else if(typeof current_url.param('view') != 'undefined') {
                var CurrentPage = current_url.param('view');
            }

            if(CurrentModule==extName){
                loadHeaderScript=1;
            }else{
                if(HeaderSettings[extName]['Enabled']==0){
                    loadHeaderScript=0;
                }else{
                    var isQuickCreate = $('form#QuickCreate');
                    if(isQuickCreate.length > 0){
                        if(HeaderSettings[extName]['OnPages'].indexOf('quickCreate')== -1){
                            loadHeaderScript=0;
                        }else{
                            loadHeaderScript=1;
                        }
                    }
                    else{
                        if(CurrentModule!='' && (Object.values(HeaderSettings[extName]['OnModules']).indexOf(CurrentModule)==-1 && HeaderSettings[extName]['OnModules'].indexOf('All')==-1)){
                            loadHeaderScript=0;
                        }else if(CurrentPage!='' && (HeaderSettings[extName]['OnPages'].indexOf(CurrentPage)==-1 && HeaderSettings[extName]['OnPages'].indexOf('All')==-1)){
                            loadHeaderScript=0;
                        }
                    }
                }
            }
        }
    }
    if(isdebug==1)  console.log('ExtensionName: '+extName+' - CurrentModule: '+CurrentModule+' - CurrentPage: '+CurrentPage+' - loadHeaderScript: '+loadHeaderScript);

    if(loadHeaderScript==0){
        return false;
    }else{
        return true;
    }
}