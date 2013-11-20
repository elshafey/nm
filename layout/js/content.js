$(document).ready(function(){
    $(':checkbox').not('.contact-us-services input').click(function(){
        $(this).parent().remove('input[type="hidden"]');
        if($(this).val()==0){
            $(this).val(1);
            $('#'+$(this).attr('name')+'_hidden').val(1);
        }else{
            $(this).val(0);
            $('#'+$(this).attr('name')+'_hidden').val(0);
        }
    });
    $(':checkbox').not('.contact-us-services input').each(function(i){
        $(this).parent().append('<input type="hidden" id="'+$(this).attr('name')+'_hidden" value="'+$(this).val()+'" name="'+$(this).attr('name')+'" />');
    })
    
    $('#quick_search').keypress(function(e){
        if(e.keyCode==13){
            $(this).closest('form').submit();
        }
    });
    $('.arabic-link,.lang').click(function(){
        urlParts=location.href.split("?");
        location.href=urlParts[0]+(urlParts.length>1? '?'+urlParts[1]:'?')+"&lang="+$(this).attr("lang");
    });
});
function site_url(controller){
    if(!controller){
        controller= '';
    }
    var pathname = $(location).attr('href');
    var url_parts = pathname.split('/');
    var base_url = '';
    if(url_parts[2] == 'localhost' || url_parts[2] == '127.0.0.1'){
        base_url = url_parts[0] + '//' + url_parts[2] + '/'  + url_parts[3] + '/';
    }else{
        base_url = url_parts[0] + '//' + url_parts[2] + '/';
    }
    var url = base_url + controller;
    return url;
    
}



function get_thumb_path(fileUrl){
    var path=fileUrl;
                        
    path_array=path.split("/");
                        
    var img=path_array[path_array.length-1];
                        
    path_array[path_array.length-2]="_thumbs";
    path_array[path_array.length-1]="Images";
    path_array[path_array.length]=img;
                        
    var thumb_path="";
    for (var i = 0; i < path_array.length; i++)
    {
        if(i>0)
            thumb_path+="/"+path_array[i];
                            
    }
    return thumb_path;
}