<?php
// Register Custom Post Type Project
function create_projects_cpt() {

	$labels = array(
		'name' => _x( 'Project', 'Post Type General Name', 'wachifamily' ),
		'singular_name' => _x( 'Projects', 'Post Type Singular Name', 'wachifamily' ),
		'menu_name' => _x( 'Projects', 'Admin Menu text', 'wachifamily' ),
		'name_admin_bar' => _x( 'Projects', 'Add New on Toolbar', 'wachifamily' ),
		'archives' => __( 'Projects Archives', 'wachifamily' ),
		'attributes' => __( 'Projects Attributes', 'wachifamily' ),
		'parent_item_colon' => __( 'Parent Projects:', 'wachifamily' ),
		'all_items' => __( 'All Project', 'wachifamily' ),
		'add_new_item' => __( 'Add New Projects', 'wachifamily' ),
		'add_new' => __( 'Add New', 'wachifamily' ),
		'new_item' => __( 'New Projects', 'wachifamily' ),
		'edit_item' => __( 'Edit Projects', 'wachifamily' ),
		'update_item' => __( 'Update Projects', 'wachifamily' ),
		'view_item' => __( 'View Projects', 'wachifamily' ),
		'view_items' => __( 'View Project', 'wachifamily' ),
		'search_items' => __( 'Search Projects', 'wachifamily' ),
		'not_found' => __( 'Not found', 'wachifamily' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'wachifamily' ),
		'featured_image' => __( 'Featured Image', 'wachifamily' ),
		'set_featured_image' => __( 'Set featured image', 'wachifamily' ),
		'remove_featured_image' => __( 'Remove featured image', 'wachifamily' ),
		'use_featured_image' => __( 'Use as featured image', 'wachifamily' ),
		'insert_into_item' => __( 'Insert into Projects', 'wachifamily' ),
		'uploaded_to_this_item' => __( 'Uploaded to this Projects', 'wachifamily' ),
		'items_list' => __( 'Project list', 'wachifamily' ),
		'items_list_navigation' => __( 'Project list navigation', 'wachifamily' ),
		'filter_items_list' => __( 'Filter Project list', 'wachifamily' ),
	);
	$args = array(
		'label' => __( 'Projects', 'wachifamily' ),
		'description' => __( 'Projects', 'wachifamily' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-awards',
		'supports' => array('title', 'editor', 'thumbnail'),
		'taxonomies' => array(),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 20,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => false,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
	);
	register_post_type( 'projects', $args );

}
add_action( 'init', 'create_projects_cpt', 0 );