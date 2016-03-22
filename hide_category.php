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
