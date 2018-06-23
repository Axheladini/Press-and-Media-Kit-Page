<?php 
/**
 *
 *Resources custom post types
 *
 * @package stoked press page
 * @since stokes press page 1.0
 */

//Step 1: Create the Custom Post 
add_action('init', 'wps_press_page_articles_custom_posts');
function wps_press_page_articles_custom_posts()
{
  $labels = array(

        'name'  => __( 'Articless', 'wps_press_page' ),
        'singular_name' => __( 'Article', 'wps_press_page' ),
        'add_new'  =>  __( 'Add New Article', 'wps_press_page' ),
        'add_new_item' =>  __( 'Add New Article', 'wps_press_page' ),
        'edit_item' =>  __( 'Edit New Article', 'wps_press_page' ),
        'new_item' =>  __( 'New Article', 'wps_press_page' ),
        'all_items' =>  __( 'All Articles', 'wps_press_page' ),
        'view_items' => __( 'Search Articles', 'wps_press_page' ),
        'not_found' => __( 'No Article found', 'wps_press_page' ),
        'not_found_in_trash' => __( 'No RArticle found in trash', 'wps_press_page' ),
        'menu_name' => __( 'Articles', 'wps_press_page' )

      );


      $args = array(
        'can_export' => true,
        'labels' => $labels,
        'supports'  => array( 'title'),
        'capability_type' => 'post',
        'hierarchical' => false,
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

    
    register_post_type('articles', $args);
   

}
//Step 2: Create taxonomy for  the custom post type (Not Needed)

//Step 3: Create MetaBoxes for custom post type
add_action( 'add_meta_boxes', 'wps_press_page_metaboxes' );
function wps_press_page_metaboxes()
{
  add_meta_box(
        'wps_press_page_article_metas',
        __( 'Article metaboxes', 'wps_press_page' ),
        'wps_press_page_register_article_metas',
        'Articles',
        'normal',
        'core'
    );

}
function wps_press_page_register_article_metas($post, $box)
{
   $wps_press_page_article_metas = get_post_meta($post->ID, '_wps_press_page_article_metas_data', true);
   $wps_press_article_url = (! empty($wps_press_page_article_metas['wps_press_article_url'])) ? $wps_press_page_article_metas['wps_press_article_url'] : '';
   $wps_press_article_media = (! empty($wps_press_page_article_metas['wps_press_article_media'])) ? $wps_press_page_article_metas['wps_press_article_media'] : '';

   
  wp_nonce_field('wps_press_page_article_save','wps_press_page_article_nonce_field');
  echo '<table id="wps_press_page_articles" class="custom_post_content" style="width:60% !important;">';
  echo '<tr>';
  echo '<td colspan="2"> <hr> </td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td>'.__('Article url:', 'wps_press_page').'</td>';
  echo '<td>';
  echo '<input type="text" name="wps_press_page_article_metas[wps_press_article_url]" class="article_url" value="'.esc_url_raw($wps_press_article_url).'" size="50" style="width:100% !important;">';
  echo '</td>';
  echo '</tr>';
  echo '<tr>';
  echo '<td>'.__('Media name / domain :', 'wps_press_page').'</td>';
  echo '<td>';
  echo '<input type="text" name="wps_press_page_article_metas[wps_press_article_media]" class="article_media" value="'.esc_url_raw( $wps_press_article_media).'" size="30">';
  echo '</td>';
  echo '</tr>';
  echo '</table>';
}



//Step 4: Save Custom Posts and their metaboxes

add_action('save_post', 'wps_press_page_save_article');
function wps_press_page_save_article($post_id)
{
   global $post;

   if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) { return $post_id; }

   if (isset( $_POST['wps_press_page_article_metas']))
   {
       $verify = check_admin_referer('wps_press_page_article_save','wps_press_page_article_nonce_field');
          if ($verify == '1')
          {
               $wps_press_page_meta_data = $_POST['wps_press_page_article_metas'];
               $wps_press_page_meta_data = array_map('sanitize_text_field', $wps_press_page_meta_data);
               update_post_meta( $post_id, '_wps_press_page_article_metas_data',  $wps_press_page_meta_data);
          }

   }

}