<?php 
/**
 *
 *Show all: Media Kit Resources, Articles, Press Releases
 *
 * @package Press & media kit 
 * @since Press & media kit 1.0
 */

function wps_press_page_show_all_shortcode() 
{
 $html = "<div id='wps_press_page_holder'>";

  $html .= "<div class='wps_press_page_left_holder'>";
  $options = get_option( 'wps_press_page_press_page_section' );
  $company_name = esc_html($options['wps_press_page_company_name']);

  $html .= '<h1 class="section_title ">'.__( 'Company', 'wps_press_page' ).'</h1>';
  $html .= '<hr class="wps_press_page_title_hr">';
  $html .= '<p class="company_about">'.esc_html($options['wps_press_page_company_about']).'</p>';
 

 $html .= '<span class="company_detail"><b>Official Name: </b>'.esc_html($options['wps_press_page_company_name']).'</span>
 <span class="company_detail"><b>'.__( 'Domain: ', 'wps_press_page' ).'</b>'.esc_url_raw($options['wps_press_page_company_domain']).'</span>
 <span class="company_detail"><b>'.__( 'Email: ', 'wps_press_page' ).'</b>'.esc_html($options['wps_press_page_company_email']).'</span>
 <span class="company_detail"><b>'.__( 'Phone: ', 'wps_press_page' ).'</b>'.esc_html($options['wps_press_page_company_phone']).'</span>
 <span class="company_detail"><b>'.__( 'Founded: ', 'wps_press_page' ).'</b>'.esc_html($options['wps_press_page_company_founded']).'</span>
 <span class="company_detail"><b>'.__( 'Employees: ', 'wps_press_page' ).'</b>'.esc_html($options['wps_press_page_company_employees']).'</span>
 <span class="company_detail"><b>'.__( 'Address: ', 'wps_press_page' ).'</b>'.esc_html($options['wps_press_page_company_address']).'</span>';
 $html .= ''.stripslashes($options['wps_press_page_company_maps']).'';
 $html .= '<div class="company_social_media">';
   if(!empty($options['wps_press_page_company_facebook']))
   {
   	 $html .= '<div class="social_icon"><a href="'.esc_url_raw($options['wps_press_page_company_facebook']).'" target="_blank" alt="Facebook"><img src="'.plugins_url('images/social_media/fb.png', dirname(__FILE__) ).'" alt="Facebook"></img></a></div>';
   }
   if(!empty($options['wps_press_page_company_twitter']))
   {
   	 $html .= '<div class="social_icon"><a href="'.esc_url_raw($options['wps_press_page_company_twitter']).'" target="_blank" alt="Twitter"><img src="'.plugins_url('images/social_media/twitter.png', dirname(__FILE__) ).'"></img></a></div>';
   }
   if(!empty($options['wps_press_page_company_linkedin']))
   {
   	 $html .= '<div class="social_icon"><a href="'.esc_url_raw($options['wps_press_page_company_linkedin']).'" target="_blank" alt="linkedin"><img src="'.plugins_url('images/social_media/linkedin.png' , dirname(__FILE__) ).'"></img></a></div>';
   }
   if(!empty($options['wps_press_page_company_youtube']))
   {
   	 $html .= '<div class="social_icon"><a href="'.esc_url_raw($options['wps_press_page_company_youtube']).'" target="_blank" alt="Youtube"><img src="'.plugins_url('images/social_media/youtube.png', dirname(__FILE__) ).'"></img></a></div>';
   }
   if(!empty($options['wps_press_page_company_googleplus']))
   {
   	 $html .= '<div class="social_icon"><a href="'.esc_url_raw($options['wps_press_page_company_googleplus']).'" target="_blank" alt="Google +"><img src="'.plugins_url('images/social_media/google_plus.png', dirname(__FILE__) ).'"></img></a></div>';
   }
      if(!empty($options['wps_press_page_company_behance']))
   {
     $html .= '<div class="social_icon"><a href="'.esc_url_raw($options['wps_press_page_company_behance']).'" target="_blank" alt="Behance"><img src="'.plugins_url('images/social_media/behance.png', dirname(__FILE__) ).'"></img></a></div>';
   }
      if(!empty($options['wps_press_page_company_dribble']))
   {
     $html .= '<div class="social_icon"><a href="'.esc_url_raw($options['wps_press_page_company_dribble']).'" target="_blank" alt="Dribble"><img src="'.plugins_url('images/social_media/dribble.png', dirname(__FILE__) ).'"></img></a></div>';
   }
      if(!empty($options['wps_press_page_company_instagram']))
   {
     $html .= '<div class="social_icon"><a href="'.esc_url_raw($options['wps_press_page_company_instagram']).'" target="_blank" alt="Instagram"><img src="'.plugins_url('images/social_media/instagram.png', dirname(__FILE__) ).'"></img></a></div>';
   }
      if(!empty($options['wps_press_page_company_tumblr']))
   {
     $html .= '<div class="social_icon"><a href="'.esc_url_raw($options['wps_press_page_company_tumblr']).'" target="_blank" alt="Tumblr"><img src="'.plugins_url('images/social_media/tumblr.png', dirname(__FILE__) ).'"></img></a></div>';
   }
      if(!empty($options['wps_press_page_company_pinterest']))
   {
     $html .= '<div class="social_icon"><a href="'.esc_url_raw($options['wps_press_page_company_pinterest']).'" target="_blank" alt="Pinterest"><img src="'.plugins_url('images/social_media/pinterest.png', dirname(__FILE__) ).'"></img></a></div>';
   }
 $html .= '</div>';
 $html .= '<br><b><h1 class="section_title ">'.__( 'Resources', 'wps_press_page' ).'</b></h1>';
 $html .= '<hr class="wps_press_page_title_hr">';
 $html .= '<h2 class="section_subtitle ">screenshots, logos, headshots & more</h2>';

        /*Loop video resource starts here*/
        $video_resources = array( 'post_type' => 'resources', 'posts_per_page' => 10, 'meta_query' => array(array('key' => 'wps_press_page_resource_type_meta','value' => 'video')));
        $video_loop = new WP_Query( $video_resources );
        $count_videos = $video_loop->post_count;
          
        if ($count_videos > 0)
        {

         $html .= '<div class="video_resource_holder"><h1 class="video_section_title">'.__( 'Screencast / Video', 'wps_press_page' ).'</h1>';
	        while ( $video_loop->have_posts() ) : $video_loop->the_post();
            $html .= '<div style="width:100% !important; height:100% !important; padding-top:25px !important; padding-bottom:25px !important;">';
	        $html .= get_the_content();
	        $html .= '</div>';
	        endwhile; // end of the loop.
	      $html .= '</div>';
        }
        wp_reset_postdata();
        /*Loop video resource ends here*/


        /*Loop Other Resources*/
        $other_resources = array( 'post_type' => 'resources', 'posts_per_page' => 6, 'post_status' => 'publish', 'meta_query' => array(array('key' => 'wps_press_page_resource_type_meta','value' => array('document', 'logo', 'image', 'vector', 'other'),'compare' => 'IN')));
        $other_resources_loop = new WP_Query($other_resources);
        $count_resources = $other_resources_loop->post_count;
        $all_resources = wp_count_posts( 'resources' )->publish; 

        if ($count_resources > 0)
        {

          $html .= '<div class="other_resources_holder"><h1 class="resource_section_title">'.__( 'Additional Assets / Videos', 'wps_press_page' ).'</h1>';
          $html .='<table width="100%" id="resources_tables" cellspacing="0" cellpadding="0" border="none">';  
          $html .= '<tbody><tr class="heading"><th border="0" width="25%" align="center" valign="middle">Preview</th><th width="25%" align="center">Details</th><th width="25%" align="center" valign="middle">File Type</th><th width="25%" align="center" valign="middle">Download</th></tr>';
            while ( $other_resources_loop->have_posts() ) : $other_resources_loop->the_post();
            
            $resource_file_upload = get_post_meta( get_the_ID(), 'resource_file_uploaded', true ); 
	        if(!empty($resource_file_upload['url'])){ $resource_file = $resource_file_upload['url']; } else $resource_file ="";
          $resource_type = get_post_meta( get_the_ID(), 'wps_press_page_resource_type_meta', true );
	        $resource_title = get_the_title();
	        $resource_ext = pathinfo($resource_file, PATHINFO_EXTENSION);
            
            switch ($resource_ext) {
    case 'jpg':
        $thumb_img = $resource_file;
        break;
    case 'gif':
        $thumb_img = $resource_file;
        break;
    case 'png':
        $thumb_img = $resource_file;
        break;
    case 'pdf':
        $thumb_img = plugins_url('images/pdf.png' , dirname(__FILE__) );
        break;
    case 'cdr':
        $thumb_img = plugins_url('images/cdr.png' , dirname(__FILE__) );
        break;
    case 'psd':
        $thumb_img = plugins_url('images/psd.png' , dirname(__FILE__) );
        break;
    case 'ai':
        $thumb_img = plugins_url('images/ai.png' , dirname(__FILE__) );
        break;
    case 'xcf':
        $thumb_img = plugins_url('images/xcf.png', dirname(__FILE__) );
        break;
    case 'gz':
        $thumb_img = plugins_url('images/gzip.png', dirname(__FILE__) );
        break;
    case 'tgz':
        $thumb_img = plugins_url('images/gzip.png', dirname(__FILE__) );
        break;
    case 'tar':
        $thumb_img = plugins_url('images/gzip.png', dirname(__FILE__) );
        break;
    case 'zip':
        $thumb_img = plugins_url('images/zip.png', dirname(__FILE__) );
        break;
    case 'rar':
        $thumb_img = plugins_url('images/rar.png', dirname(__FILE__) );
        break;
    case 'eps':
        $thumb_img = plugins_url('images/eps.png', dirname(__FILE__) );
        break;
    default:
        $thumb_img = $resource_file;
}

            $html .= '<tr><td><img src="'.esc_url_raw($thumb_img).'" class="resource_img"></img></td><td><span class="tbl_rs_title">'.esc_url_raw($resource_title).'</span><br><span class="tbl_rs_type"><b>Type: </b>'.esc_url_raw($resource_type).'</span></td><td>'.esc_url_raw($resource_ext).'</td><td><a href="'.esc_url_raw($resource_file).'" class="res_btn" target="_blank">'.__( 'Download', 'wps_press_page' ).'</a></td></tr>';

            endwhile; 

          $html .= '</tbody></table>';
          if($all_resources > 6)
          {
            $html .='<div class="view_more_holder"><a href="javascript:void(0);" id="more_asset_resources" class="view_more_btn">'.__( 'Load more articles', 'wps_press_page' ).'</a></div>';
           }
          $html .= '</div>';
        }
  /*Loop Other Resources ends here*/
  $html .= "</div>"; 
  /*Company Details, Videos, Asset files ends here*/
  /*Articles, Press Releases and Blog Posts start here*/
  $html .= "<div class='wps_press_page_right_holder'>";
  $html .= '<h1 class="section_title ">'.__( 'Our Latest', 'wps_press_page' ).'</h1>';
  $html .= '<hr class="wps_press_page_title_hr">';

        /*Loop Articles*/
        $articles = array( 'post_type' => 'articles', 'posts_per_page' => 6, 'post_status' => 'publish');
        $articles_loop = new WP_Query($articles);
        $count_articles = $articles_loop->post_count;
        $all_articles = wp_count_posts( 'articles' )->publish;
        
        
          
      if ($count_articles > 0)
      {
        $html .= '<div class="article_holder"><h1 class="latest_section_title">'.__( 'Articles', 'wps_press_page' ).'</h1>';
        $html .= '<ul class="article_list">';
        while ( $articles_loop->have_posts() ) : $articles_loop->the_post();

        $wps_press_page_article_metas = get_post_meta(get_the_ID(), '_wps_press_page_article_metas_data', true);
        $wps_press_article_url = (! empty($wps_press_page_article_metas['wps_press_article_url'])) ? $wps_press_page_article_metas['wps_press_article_url'] : ' ';
        $wps_press_article_media = (! empty($wps_press_page_article_metas['wps_press_article_media'])) ? $wps_press_page_article_metas['wps_press_article_media'] : ' ';
        $article_title = get_the_title();
             
        $html .='<li><a href="'.esc_url_raw($wps_press_article_url).'" target="_blank">'.esc_html($article_title).'</a><span class="article_domain">'.get_the_date().' - '.esc_html($wps_press_article_media).'</span></li>';
        endwhile; // end of the loop.
        $html .= '</ul>';
        if ($all_articles > 6)
        {
          $html .='<div class="view_more_holder"><a href="javascript:void(0);" id="load_more_articles" class="view_more_btn">'.__( 'Load more articles', 'wps_press_page' ).'</a></div>';
        }
        $html .= '</div>';
      }
      wp_reset_postdata();
      /*Loop Articles ends here*/

      /*Loop Press Releases*/
        $press_releases = array( 'post_type' => 'Press Reeleases', 'posts_per_page' => 6, 'post_status' => 'publish', 'meta_query' => array(array('key' => 'wps_press_page_releases_type','value' => array('document', 'link'),'compare' => 'IN')));
        $press_loop = new WP_Query($press_releases);
        $count_releases = $press_loop->post_count;
        $all_releases = wp_count_posts( 'pressreeleases' )->publish;
        
          
      if ($count_releases > 0)
      {
        $html .= '<div class="releases_holder"><h1 class="latest_section_title">'.__( 'Press Release', 'wps_press_page' ).'</h1>';
        $html .= '<ul class="article_list">';
        while ( $press_loop->have_posts() ) : $press_loop->the_post();

        $wps_press_page_release_type = get_post_meta(get_the_ID(), 'wps_press_page_releases_type', true);
        $wps_press_page_release_link = get_post_meta(get_the_ID(), 'wps_press_page_releases_link_meta', true);
        $press_doc_file = get_post_meta(get_the_ID(), 'wps_press_page_releases_file', true);
        if(!empty($press_doc_file['url'])){$doc_url = $press_doc_file['url'];} else {$doc_url = "";}
        $release_title = get_the_title();
        
        if($wps_press_page_release_type == "link")
          {
                $html .='<li class="release_link"><a href="'.esc_url_raw($wps_press_page_release_link).'" target="_blank">'.esc_html($release_title).'</a><span class="article_domain">'.get_the_date().'</span></li>';
          }
        else if($wps_press_page_release_type == "document")
          {
               $html .='<li  class="release_attachment"><a href="'.esc_url_raw($doc_url).'" target="_blank">'.esc_html($release_title).'</a><span class="article_domain">'.get_the_date().'</span></li>';
          }

        
        endwhile; // end of the loop.
        $html .= '</ul>';
        if($all_releases > 6)
        {
          $html .='<div class="view_more_holder"><a href="javascript:void(0);" id="load_more_releases" class="view_more_btn">'.__( 'Load more press releases', 'wps_press_page' ).'</a></div>';
        }
        $html .= '</div>';
      }
      wp_reset_postdata();
      /*Loop Press Releases ends here*/




   /*Loop Press Releases*/
        $press_blog_releases = array( 'post_type' => 'Press Reeleases', 'posts_per_page' => 6, 'post_status' => 'publish', 'meta_query' => array(array('key' => 'wps_press_page_releases_type','value' => array('wp_post'),'compare' => 'IN')));
        $press_blog_loop = new WP_Query($press_blog_releases);
        $count__blog_releases = $press_blog_loop->post_count;
        $all_blog_releases = wp_count_posts( 'pressreeleases' )->publish;
        
          
      if ($count__blog_releases > 0)
      {
        $html .= '<div class="releases_blog_holder"><h1 class="latest_section_title">'.__( 'Featured Blog Posts', 'wps_press_page' ).'</h1>';
        $html .= '<ul class="article_list">';
        while ( $press_blog_loop->have_posts() ) : $press_blog_loop->the_post();

        $wps_press_page_release_type = get_post_meta(get_the_ID(), 'wps_press_page_releases_type', true);
        $wps_press_page_release_link = get_post_meta(get_the_ID(), 'wps_press_page_releases_link_meta', true);
        $release_title = get_the_title();
        
        
        $html .='<li class="release_link"><a href="'.esc_url_raw($wps_press_page_release_link).'" target="_blank">'.esc_html($release_title).'</a><span class="article_domain">'.get_the_date().'</span></li>';
         
        endwhile; // end of the loop.
        $html .= '</ul>';
        if ($all_blog_releases > 6)
        {
         $html .='<div class="view_more_holder"><a href="javascript:void(0);" id="load_more_blog_posts" class="view_more_btn">'.__( 'Load more press releases', 'wps_press_page' ).'</a></div>';
        }
         $html .= '</div>';
      }
      wp_reset_postdata();
      /*Loop Press Releases ends here*/
 $html .= "</div>";
  /*Articles, Press Releases and Blog Posts ends here*/

 $html .="</div>";

 return $html;
}

add_shortcode( 'press_page', 'wps_press_page_show_all_shortcode' );




?>