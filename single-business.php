<?php 
/// Set the slider

$slider_page_id = $post->ID;
if(is_home() && !is_front_page()){
	$slider_page_id = get_option('page_for_posts');
}

if(get_post_meta($slider_page_id, 'rd_slider_type', true) == 'layer' && (get_post_meta($slider_page_id, 'rd_slider', true) || get_post_meta($slider_page_id, 'rd_slider', true) != 0)){ 

	function add_revolution_slider(){
		echo '<div>';
	    echo do_shortcode('[rev_slider '.get_post_meta(get_the_ID(), 'rd_slider', true).']'); 
		echo '</div>';
	}
	
	if(	get_post_meta($slider_page_id, 'rd_slider_position', true) == 'above'){
		add_action( '__before_header' , 'add_revolution_slider');
	}
	else{
		add_action( '__after_page_title' , 'add_revolution_slider');
	}


}
if(get_post_meta($slider_page_id, 'rd_slider_type', true) == 'layerslider' && (get_post_meta($slider_page_id, 'rd_layerslider', true) || get_post_meta($slider_page_id, 'rd_layerslider', true) != 0)){ 

	function add_layer_slider(){
		echo '<div>';
	    echo do_shortcode('[layerslider  id="'.get_post_meta(get_the_ID(), 'rd_layerslider', true).'"]'); 
		echo '</div>';
	}
	
	if(	get_post_meta($slider_page_id, 'rd_slider_position', true) == 'above'){
		add_action( '__before_header' , 'add_layer_slider');
	}
	else{
		add_action( '__after_page_title' , 'add_layer_slider');
	}


}



get_header();


global $rd_data; 
$header_top_bar = get_post_meta( $post->ID, 'rd_top_bar', true );
$header_transparent = get_post_meta( $post->ID, 'rd_header_transparent', true );
$p_sidebar = get_post_meta( $post->ID, 'rd_sidebar', true );
$title = get_post_meta($post->ID, 'rd_title', true);
$title_height = get_post_meta($post->ID, 'rd_title_height', true);
$title_color = get_post_meta($post->ID, 'rd_title_color', true);
$titlebg_color = get_post_meta($post->ID, 'rd_titlebg_color', true);
$ctbg = get_post_meta($post->ID, 'rd_ctbg', true);
$post_nav = get_post_meta($post->ID, 'rd_show_navigation', true);
$content_border_color = $rd_data['rd_content_border_color'];
$bc = get_post_meta($post->ID, 'rd_bc', true);
$sb_style = $rd_data['rd_sidebar_style'];
$bo_sb = $rd_data['rd_blog_single_sidebar'];
$bo_nav = $rd_data['rd_blog_single_nav'];
$bo_share = $rd_data['rd_blog_single_share'];
$bo_author = $rd_data['rd_blog_single_author'];
$bo_related = $rd_data['rd_blog_single_related'];
	   

/// Check if need to hide header top bar

if ($header_top_bar == 'yes' ){

 echo '<style type="text/css" >#top_bar {display:none;}</style>';

}





if($header_transparent == "yes" && $rd_data['rd_nav_type'] !== 'nav_type_19' && $rd_data['rd_nav_type'] !== 'nav_type_19_f' ){
 ?>
<script type="text/javascript" charset="utf-8">
		var j$ = jQuery;
		j$.noConflict();
		"use strict";
		
		
		j$('#header_container').css('position', 'absolute');
		j$('#header_container').css('width', '100%');	
		j$('header').addClass('transparent_header');		
		j$('.header_bottom_nav').addClass('transparent_header');
		
</script>
<?php

} if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>
<?php
/// Check title style
if($ctbg !== ''){
$t_bg = $ctbg;
}else{
	
$t_bg = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
}
if($title !== 'no'){ 

 ?>
<style type="text/css" >
.business_sp_title {
	background:url('<?php echo esc_attr($t_bg); ?>');
}
</style>
<div class="business_sp_title">
  <?php if($post_nav !== 'no' && $bo_nav !== 'yes' ) { ?>
  <div class="bs_single_post_navigation">
    <?php $prev = get_permalink(get_adjacent_post(false,'',false)); if ($prev != get_permalink()) { ?>
    <a href="<?php echo esc_url($prev); ?>" class="bs_next_project"><span><?php echo __('Next', 'thefoxwp'); ?></span></a>
    <?php } ?>
    <?php $next = get_permalink(get_adjacent_post(false,'',true)); if ($next != get_permalink()) { ?>
    <a href="<?php echo esc_url($next); ?>" class="bs_previous_project"><span><?php echo __('Previous', 'thefoxwp'); ?></a>
    <?php } ?>
    </span></div>
  <?php } ?>
  <div class="wrapper">
    <h1>
      <?php the_title(); ?>
    </h1>
    <span class="sp_b_avatar"><?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), 80 ); }?></span>
    <span class="sp_b_author"><?php echo the_author_posts_link(); ?></span>
    <span class="sp_b_date"><?php the_time('j F, Y') ?></span>
  </div>
</div>
<?php } 

do_action( '__after_page_title' );

?>
<div class="section def_section">
  <div class="wrapper section_wrapper">
    <?php if ( $p_sidebar == 'right' && $bo_sb !== 'yes' || $p_sidebar == 'left' && $bo_sb !== 'yes' ) { 
 ?>
    <div id="posts" class=" <?php if ( $p_sidebar == 'right' ) { echo 'left_posts '; } else { echo 'right_posts ';} if ( $sb_style == 'business_sb'){echo " business_posts";} ?>">
      <?php  }else{ ?>
      <div id="fw_c" class="fw_single_post clearfix">
        <?php } ?>
        
        <!-- .post -->
        
        <div class="post post_single post_single_business vc_row">
          <?php


$post_format = get_post_format();
$content = get_the_content(__('Read more', 'thefoxwp'));	
$my_video = get_post_meta($post->ID, 'rd_video', true);
$quote_text = get_post_meta($post->ID, 'rd_quote', true);	
$quote_author = get_post_meta($post->ID, 'rd_quote_author', true);

if(get_post_meta($post->ID, 'rd_show_slider', true) == 'yes') {

	if($post_format == '' && '' != get_the_post_thumbnail() || $post_format == 'image' && '' != get_the_post_thumbnail() ) {
	$url = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );
		echo '<a href="'.$url. '" class="prettyPhoto ">';
		echo "<div class='post-attachement'>";
		echo the_post_thumbnail('blog_tn');
		echo "</a></div><div class='sep_25'></div>";
	}
	elseif( $post_format == 'quote' ){	
	echo '<a class="post_quote_ctn"><div class="post_quote_text" >';
	echo !empty( $quote_text ) ? $quote_text : '';
	echo '</div>';
	echo '<div class="post_quote_author" >';
	echo !empty( $quote_author ) ? $quote_author : '';	
	echo '</div>';
			echo '</a>';
	}elseif( $post_format == 'audio' ){
		preg_match("!\[audio.+?\]\[\/audio\]!", $content , $match_audio);
		if(!empty($match_audio)) {
			echo '<div class="audio_ctn" >';
			echo do_shortcode($match_audio[0]);
			echo '</div>';
			$content = str_replace($match_audio[0], "", $content);
			$content = apply_filters('the_content', $content);
			$content = str_replace(']]>', ']]&gt;', $content);
			echo "<div class='sep_25'></div>";
		}
	}elseif ($post_format == 'video' && $my_video !== ''){
		echo "<div class='post-attachement'>".$my_video."</div><div class='sep_25'></div>";}
	
	elseif($post_format == 'gallery' ){
			$galleryArray = get_post_gallery_ids($post->ID); 
				if ($galleryArray) {
			echo "<div class='post-attachement'><div class='flexslider'><ul class='slides'>";
					foreach ($galleryArray as $id) {
			$url = wp_get_attachment_url( $id, 'full', 0 );
			echo "<li>";
			echo '<a href="'.$url. '" class="prettyPhoto ">';
			echo wp_get_attachment_image( $id, 'blog_tn', 0 );
			echo "</a></li>";
					}
			echo "</ul></div></div><div class='sep_25'></div>"; 
				}
	}
}
 
 ?>
          <div class="post_ctn clearfix"> 
            
            <!-- .entry -->
            <div class="entry">
              <?php 	the_content(__('Read more', 'thefoxwp')); wp_link_pages(); ?>
            </div>
            <!-- .entry END --> 
          </div>
        </div>
        <!-- .post-content END--> 
        <!-- .post END -->
        
        <?php endwhile; ?>
        <?php if(get_post_meta($post->ID, 'rd_share_buttons', true) == 'yes' && $bo_share !=='yes') {  ?>
        <div class="share_icons_business">
          <?php rd_share_panel(); ?>
        </div>
        <?php } if(get_post_meta($post->ID, 'rd_author_bio', true) == 'yes' && $bo_author !== 'yes') {?>
        <div id="author-bio-business">
          <?php if (function_exists('get_avatar')) { echo get_avatar( get_the_author_meta('email'), 103 ); }?>
          <div id="author-info">
            <h3>
              <?php the_author(); ?>
            </h3>
            <p>
              <?php the_author_meta('description'); ?>
            </p>
            <?php echo '<a href="'. get_author_posts_url(get_the_author_meta( 'ID' )).'" class="author_posts_link">'. __('More posts by','thefoxwp') .' '.get_the_author().' </a>'; ?> </div>
        </div>
        <?php } ?>
        <div id="business_comments">
          <?php comments_template(); ?>
        </div>
      </div>
      
      <!-- #posts END -->
      
      <?php if ( $p_sidebar == 'right' && $bo_sb !== 'yes' || $p_sidebar == 'left' && $bo_sb !== 'yes' ) { ?>
      <div id="sidebar" class=" <?php if ( $p_sidebar == 'right' ) { echo "right_sb"; } else { echo "left_sb"; } if ( $sb_style == 'business_sb'){echo " business_sidebar";} ?>">
        <?php if ( is_active_sidebar( 'thefox_mc_sidebar' ) ) { generated_dynamic_sidebar(); } ?>
      </div>
      <div class="clearfix"></div>
      <?php  } ?>
      
      <!-- #page_content END --> 
    </div>
    <?php	if(get_post_meta($post->ID, 'rd_related_post', true) == 'yes' && $bo_related !=='yes') {



ob_start();
			
		echo '
		<div class="business_related_carousel"><script type="text/javascript" charset="utf-8">
		var j$ = jQuery;
		j$.noConflict();
		"use strict";
	//setup up Carousel
		j$(window).load(function() {
		j$(".rp_business ul").carouFredSel({
					responsive: true,
					width: "100%",
					scroll: 1,
					prev: ".b_related_left",
					next: ".b_related_right",
					auto: false,
					items: {
						width: 310,
						height: "variable",
					//	height: "30%",	//	optionally resize item-height
						visible: {
							min: 1,
							max: 1
						}
					}
				});
				});
	</script>
	
	<div class="b_related_nav">
  <p class="b_related_left"></p>
  <p class="b_related_right"></p>
</div>
	<div class="rp_business">
<ul>';




   global $post;
		$current_post = array($post->ID);
$related = get_related_tag_posts_ids( $post->ID, 5 );
        $query = new WP_Query();
		$i = 0;
        $query->query(array(
            'post_type' => 'Post',
            'posts_per_page' => '8',
		'post__in'      => $related,
		'orderby'       => 'post__in',
        'post__not_in' => $current_post,
		'no_found_rows' => true, // no need for pagination
	
			


        ));
      
				
        if ($query->have_posts()) : while ($query->have_posts()) : $query->the_post(); 
      

$rp_bg = wp_get_attachment_url( get_post_thumbnail_id($post->ID), 'full' );

?>
    <!-- related post -->
    
    <li class="business_related_post" style="background:url('<?php echo esc_attr($rp_bg); ?>')">
      <div class="wrapper">
        <h4><?php echo esc_attr(__('You may also like','thefoxwp')); ?></h4>
        <!-- .title -->
        <h2 class="b-post-title">
          <?php the_title(); ?>
        </h2>
        <!-- .title END--> 
        <a class="b-read-now" href="<?php the_permalink() ?>"><?php echo esc_attr(__('Read now','thefoxwp')); ?></a> </div>
    </li>
    <?php  endwhile; endif; ?>
    <?php wp_reset_postdata(); ?>
    </ul>
  </div>
</div>
<?php

$output_string = ob_get_contents();
ob_end_clean();
	
echo !empty( $output_string ) ? $output_string : '';		
	

} ?>
</div>
<?php else : ?>
<div id="notfound">
  <h2>Not Found</h2>
  <p>Sorry, but you are looking for something that isn't here.</p>
</div>
<?php endif; ?>
<?php get_footer(); ?>
