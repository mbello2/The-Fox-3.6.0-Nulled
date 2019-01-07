<?php
global $rd_data;
$post=$wp_query->post;
$post_design = $rd_data['rd_blog_design_type'];
if(get_post_type() == 'portfolio'){
	include(TEMPLATEPATH.'/single-portfolio.php');
}elseif(get_post_type() == 'partners'){
	include(TEMPLATEPATH.'/single-staff.php');
}
elseif($post_design == 'business'){
	include(TEMPLATEPATH.'/single-business.php');
}
else{
	include(TEMPLATEPATH.'/single-default.php');
}

?>