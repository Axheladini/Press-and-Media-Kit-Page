<?php 
/*Button LOAD MORE RESOURCES Starts here*/
add_action( 'wp_footer', 'wps_press_page_load_more_resource_asstes_js' );
function wps_press_page_load_more_resource_asstes_js()
{ ?>
<script type="text/javascript">
   var page_rs = 3; // What page we are on.
   var ppp_rs = 2; // Post per page
   jQuery('#more_asset_resources').click(function(){
 
   jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url( 'admin-ajax.php'); ?>',
            data: {
                 action: "wps_load_more_resource_assets", 
                 offset_rs: (page_rs * ppp_rs), 
                 ppp_rs: ppp_rs
               },
             beforeSend: function() {
              // setting a timeout
            jQuery('.other_resources_holder').append("<span class='loading'>LOADING...</span>");
              },
            success: function(data){
                if(data == 0)
                {
                    jQuery('#more_asset_resources').remove();
                    jQuery( ".other_resources_holder .loading" ).html("<span class='no_more_results'>No more Resource to show!</span>");
                }
                else
                {
                    page_rs;
                    jQuery('#resources_tables').append(data);
                    jQuery( ".other_resources_holder .loading" ).html('');
                    jQuery( ".other_resources_holder .loading" ).remove();
                }
                //alert(html);
            }
        });
        return false;
    });
</script>
<?php }

function wps_load_more_resource_assets()
{       
          $offset_rs = $_POST["offset_rs"];
          $ppp_rs = $_POST["ppp_rs"];
          header("Content-Type: text/html");

          $other_resources = array( 'post_type' => 'resources', 'posts_per_page' => $ppp_rs, 'offset' => $offset_rs, 'meta_query' => array(array('key' => 'wps_press_page_resource_type_meta','value' => array('document', 'logo', 'image', 'vector', 'other'),'compare' => 'IN')));
          $other_resources_loop = new WP_Query($other_resources);
          $count_resources = $other_resources_loop->post_count;

         if ($count_resources > 0)
          {
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
                    $thumb_img = plugins_url('wps-press-page/images/pdf.png');
                    break;
                case 'cdr':
                    $thumb_img = plugins_url('wps-press-page/images/cdr.png');
                    break;
                case 'psd':
                    $thumb_img = plugins_url('wps-press-page/images/psd.png');
                    break;
                case 'ai':
                    $thumb_img = plugins_url('wps-press-page/images/ai.png');
                    break;
                case 'xcf':
                    $thumb_img = plugins_url('wps-press-page/images/xcf.png');
                    break;
                case 'gz':
                    $thumb_img = plugins_url('wps-press-page/images/gzip.png');
                    break;
                case 'tgz':
                    $thumb_img = plugins_url('wps-press-page/images/gzip.png');
                    break;
                case 'tar':
                    $thumb_img = plugins_url('wps-press-page/images/gzip.png');
                    break;
                case 'zip':
                    $thumb_img = plugins_url('wps-press-page/images/zip.png');
                    break;
                case 'rar':
                    $thumb_img = plugins_url('wps-press-page/images/rar.png');
                    break;
                case 'eps':
                    $thumb_img = plugins_url('wps-press-page/images/eps.png');
                    break;
                default:
                    $thumb_img = $resource_file;
            }

            $output_rs .= '<tr><td><img src="'.$thumb_img.'" class="resource_img"></img></td><td><span class="tbl_rs_title">'.$resource_title.'</span><br><span class="tbl_rs_type"><b>Type: </b>'.$resource_type.'</span></td><td>'.$resource_ext.'</td><td><a href="'.$resource_file.'" class="res_btn" target="_blank">Download</a></td></tr>';

            endwhile; 
            wp_reset_query();
            echo $output_rs;
            die();
          }
          else 
          {
            $output_rs = 0;
            echo $output_rs;
          }

          //$output = "<tr><td>Test ".$count_resources."</td><td>Test ".$ppp."</td><td>Test 3</td><td>Test 4</td>";

          //echo $output;

}
add_action( 'wp_ajax_wps_load_more_resource_assets', 'wps_load_more_resource_assets' );
add_action( 'wp_ajax_nopriv_wps_load_more_resource_assets', 'wps_load_more_resource_assets' );
/*Button LOAD MORE RESOURCES Ends here**/
/***************************************/


/*Button LOAD MORE ARTICLES Starts here*/
add_action( 'wp_footer', 'wps_press_page_load_more_articles_js' );
function wps_press_page_load_more_articles_js()
{ ?>

<script type="text/javascript">
   var page_ar  = 2; // What page we are on.
   var ppp_ar = 3; // Post per page
   jQuery('#load_more_articles').click(function(){

   jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url( 'admin-ajax.php'); ?>',
            data: {
                 action: "wps_load_more_articles_fx", 
                 offset_ar: (page_ar * ppp_ar), 
                 ppp_ar: ppp_ar
               },
             beforeSend: function() {
              // setting a timeout
            jQuery('.article_holder').append("<span class='loading'>LOADING...</span>");
              },
            success: function(data){
                if(data == 0)
                {
                    jQuery('#load_more_articles').remove();
                    jQuery( ".article_holder .loading" ).html("<span class='no_more_results'>No more Articles to show!</span>");
                }
                else
                {
                    page_ar++;
                    jQuery('.article_holder .article_list').append(data);
                    jQuery( ".article_holder .loading" ).html('');
                    jQuery( ".article_holder .loading" ).remove();
                }
                //alert(html);
            }
        });
        return false;



    });
</script>
<?php } 

function wps_load_more_articles_fx()
{ 
       $offset_ar = $_POST["offset_ar"];
       $ppp_ar = $_POST["ppp_ar"];
       header("Content-Type: text/html");

       $articles = array( 'post_type' => 'articles', 'posts_per_page' => $ppp_ar, 'offset' => $offset_ar, 'post_status' => 'publish');
       $articles_loop = new WP_Query($articles);
       $count_articles = $articles_loop->post_count;
              
          
      if ($count_articles > 0)
      {

        while ( $articles_loop->have_posts() ) : $articles_loop->the_post();

        $wps_press_page_article_metas = get_post_meta(get_the_ID(), '_wps_press_page_article_metas_data', true);
        $wps_press_article_url = (! empty($wps_press_page_article_metas['wps_press_article_url'])) ? $wps_press_page_article_metas['wps_press_article_url'] : ' ';
        $wps_press_article_media = (! empty($wps_press_page_article_metas['wps_press_article_media'])) ? $wps_press_page_article_metas['wps_press_article_media'] : ' ';
        $article_title = get_the_title();
             
        $output_ar .='<li><a href="'.$wps_press_article_url.'" target="_blank">'.$article_title.'</a><span class="article_domain">'.get_the_date().' - '.$wps_press_article_media.'</span></li>';
        endwhile; // end of the loop.
        wp_reset_postdata();
        echo $output_ar;
        die();
      }
      else 
      {
      	$output_ar = 0;
        echo $output_ar;
      }
     

}
add_action( 'wp_ajax_wps_load_more_articles_fx', 'wps_load_more_articles_fx' );
add_action( 'wp_ajax_nopriv_wps_load_more_articles_fx', 'wps_load_more_articles_fx' );
/*Button LOAD MORE ARTICLES Ends here*/
/***************************************/


/*Button LOAD MORE PRESS RELEASES Starts here*/
add_action( 'wp_footer', 'wps_press_page_load_more_releases_js' );
function wps_press_page_load_more_releases_js()
{ ?>

<script type="text/javascript">
   var page_pr = 2; // What page we are on.
   var ppp_pr = 3; // Post per page
   jQuery('#load_more_releases').click(function(){

   jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url( 'admin-ajax.php'); ?>',
            data: {
                 action: "wps_load_more_releases_fx", 
                 offset_pr: (page_pr * ppp_pr), 
                 ppp_pr: ppp_pr
               },
             beforeSend: function() {
              // setting a timeout
            jQuery('.releases_holder').append("<span class='loading'>LOADING...</span>");
              },
            success: function(data){
                if(data == 0)
                {
                    jQuery('#load_more_releases').remove();
                    jQuery( ".releases_holder .loading" ).html("<span class='no_more_results'>No more Press Releases to show!</span>");
                }
                else
                {
                    page_pr++;
                    jQuery('.releases_holder .article_list').append(data);
                    jQuery( ".releases_holder .releases_holder .loading" ).html('');
                    jQuery( ".releases_holder .loading" ).remove();
                }
                //alert(html);
            }
        });
        return false;



    });
</script>
<?php } 

function wps_load_more_releases_fx()
{ 
       $offset_pr = $_POST["offset_pr"];
       $ppp_pr = $_POST["ppp_pr"];
       header("Content-Type: text/html");

       /*Loop Press Releases*/
        $press_releases = array( 'post_type' => 'Press Reeleases', 'posts_per_page' => $ppp_pr, 'offset' => $offset_pr, 'post_status' => 'publish', 'meta_query' => array(array('key' => 'wps_press_page_releases_type','value' => array('document', 'link'),'compare' => 'IN')));
        $press_loop = new WP_Query($press_releases);
        $count_releases = $press_loop->post_count;
        
        
          
      if ($count_releases > 0)
      {
       
        while ( $press_loop->have_posts() ) : $press_loop->the_post();

        $wps_press_page_release_type = get_post_meta(get_the_ID(), 'wps_press_page_releases_type', true);
        $wps_press_page_release_link = get_post_meta(get_the_ID(), 'wps_press_page_releases_link_meta', true);
        $press_doc_file = get_post_meta(get_the_ID(), 'wps_press_page_releases_file', true);
        if(!empty($press_doc_file['url'])){$doc_url = $press_doc_file['url'];} else {$doc_url = "";}
        $release_title = get_the_title();
        
        if($wps_press_page_release_type == "link")
          {
               $output_pr .='<li class="release_link"><a href="'.$wps_press_page_release_link.'" target="_blank">'.$release_title.'</a><span class="article_domain">'.get_the_date().'</span></li>';
          }
        else if($wps_press_page_release_type == "document")
          {
              $output_pr .='<li  class="release_attachment"><a href="'.$doc_url.'" target="_blank">'.$release_title.'</a><span class="article_domain">'.get_the_date().'</span></li>';
          }

        
        endwhile; // end of the loop.
        wp_reset_postdata();
        echo $output_pr;
        die();
      }
      else 
      {
        $output_pr = 0;
        echo $output_pr;
      }
      
      /*Loop Press Releases ends here*/

     

}
add_action( 'wp_ajax_wps_load_more_releases_fx', 'wps_load_more_releases_fx' );
add_action( 'wp_ajax_nopriv_wps_load_more_releases_fx', 'wps_load_more_releases_fx' );


/*Button LOAD MORE PRESS RELEASES Ends here*/
/***************************************/


/*Button LOAD MORE BLOG POSTS Starts here*/
add_action( 'wp_footer', 'wps_press_page_load_more_blog_posts_js' );
function wps_press_page_load_more_blog_posts_js()
{ ?>

<script type="text/javascript">
   var page_bp = 2; // What page we are on.
   var ppp_bp = 3; // Post per page
   jQuery('#load_more_blog_posts').click(function(){

   jQuery.ajax({
            type: 'POST',
            url: '<?php echo admin_url( 'admin-ajax.php'); ?>',
            data: {
                 action: "wps_load_more_blog_posts_fx", 
                 offset_bp: (page_bp * ppp_bp), 
                 ppp_bp: ppp_bp
               },
             beforeSend: function() {
              // setting a timeout
            jQuery('.releases_blog_holder').append("<span class='loading'>LOADING...</span>");
              },
            success: function(data){
                if(data == 0)
                {
                    jQuery('#load_more_blog_posts').remove();
                    jQuery( ".releases_blog_holder .loading" ).html("<span class='no_more_results'>No more Press Releases to show!</span>");
                }
                else
                {
                    page_bp++;
                    jQuery('.releases_blog_holder .article_list').append(data);
                    jQuery( ".releases_blog_holder .loading" ).html('');
                    jQuery( ".releases_blog_holder .loading" ).remove();
                }
                //alert(html);
            }
        });
        return false;



    });
</script>
<?php } 

function wps_load_more_blog_posts_fx()
{ 
       $offset_bp = $_POST["offset_bp"];
       $ppp_bp = $_POST["ppp_bp"];
       header("Content-Type: text/html");

        $press_blog_releases = array( 'post_type' => 'Press Reeleases', 'posts_per_page' => $ppp_bp, 'offset' => $offset_bp, 'post_status' => 'publish', 'meta_query' => array(array('key' => 'wps_press_page_releases_type','value' => array('wp_post'),'compare' => 'IN')));
        $press_blog_loop = new WP_Query($press_blog_releases);
        $count__blog_releases = $press_blog_loop->post_count;
        
        
          
      if ($count__blog_releases > 0)
      {
        while ( $press_blog_loop->have_posts() ) : $press_blog_loop->the_post();
        $wps_press_page_release_type = get_post_meta(get_the_ID(), 'wps_press_page_releases_type', true);
        $wps_press_page_release_link = get_post_meta(get_the_ID(), 'wps_press_page_releases_link_meta', true);
        $release_title = get_the_title();
              
        $output_bp .='<li class="release_link"><a href="'.$wps_press_page_release_link.'" target="_blank">'.$release_title.'</a><span class="article_domain">'.get_the_date().'</span></li>';
         
        endwhile; // end of the loop.
        wp_reset_postdata();
        echo $output_bp;
        die();
      }
      
      else 
      {
        $output_bp = 0;
        echo $output_bp;
      }
      
}
add_action( 'wp_ajax_wps_load_more_blog_posts_fx', 'wps_load_more_blog_posts_fx' );
add_action( 'wp_ajax_nopriv_wps_load_more_blog_posts_fx', 'wps_load_more_blog_posts_fx' );
/*Button LOAD MORE BLOG POSTS Ends here*/
/***************************************/

?>