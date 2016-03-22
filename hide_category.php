<?php
/*
Plugin Name: Hide Category
Plugin URI: http://commons.hwdsb.on.ca
Description: Hide a category so that users can use the main feed for most categories, but hide other categories to force navigation via a custom menu.
Version: 1.0
Author: r-a-y & mrjarbenne
Author URI: http://commons.hwdsb.on.ca

/**
* Exclude 'hide' category posts from homepage.
*/
function hwdsb_hide_exclude_from_home( $query = false ) {
// Bail if not home, not a query, or not main query
if ( ! is_home() || ! is_a( $query, 'WP_Query' ) || ! $query->is_main_query() )
return;
// Get 'hide' category
$cat = get_category_by_slug( 'hide' );
 
// Cat doesn't exist, so stop now!
if ( empty( $cat ) )
return;
 
// Exclude 'hide' category posts
$query->set( 'cat', '-' . $cat->term_id );
}
add_action( 'pre_get_posts', 'hwdsb_hide_exclude_from_home' );

// Remove categories from post meta - shared on basicwp.com
function the_category_filter($thelist,$separator=' ') {
	if(!defined('WP_ADMIN')) {
//list the category names to exclude
		$exclude = array('hide');
		$cats = explode($separator,$thelist);
		$newlist = array();
		foreach($cats as $cat) {
			$catname = trim(strip_tags($cat));
			if(!in_array($catname,$exclude))
				$newlist[] = $cat;
		}
		return implode($separator,$newlist);
	} else
		return $thelist;
}
add_filter('the_category','the_category_filter',10,2);

//* Remove categories from widgets - shared on https://wordpress.org/support/topic/excluding-categories-by-slug-from-the-category-widget

function exclude_widget_categories( $args ){

$excludes = array('hide'); //array with category slugs to be excluded
$cat_ids = array();
foreach( $excludes as $cat_slug ) {
  $cat = get_term_by( 'slug', $cat_slug, 'category' );
  if( $cat ) $cat_ids[] = $cat->term_id;
}
$exclude = implode( ',', $cat_ids ); // The IDs of the excluding categories
if( $cat_ids ) $args["exclude"] = $exclude;

return $args;
}

add_filter("widget_categories_args","exclude_widget_categories");
