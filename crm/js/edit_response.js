function setResponseTemplate(text, new_status, internal)
{
    text = text.replaceAll("|", "\n");
    $("#response_text").val(text);
    $("#new_status_id").val(new_status);
    $("#internal").val(internal);
    
    //$("#new_status_id option[value="+new_status+"]").attr('selected', 'selected');
 
    // Or just...
    // $("#new_status_id").val(new_status);

}