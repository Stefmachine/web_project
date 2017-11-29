function alertMode(alertDiv,mode,message) {
    types = ["danger","warning","sucess","info"];
    $(types).each(function(index,value){
        alertDiv.removeClass("alert-"+value);
    });

    alertDiv.addClass("alert-"+mode);

    alertDiv.html(message);
    alertDiv.removeClass("hidden");
}

$(document).ajaxStart(function() {
    $("#loading").show();
});

$(document).ajaxStop(function() {
    setTimeout(function(){
        $("#loading").hide();
    }, 500);
});

