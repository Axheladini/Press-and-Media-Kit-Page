<?php 
/**
 *
 *Resources custom post types
 *
 * @package stoked press page
 * @since stokes press page 1.0
 */

//Step 1: Create the Custom Post 
add_action('init', 'wps_press_page_press_reelease_custom_posts');
function wps_press_page_press_reelease_custom_posts()
{
	$labels = array(

      	'name'  => __( 'Press Releases', 'wps_press_page' ),
      	'singular_name' => __( 'Press Release', 'wps_press_page' ),
      	'add_new'  =>  __( 'Add New Press Release', 'wps_press_page' ),
      	'add_new_item' =>  __( 'Add New Press Releases', 'wps_press_page' ),
      	'edit_item' =>  __( 'Edit New Press Releases', 'wps_press_page' ),
      	'new_item' =>  __( 'New Press Release', 'wps_press_page' ),
      	'all_items' =>  __( 'All Press Releases', 'wps_press_page' ),
      	'view_items' => __( 'Search Press Releases', 'wps_press_page' ),
      	'not_found' => __( 'No Press Release found', 'wps_press_page' ),
      	'not_found_in_trash' => __( 'No Press Release found in trash', 'wps_press_page' ),
      	'menu_name' => __( 'Press Releases', 'wps_press_page' )

      );


      $args = array(
        'can_export' => true,
      	'labels' => $labels,
      	'supports'  => array( 'title', 'editor', 'thumbnail'),
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
      	'taxonomies' =>array('category'),
      	'public' => true

      );
 
    register_post_type('Press Reeleases', $args);

}


/* Register taxonomy for Resources csutom post type*/
//Step 2: Create taxonomy for  the custom post type (Not Needed)


//Step 3: Create MetaBoxes for custom post type
add_action( 'add_meta_boxes', 'wps_press_page_press_releases_metaboxes' );
function wps_press_page_press_releases_metaboxes()
{
add_meta_box(
        'wps_press_page_releases_type',
        __( 'Press Release Type', 'wps_press_page' ),
        'wps_press_page_release_render_type',
        'Press Reeleases',
        'normal',
        'core'
    );

  add_meta_box(
        'wps_press_page_releases_file',
        __( 'Press release file upload', 'wps_press_page' ),
        'wps_press_page_release_render_upload',
        'Press Reeleases',
        'normal',
        'core'
    );

  add_meta_box(
        'wps_press_page_releases_link_meta',
        __( 'Press release link', 'wps_press_page' ),
        'wps_press_page_release_render_link_metabox',
        'Press Reeleases',
        'normal',
        'core'
    );

}

function wps_press_page_release_render_upload($post, $box)
{

   wp_nonce_field('wps_press_page_press_release_save','wps_press_page_press_release_nonce');
   $press_doc_file = get_post_meta($post->ID, 'wps_press_page_releases_file', true);

   if ($press_doc_file != '') 
     { 
       $url = strlen(trim($press_doc_file['url']));  
       $file_type = wp_check_filetype($press_doc_file['url']);
       $ext = $file_type['ext'];
     } else 
     { $url = 0; }

   if($url > 0) 
    {
      switch ($ext) {
      case 'pdf':
        $thumb_img = plugins_url('images/pdf.png', dirname(__FILE__));
        break;
      default:
        $thumb_img = $press_doc_file['url'];
       }
    }
   
  $html ="<br><div class='file_box custom_post_content'>";
  $html .= '<p class="description">';
  if($url > 0) {
   //$html .= $ext;
  $html .='<img class="press_release_file_img" src="'.  esc_url_raw($thumb_img) .'"></img>';
  $html .= '<br><a href="javascript:;" id="press_release_file_delete">' . __('Delete File', 'wps_press_page') . '</a>';
  $html .= '<br><a href="'.esc_url_raw($press_doc_file['url']).'"  target="_blank">' . __('Download', 'wps_press_page') . '</a>';
  }
  $html .= '<br>Upload Resource File';
  $html .= '</p>';
  $html .= '<input type="file" id="press_release_file" name="press_release_file" value="" size="15" /><br>';
 if($url > 0) {
    $html .= '<input type="text" id="press_release_file_url" name="press_release_file_url" value="'. esc_url_raw($press_doc_file['url']) .'" size="25" />';
  }
  $html .= "<b>Allowed files:</b>pdf";
  $html .= '</div>'; 

  echo $html;


}


function wps_press_page_release_render_type($post, $box)
{
  $wps_press_page_release_type = esc_html(get_post_meta($post->ID, 'wps_press_page_releases_type', true));
  
  if(!isset($wps_press_page_release_type)) {$wps_press_page_release_type = "wp_post" ;} else {$wps_press_page_release_type = $wps_press_page_release_type;}
   
  $type_flag = $wps_press_page_release_type;

  wp_nonce_field('wps_press_page_press_release_save','wps_press_page_press_release_type_nonce');
  
  echo '<table id="wps_press_page_pres_releases_type_tbl" class="custom_post_content" style="width:60% !important;">';
  echo '<tr>';
  echo '<td colspan="2"> <hr> </td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td></td>';
  echo '<td>';
  echo  '<select name="wps_press_page_releases_type" id="wps_press_page_releases_type">
           <option value = " ">' .__('Select type ...', 'favor').'</optiop>
           <option value = "wp_post"'.selected($wps_press_page_release_type, 'wp_post', false ).'>' .__('Blog post', 'wps_press_page').'</optiop>
           <option value = "document"'.selected($wps_press_page_release_type, 'document', false ).'>' .__('Document ( pdf )', 'wps_press_page').'</optiop>
           <option value = "link"'.selected($wps_press_page_release_type, 'link', false ).'>' .__('Link', 'wps_press_page').'</optiop>';
  echo '</select>';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td></td>';
  echo '<td><input type="hidden" id="release_type_flag" name="release_type_flag" value="'.esc_url_raw($type_flag).'" size="15" /></td>';
  echo '</tr>';
  echo '</table>';
  //echo "test";
}

function wps_press_page_release_render_link_metabox($post, $box)
{
  $wps_press_page_release_link = get_post_meta($post->ID, 'wps_press_page_releases_link_meta', true);

  wp_nonce_field('wps_press_page_press_release_save','wps_press_page_press_release_link_nonce');

  echo '<table id="wps_press_page_pres_releases_link_tbl" class="custom_post_content" style="width:60% !important;">';
  echo '<tr>';
  echo '<td></td>';
  echo '<td>';
  echo '<input type="text" name="wps_press_page_releases_link" class="wps_press_page_releases_link" value="'.esc_url_raw($wps_press_page_release_link).'" size="50" style="width:100% !important;">';
  echo '</td>';
  echo '</tr>';
  echo '</table>';
}

//Step 4: Save Custom Posts and their metaboxes
add_action('save_post', 'wps_press_page_save_press_releases');

function wps_press_page_save_press_releases($id)
{
  if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
      return $id;
    } // end if
    

    
         /*File Upload starts here*/ 
         if(!empty($_FILES['press_release_file']['name']))   
          {
          
          /*Verify Nonce*/
         $verify = check_admin_referer('wps_press_page_press_release_save','wps_press_page_press_release_nonce');
         if ($verify == '1')
         {
           $supported_file_types = array('pdf','png','jpg');
           $uploaded_file_type = $_FILES['press_release_file']['name'];
           $uploaded_type = pathinfo($uploaded_file_type, PATHINFO_EXTENSION);

           /*Check if file extension allowed and upload*/
           if(in_array($uploaded_type, $supported_file_types))
           {     
                // Use the WordPress API to upload the file
                $upload_file = wp_upload_bits($_FILES['press_release_file']['name'], null, file_get_contents($_FILES['press_release_file']['tmp_name']));
                if(isset($upload_file['error']) && $upload_file['error'] != 0)
                {
                  wp_die('There was an error uploading your file. The error is: ' . $upload_file['error']);
                }
                else
                { 
                  $upload_file['file'] = str_replace('\\', '/', $upload_file['file']);
                  add_post_meta($id, 'wps_press_page_releases_file', $upload_file);
                  update_post_meta($id, 'wps_press_page_releases_file', $upload_file);
                }
           } 
          else 
           {
               wp_die("The file type that you've uploaded is not allowed.");
           }/*Check if file extension allowed and upload ends here*/
       }/*File Upload ends here */
       else
       {/*Delete file starts here*/
          $file = get_post_meta($id, 'wps_press_page_releases_file', true);
          if (isset($_POST['press_release_file_url']))
          {
            $delete_flag_file = $_POST['press_release_file_url'];
            $file = get_post_meta($id, 'wps_press_page_releases_file', true);

            if(strlen(trim($file['url'])) > 0 && strlen(trim($delete_flag_file)) == 0)
            {
               if(unlink($file['file'])) 
               {
                update_post_meta($id, 'wps_press_page_releases_file', null);
                update_post_meta($id, 'wps_press_page_releases_file', '');
               }
               else
               {
                wp_die('There was an error trying to delete your file.');
               }
            }
          }

       } /*Nonce verify ends here*/ 
      
    }/*File Upload ends here*/ 
}


add_action('save_post', 'wps_press_page_save_press_releases_type');
function wps_press_page_save_press_releases_type($id)
{
  /* Type Metabox starts here wps_press_page_releases_type*/
    if(isset($_POST['wps_press_page_releases_type']))
      {
           $verify_type = check_admin_referer('wps_press_page_press_release_save','wps_press_page_press_release_type_nonce');
              if ($verify_type == '1')
                 {
                   $wps_press_page_release_type = $_POST['wps_press_page_releases_type'];
                   $wps_press_page_release_type = sanitize_text_field($wps_press_page_release_type);
                   update_post_meta($id, 'wps_press_page_releases_type',  $wps_press_page_release_type);
                  }
        }/*Type Mteaboxes ends here*/

}

add_action('save_post', 'wps_press_page_save_press_releases_link');
function wps_press_page_save_press_releases_link($id)
{
    /*Link Metabox starts here wps_press_page_releases_type*/
    if(isset($_POST['wps_press_page_releases_link']))
      {
           $verify_type = check_admin_referer('wps_press_page_press_release_save','wps_press_page_press_release_link_nonce');
              if ($verify_type == '1')
                 {
                   $wps_press_page_release_link = $_POST['wps_press_page_releases_link'];
                   $wps_press_page_release_link = sanitize_text_field($wps_press_page_release_link);
                   update_post_meta($id, 'wps_press_page_releases_link_meta',  $wps_press_page_release_link);
                  }
        }/*Link Mteaboxes ends here*/
}
