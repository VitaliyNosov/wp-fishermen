<?php
/**
 * Header Template (header.php)
 * @package WordPress
 * @subpackage fishermen
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php /* RSS и всякое */ ?>
	<link rel="alternate" type="application/rdf+xml" title="RDF mapping" href="<?php bloginfo('rdf_url'); ?>">
	<link rel="alternate" type="application/rss+xml" title="RSS" href="<?php bloginfo('rss_url'); ?>">
	<link rel="alternate" type="application/rss+xml" title="Comments RSS" href="<?php bloginfo('comments_rss2_url'); ?>">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<!--[if lt IE 9]>
	<script src="//html5shiv.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<?php 
/**
 * Vars
 */
$body_classes = ' bg-initial';
$background_color = 'white';
$page_background_color = 'default';
$page_id = get_the_ID();
$body_styles = '';
$data_on_bg = '';
$glows = '';
$glows_array = array();

if (is_home()){
	$page_id = get_option('page_for_posts');
}

$page_class = get_field('page_class', $page_id);
if ($page_class){
	$body_classes .= ' page-class-'.$page_class.'';
}

/**
 * Clases by taxonomy 'Page Type'
 */
$term_obj_list = get_the_terms( $page_id, 'page_type');
if ($term_obj_list){
	foreach($term_obj_list as $term){
		if ($term->slug == 'services'){
			$body_classes .= ' on-services-page';
		}
		if ($term->slug == 'cases'){
			$body_classes .= ' on-cases-page';
		}
	}
}

/**
 * Options
 */
$background_global = get_field('default_background', 'option');
$page_background_global = get_field('background', $page_id);

if ($page_background_global == 'custom'){
	$page_background_color_custom = get_field('custom_background_color', $page_id);
	if ($page_background_color_custom != 'colorpicker'){
		$body_classes .= ' site-fonts-color-bg-'.$page_background_color_custom.'';
		$body_classes .= ' site-bg-'.$page_background_color_custom.'';
		$data_on_bg = $page_background_color_custom;
	} else {
		$page_background_color_picker = get_field('custom_background_colorpicker', $page_id);
		$page_fonts_colors = get_field('fonts_color', $page_id);
		
		$body_styles .= 'background-color: '.$page_background_color_picker.' !important';
		$body_classes .= ' site-fonts-color-bg-'.$page_fonts_colors.'';
		$body_classes .= ' site-bg-'.$page_fonts_colors.'';
		$body_classes .= ' site-bg-custom';
		$data_on_bg = $page_fonts_colors;
	}
} else if ($background_global){
	$background_color = $background_global;
	$body_classes .= ' site-fonts-color-bg-'.$background_color.'';
	$body_classes .= ' site-bg-'.$background_color.'';
	$data_on_bg = $background_color;
}

/**
 * Glows
 */
$glows_posts = get_field('glows', 'option');
if (is_array($glows_posts)){
	foreach($glows_posts as $glows_post){
		if ($glows_post->ID == $page_id){
			$glows = 'has_glows';
		}
	}
}
?>
<body <?php body_class($body_classes); ?> style="<?php echo $body_styles; ?>">
	<?php wp_body_open(); ?>

	<div id="cursor" class="cursor" data-onbg="">
		<div class="cursor-shape"></div>
	</div>

	<div id="swup" class="site" flex layout="column" layout-align="start start" aria-live="polite">

		<header id="site-header" class="site-header" flex="none" data-onbg="bg-<?php echo $data_on_bg; ?>">

				<div id="logo" class="logo">
					<a href="<?php bloginfo('url'); ?>" title="<?php bloginfo('title'); ?>" flex  layout="row" layout-align="center center" data-swup-preload>
						<span class="logo-img icon-logo" flex="none"></span>
						<span id="logo-text" class="logo-text icon-wordmark" flex="none"></span>
					</a>
				</div>

				<div id="main-menu" class="main-menu" flex layout="row" layout-align="center start">
					<?php
						$args = array( 
							'theme_location' => 'top',
							'container'=> false,
							'menu_id' => 'top-nav-ul',
							'items_wrap' => '<ul id="%1$s" class="nav navbar-nav %2$s">%3$s</ul>',
							'menu_class' => 'top-menu',	 
							'depth' => '1', 		
						);
						wp_nav_menu($args);
					?>
				</div>
						
				<div class="menu-toggle">
					<div id="menu-toggle-button" class="menu-toggle-button active-element" flex="none">
						<span class="menu-toggle-button-text">Menu</span>
						<span class="menu-toggle-button-shape"></span>
					</div>
				</div>
			
			<?php get_template_part('inc/parts/header-menu'); ?>

		</header>

		<div id="site-content" class="site-content" flex="noshrink">
			<main id="site-main" class="site-main" role="main">
			
			<?php if ($glows == 'has_glows'){ ?>
				<div id="glows" class="glows">
					<div class="glow glow-animated glow-1 blue"></div>
					<div class="glow glow-animated glow-2 bright-green"></div>
					<div class="glow glow-animated glow-3 purple"></div>
					<div class="glow glow-animated glow-4 blue"></div>
					<div class="glow glow-animated glow-5 bright-green"></div>
					<div class="glow glow-animated glow-6 purple"></div>
				</div>
			<?php } ?>

			<?php 
			if(is_page_template('page-templates/contact.php')){ ?>
				<div id="glows" class="glows glows-contact">
					<div class="glow glow-animated glow-1 blue"></div>
					<div class="glow glow-animated glow-2 bright-green"></div>
				</div>	
			<?php }	?>