$(document).ready(function(){
    $("body").undelegate(".btnReloadVteCaptcha", "click")
    $("body").delegate(".btnReloadVteCaptcha", "click", function(){
        var thisInstance = this;
        var url = $(this).attr("data-url");
        $(this).closest(".vte-captcha").closest("div").load(url);
    });
});