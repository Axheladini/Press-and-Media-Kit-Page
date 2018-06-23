<?php 
/**
 *
 *Resources custom post types
 *
 * @package stoked press page
 * @since stoked press page 1.0
 */

//Step 1: Create the Custom Post 
add_action('init', 'wps_press_page_resources_custom_posts');
function wps_press_page_resources_custom_posts()
{
	$labels = array(

      	'name'  => __( 'Resources', 'wps_press_page' ),
      	'singular_name' => __( 'Resource', 'wps_press_page' ),
      	'add_new'  =>  __( 'Add New Resource', 'wps_press_page' ),
      	'add_new_item' =>  __( 'Add New Resource', 'wps_press_page' ),
      	'edit_item' =>  __( 'Edit Resource', 'wps_press_page' ),
      	'new_item' =>  __( 'New Resource', 'wps_press_page' ),
      	'all_items' =>  __( 'Resources', 'wps_press_page' ),
      	'view_items' => __( 'Search Resources', 'wps_press_page' ),
      	'not_found' => __( 'No Resource found', 'wps_press_page' ),
      	'not_found_in_trash' => __( 'No Resource found in trash', 'wps_press_page' ),
      	'menu_name' => __( 'Resources', 'wps_press_page' )

      );


      $args = array(
        'can_export' => true,
      	'labels' => $labels,
      	'supports'  => array( 'title', 'editor'),
      	'capability_type' => 'post',
      	'hierarchical' => true,
        'show_ui' => true,
        'show_in_menu' => false,
        'show_in_admin_bar' => true,
        'can_export' => true,
        'has_archive' => true,
        'exclude_from_search' => false,
      	'show_in_nav_menus' => false,
      	'menu_position' => null,
      	'taxonomies' => array('category'),
      	'public' => true

      );

    
    register_post_type('resources', $args);

}

//Step 2: Create taxonomy for  the custom post type (Optional, only if needed)
/* Register taxonomy for Resources custom post type*/



//Step 3: Create MetaBoxes for custom post type
add_action('add_meta_boxes', 'wps_press_page_upload_resource');
function wps_press_page_upload_resource() {
 

  //Define Resource type 
    add_meta_box(
        'wps_press_page_resource_type_meta',
        __( 'Resource Type', 'wps_press_page' ),
        'wps_press_page_render_resource_type',
        'Resources',
        'normal',
        'core'
    );
    
    // Define the custom attachment for posts
    add_meta_box(
        'resource_file_uploaded',
         __( 'Resource file', 'wps_press_page' ),
        'wps_press_page_resource_file_upload',
        'Resources',
        'normal',
        'core'
    );
}

function wps_press_page_resource_file_upload($post, $box)
{
  $resourec_file = get_post_meta($post->ID, 'resource_file_uploaded', true);
  if (!empty($resourec_file['url'])) 
    { 
      $url = strlen(trim($resourec_file['url']));  
      $file_type = wp_check_filetype($resourec_file['url']);
      $ext = $file_type['ext'];
    } 
    else 
    { $url = 0; }
   
   wp_nonce_field('wps_press_page_press_release_save','wps_press_page_resource_file_nonce');
//Check file extension and represent in Admin panel with icon
  if($url > 0) {
   $ext = pathinfo($resourec_file['url'], PATHINFO_EXTENSION);
   
    switch ($ext) {
    case 'jpeg':
        $thumb_img = $resourec_file['url'];
        break;
    case 'jpg':
        $thumb_img = $resourec_file['url'];
        break;
    case 'gif':
        $thumb_img = $resourec_file['url'];
        break;
    case 'png':
        $thumb_img = $resourec_file['url'];
        break;
    case 'pdf':
        $thumb_img = plugins_url('images/pdf.png', dirname(__FILE__));
        break;
    case 'cdr':
        $thumb_img = plugins_url('images/cdr.png', dirname(__FILE__));
        break;
    case 'psd':
        $thumb_img = plugins_url('images/psd.png', dirname(__FILE__));
        break;
    case 'ai':
        $thumb_img = plugins_url('images/ai.png', dirname(__FILE__));
        break;
    case 'xcf':
        $thumb_img = plugins_url('images/xcf.png', dirname(__FILE__));
        break;
    case 'gz':
        $thumb_img = plugins_url('images/gzip.png', dirname(__FILE__));
        break;
    case 'tgz':
        $thumb_img = plugins_url('images/gzip.png', dirname(__FILE__));
        break;
    case 'tar':
        $thumb_img = plugins_url('images/gzip.png', dirname(__FILE__));
        break;
    case 'zip':
        $thumb_img = plugins_url('images/zip.png', dirname(__FILE__));
        break;
    case 'rar':
        $thumb_img = plugins_url('images/rar.png', dirname(__FILE__));
        break;
    case 'eps':
        $thumb_img = plugins_url('images/eps.png', dirname(__FILE__));
        break;
    default:
        $thumb_img = plugins_url('images/pdf.png', dirname(__FILE__));
}
}

  $html ="<br><div class='file_box custom_post_content'>";
  $html .= '<p class="description">';
  if($url > 0) {
   //$html .= $ext;
    $html .='<img class="image_one" src="'.   esc_url_raw($thumb_img) .'"></img>';
    $html .= '<br><a href="javascript:;" id="resource_file_delete">' . __('Delete File') . '</a>';
    $html .= '<br><a href="'.esc_url_raw($resourec_file['url']).'"  target="_blank">' . __('Download') . '</a>';
  }
  $html .= '<br>Upload Resource File';
  $html .= '</p>';
  $html .= '<input type="file" id="resource_file" name="resource_file" value="" size="15" /><br>';
 if($url > 0) {
    $html .= '<input type="hidden" id="resource_file_url" name="resource_file_url" value=" ' . esc_url_raw($resourec_file['url']) . '" size="15" />';
  }
  $html .= "<b>Allowed files:</b> jpg, png, gif, pdf, ai, psd, xcf, cdr, zip, rar, gzip, tar, tgz";
  $html .= '</div>'; 

  echo $html;
}

function wps_press_page_render_resource_type($post, $box)
{
  $wps_press_page_resource_type = esc_html(get_post_meta($post->ID, 'wps_press_page_resource_type_meta', true));

  wp_nonce_field('wps_press_page_press_release_save','wps_press_page_resource_type_nonce');

  echo '<table id="wps_press_page_resource_type_tab" class="custom_post_content" style="width:60% !important;">';
  echo '<tbody>';
  echo '<tr>';
  echo '<td></td>';
  echo '<td>';
   echo  '<select name="wps_press_page_resource_select_type" id="wps_press_page_resource_select_type">
           <option value = " ">' .__('Select type ...', 'favor').'</optiop>
           <option value = "document"'.selected($wps_press_page_resource_type, 'document', false ).'>' .__('Document', 'wps_press_page').'</optiop>
           <option value = "logo"'.selected($wps_press_page_resource_type, 'logo', false ).'>' .__('Logo', 'wps_press_page').'</optiop>
           <option value = "image"'.selected($wps_press_page_resource_type, 'image', false ).'>' .__('Image', 'wps_press_page').'</optiop>
           <option value = "vector"'.selected($wps_press_page_resource_type, 'vector', false ).'>' .__('Vector', 'wps_press_page').'</optiop>
           <option value = "video"'.selected($wps_press_page_resource_type, 'video', false ).'>' .__('Video', 'wps_press_page').'</optiop>
           <option value = "other"'.selected($wps_press_page_resource_type, 'other', false ).'>' .__('Other', 'wps_press_page').'</optiop>';
  echo '</select>';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td height="5"></td>';
  echo '<td></td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td></td>';
  echo '<td><span class="video_alert" style="font-size:14px;color:#6b8050;">'.__('Add the embedded video code (Youtube, Vimeo..) to the editor! ', 'wps_press_page').'</span></td>';
  echo '</tr>';
  echo '</tbody>';
  echo '</table>';
 
}

//Save Resource Metaboxes
//Step 4: Save Custom Posts and their metaboxes
add_action('save_post', 'wps_press_page_save_resource_meta_data');
function wps_press_page_save_resource_meta_data($id) 
{  

    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return $id;
    } // end if

    ///////////////*FILE UPLOAD STARTS HERE*///////////////////////
    if(!empty($_FILES['resource_file']['name'])) 
    {/* Upload starts here*/
     $verify = check_admin_referer('wps_press_page_press_release_save','wps_press_page_resource_file_nonce');
       if ($verify == '1')
       {/* If nonce verified */
        

        $supported_file_types = array('JPG', 'jpeg', 'jpg', 'png', 'pdf', 'gif','cdr', 'ai', 'psd', 'xcf', 'zip', 'rar', 'gz', 'eps', 'tar', 'tgz');   
        $uploaded_file_type = $_FILES['resource_file']['name'];
        $uploaded_type = pathinfo($uploaded_file_type, PATHINFO_EXTENSION);
        

        if(in_array($uploaded_type, $supported_file_types)) 
        {
           // Use the WordPress API to upload the file
          $upload_file = wp_upload_bits($_FILES['resource_file']['name'], null, file_get_contents($_FILES['resource_file']['tmp_name']));

          


           if(isset($upload_file['error']) && $upload_file['error'] != 0) 
           {
              
              wp_die('There was an error uploading your file. The error is: ' . $upload_file['error']);
            } 
            else {

            
                $upload_file['file'] = str_replace('\\', '/', $upload_file['file']);
                add_post_meta($id, 'resource_file_uploaded', $upload_file);
                update_post_meta($id, 'resource_file_uploaded', $upload_file);
              

            } // end if/else
        }
        else {
            wp_die("The file type that you've uploaded is not allowed.");
        } // end if/else
      }/*Nonce verfication if ends here*/
    }/*Upload if ends here*/
    else 
    {/* Resource delete starts here*/
        $file = get_post_meta($id, 'resource_file_uploaded', true);
        if (isset($_POST['resource_file_url']))
        {
              $delete_flag_file = $_POST['resource_file_url'];
       
          if(strlen(trim($file['url'])) > 0 && strlen(trim($delete_flag_file)) == 0) {
         
            if(unlink($file['file'])) {
                 
                update_post_meta($id, 'resource_file_uploaded', null);
                update_post_meta($id, 'resource_file_url', '');
                 
            } else {
                wp_die('There was an error trying to delete your file.');
            } 
             
        } // end second if
      } //end first if
    }
     ///////////////*FILE UPLOAD ENDS HERE*///////////////////////
}

/* Save Resource type meta*/
add_action('save_post', 'wps_press_page_save_resource_type');
function wps_press_page_save_resource_type($id)
{
    
    /*Create an array to validate select values*/
    function wps_press_page_get_allowed_file_types()
    { return array('document', 'logo', 'image', 'vector', 'video', 'other');}
    
    /*Validate select value*/
    if(isset($_POST['wps_press_page_resource_select_type']) && in_array( $_POST['wps_press_page_resource_select_type'], wps_press_page_get_allowed_file_types()))
      {
           $verify_type = check_admin_referer('wps_press_page_press_release_save','wps_press_page_resource_type_nonce');
              if ($verify_type == '1')
                 {
                   $wps_press_page_resource_e_type = $_POST['wps_press_page_resource_select_type'];
                    $wps_press_page_resource_e_type = sanitize_text_field( $wps_press_page_resource_e_type);
                    update_post_meta($id, 'wps_press_page_resource_type_meta',   $wps_press_page_resource_e_type);
                  }
        }/*Type Mteaboxes ends here*/


}





function wps_press_page_update_edit_form() {
    echo ' enctype="multipart/form-data"';
} // end update_edit_form
add_action('post_edit_form_tag', 'wps_press_page_update_edit_form');


