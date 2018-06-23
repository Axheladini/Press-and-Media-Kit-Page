/* Jquery code*/
jQuery(document).ready(function($) {


/*Resource file Delere*/
    if($('a#resource_file_delete').length === 1) {
        // Since the link exists, we need to handle the case when the user clicks on it...
        $('#resource_file_delete').click(function(evt) {
         
            // We don't want the link to remove us from the current page
            // so we're going to stop it's normal behavior.
            evt.preventDefault();
             
            // Find the text input element that stores the path to the file
            // and clear it's value.
            $('#resource_file_url').val('');
            $('.image_one').hide();
            // Hide this link so users can't click on it multiple times
            $(this).hide();
         
        });
     
    } // end if

/*Press Release file Delere*/
    if($('a#press_release_file_delete').length === 1) {
        // Since the link exists, we need to handle the case when the user clicks on it...
        $('#press_release_file_delete').click(function(evt) {
         
            // We don't want the link to remove us from the current page
            // so we're going to stop it's normal behavior.
            evt.preventDefault();
             
            // Find the text input element that stores the path to the file
            // and clear it's value.
            $('#press_release_file_url').val('');
            $('.press_release_file_img').hide();
            // Hide this link so users can't click on it multiple times
            $(this).hide();
         
        });
     
    } // end if


/* Pres release metaboxes hide show based on Pres Release type*/

var press_releas_type = $('#release_type_flag').val();


if(press_releas_type == "wp_post")
{
    $('#wps_press_page_releases_file').css("display","none");
    $('#wps_press_page_releases_link_meta').css("display","block");
}
else if(press_releas_type == "document")
{
    $('#wps_press_page_releases_file').css({'display':'block'});
    $('#wps_press_page_releases_link_meta').css({'display':'none'});
}
else if(press_releas_type == "link")
{
    $('#wps_press_page_releases_file').css("display","none");
    $('#wps_press_page_releases_link_meta').css("display","block");
}

$( "#wps_press_page_releases_type").change(function() {

   
   var pres_type = $(this).find(":selected").val();
  
  if(pres_type == "wp_post")
{
    $('#wps_press_page_releases_file').css("display","none");
    $('#wps_press_page_releases_link_meta').css("display","block");
}
else if(pres_type == "document")
{
    $('#wps_press_page_releases_file').css({'display':'block'});
    $('#wps_press_page_releases_link_meta').css({'display':'none'});
}
else if(pres_type == "link")
{
    $('#wps_press_page_releases_file').css("display","none");
    $('#wps_press_page_releases_link_meta').css("display","block");
}


});

/* Pres release metaboxes hide show based on Pres Release type ends */

/*Resources video alert message*/
$('.video_alert').css("display","none");

var resource_type = $('#wps_press_page_resource_select_type').val();
 
if(resource_type == 'video')
{
    $('.video_alert').css("display","block");
    $('#resource_file_uploaded').css("display","none");
}
else 
{
  $('.video_alert').css("display","none");
  $('#resource_file_uploaded').css("display","block");  
}

$( "#wps_press_page_resource_select_type").change(function() {
  
        var resource_t = $(this).find(":selected").val();

        if(resource_t == 'video')
        {
        $('.video_alert').css("display","block");
        $('#resource_file_uploaded').css("display","none");
        }
        else 
        {
        $('.video_alert').css("display","none");
        $('#resource_file_uploaded').css("display","block");  
        }

});

/*Resources video alert message ends here*/
});