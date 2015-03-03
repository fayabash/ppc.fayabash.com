function hideShowLanguagesInputs( lng ){
    $(":regex(id, "+lng+"$)").parent().show();
    for( var i in languages )
    {
        if( languages[i] != lng )
        {
            $(":regex(id, "+languages[i]+"$)").parent().hide();
        }
    }
}

$(document).ready(function(){
    hideShowLanguagesInputs( language );
    $('#element-admin-lng-selection-add a').click(function(){
        var lng = $(this).html();
        $('#element-admin-lng-selection-add li').removeClass('active');
        $(this).parent().addClass('active');
        hideShowLanguagesInputs( lng );
    });
});