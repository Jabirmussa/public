<?php

define( 'THEME_PATH', get_template_directory() );
define( 'THEME_URI', get_template_directory_uri() );

// require_once( 'includes/blocks.php' );
require_once( 'includes/default-settings.php' );
require_once( 'includes/post-types.php' );

add_action( 'after_setup_theme', function () {
	register_nav_menus( [
		'headermenu' => 'Headermenu',
		'footermenu' => 'Footer menu',
	] );
} );

add_filter( 'show_admin_bar' , '__return_false' );

add_action( 'wp_enqueue_scripts', function () {
	wp_dequeue_style( 'wp-block-library' );
	wp_enqueue_style( 'stylesheet', get_stylesheet_uri(), [], filemtime( THEME_PATH . '/style.css' ) );
	wp_enqueue_style( 'googlefonts',"https://fonts.googleapis.com/css2?family=Neucha&display=swap"  );

	//	wp_register_script( 'glightbox', THEME_URI . '/js/vendor/glightbox.min.js', [], '3.1.0', true );
	// wp_enqueue_script( 'tiny-slider', THEME_URI . '/js/vendor/tiny-slider.js', [], '2.9.4', true );
    // wp_enqueue_script( 'gsap', THEME_URI . '/js/vendor/gsap.min.js', [], true );
	
    wp_enqueue_script( 'script', THEME_URI . '/js/script.js', [], filemtime( THEME_PATH . '/js/script.js' ), true );
	// wp_localize_script( 'script', 'ajax', [ 'url' => admin_url( 'admin-ajax.php' ) ] );
} );

add_action( 'admin_menu', function () {
	remove_menu_page( 'edit.php' );
} );

function svg( string $filename, string $class = '' ) {
	$svg = file_get_contents( get_template_directory() . '/images/' . str_replace( '.svg', '', $filename ) . '.svg' );

	if ( $class ) {
		$svg = str_replace( '<svg', '<svg class="' . $class . '"', $svg );
	}

	return $svg;
}

// Remove hardcoded width and height from post thumbnails
add_filter( 'post_thumbnail_html', function ( $html ) {
	$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
	return $html;
} );

function get_thumbnail_or_fallback( $size = 'full', $class = null, $post = null ) {
    $post = get_post( $post );
    $image_id = get_post_thumbnail_id( $post ) ?: get_field( 'fallback_image', 'option' );
    return wp_get_attachment_image( $image_id, $size, false, $class ? [ 'class' => $class ] : '' );
}

// Save custom excerpt on save_post

add_action( 'save_post', function ( $post_id, $post ) {
	if ( has_blocks( $post ) ) {
	   $parsed_blocks = parse_blocks( $post->post_content );
 
	   $rendered_blocks = array_reduce( $parsed_blocks, function ( $prev_blocks, $current_block ) {
		  if ( strpos( $current_block['blockName'], 'acf/' ) !== false ) { // ACF blocks
			 return $prev_blocks . acf_rendered_block( $current_block['attrs'] );
		  } elseif ( strpos( $current_block['blockName'], 'core/' ) !== false ) { // Core blocks
			 return $prev_blocks . render_block( $current_block );
		  } else { // Other block types are not supported
			 return $prev_blocks . '';
		  }
	   } );
 
	   $dom = new DOMDocument();
	   @$dom->loadHTML( '<?xml encoding="utf-8" ?>' . $rendered_blocks );
 
	   $p_tags = $dom->getElementsByTagName( 'p' );
	   if ( $p_tags ) {
		  $text = '';
		  foreach ( $p_tags as $p_tag ) {
			 $text .= ' ' . $p_tag->nodeValue;
		  }
 
		  update_post_meta( $post->ID, 'growskills_blocks_excerpt', $text );
	   }
	}
 }, 10, 2 );
 
 
 // Filter excerpt to add custom blocks
 
 add_filter( 'get_the_excerpt', function ( $excerpt, $post ) {
	if ( $excerpt ) {
	   return $excerpt;
	}
 
	if ( $growskills_blocks_excerpt = get_post_meta( $post->ID, 'growskills_blocks_excerpt', true ) ) {
	   $length = apply_filters( 'growskills_blocks_excerpt_length', apply_filters( 'excerpt_length', 55 ), $post );
	   $more   = apply_filters( 'growskills_blocks_excerpt_more', apply_filters( 'excerpt_more', '...' ), $post );
 
	   return wp_trim_words( $growskills_blocks_excerpt, $length, $more );
	}
 
	return '';
 }, 20, 2 );

 function render_pagination($query, $posts_per_page, $paged){
    if (isset($query) && $query->found_posts > $posts_per_page):
        $prev_text = '<i class="fas fa-arrow-left"></i><span>Vorige pagina</span>';
        $next_text = '<span>Volgende pagina</span><i class="fas fa-arrow-right"></i>';
        ?>
        <div class="pagination">
            <div class="wrapper">
                <?php if ($paged > 1): ?>
                    <a href="<?= get_pagenum_link($paged - 1) ?>" class="pagination-link prev"><?= $prev_text ?></a>
                <?php else: ?>
                    <span class="pagination-link prev disabled"><?= $prev_text ?></span>
                <?php endif ?>

                <?php if ($paged < $query->max_num_pages): ?>
                    <a href="<?= get_pagenum_link($paged + 1) ?>" class="pagination-link next"><?= $next_text ?></a>
                <?php else: ?>
                    <span class="pagination-link next disabled"><?= $next_text ?></span>
                <?php endif ?>
            </div>
        </div>
    <?php else: ?>
        <div class="pagination no-pagnation"><h3>Geen paginas</h3></div>
    <?php endif;
}

//add blocks automatically
add_action('init', 'register_acf_blocks', 5);
function register_acf_blocks(){
    $blocks_directory = __DIR__ . '/blocks/';
    $single_blocks_directory = glob($blocks_directory . '*/', GLOB_ONLYDIR);
    foreach ($single_blocks_directory as $blocks_directories) {
        $block = $blocks_directories . 'block.json';
        if ($block) {
            register_block_type($block, array('render_callback' => 'my_acf_block_render_callback'));
        }
    }
}

// Set allowed block types
add_filter( 'allowed_block_types_all', 'growskills_allowed_block_types', 25, 2 );

function growskills_allowed_block_types($allowed_blocks, $editor_context) {
    $blocks_directory = __DIR__ . '/blocks/';
    $single_blocks_directory = glob($blocks_directory . '*/', GLOB_ONLYDIR);

    $allowed_block_list = array(
        'core/block', 
    );

    foreach ($single_blocks_directory as $directory) {
        $allowed_block = 'acf/' . basename($directory);
        $allowed_block_list[] = $allowed_block;
    }

    return $allowed_block_list;
}

function my_acf_block_render_callback($block_attributes, $content = '', $is_preview = false, $post_id = 0){
    if($is_preview === true) : ?>
        <div class="growskills-block">
            <span class="growskills-block-icon dashicons dashicons-<?= $block_attributes['icon'] ?>"></span>
            <span class="growskills-block-title"><?= $block_attributes['title'] ?></span>
            <span class="growskills-block-edit dashicons dashicons-edit"></span>
        </div>
    <?php else :
        $block_index = $block_index ?? 0;
        $block_path  = $block_attributes['path'] . '/' . $block_attributes['render_template'];
        if ( $anchor = $block_attributes['anchor'] ?? false ) {
            ob_start();
            require $block_path;
            $block_html = ob_get_clean();
            echo preg_replace( '/(<[a-z0-9]*)/', '$1 id="' . $anchor . '"', $block_html, 1 );
        } else {
            require $block_path;
        }

        $block_index ++;
    endif;
}

add_action( 'enqueue_block_editor_assets', function () {
	$src     = get_template_directory_uri() . '/includes/blocks.css';
	$version = '1.0';
    wp_enqueue_style( 'growskills-core-editor-style', $src, [], $version );
} );

// Allow editors to purge SG Optimizer cache
// https://wordpress.org/plugins/sg-cachepress/
add_filter( 'sgo_purge_button_capabilities', function ( $default_capabilities ) {
	$default_capabilities[] = 'edit_posts';

	return $default_capabilities;
} );


// Exclude microanalytics.io from being combined by SG Optimizer
add_filter( 'sgo_javascript_combine_excluded_external_paths', function ( $exclude_list ) {
    $exclude_list[] = 'microanalytics.io';

    return $exclude_list;
} );


// Move Yoast to bottom of edit screen
// https://www.wpcover.com/move-yoast-seo-metabox-bottom-post-edit-screen-wordpress
add_filter( 'wpseo_metabox_prio', function () {
	return 'low';
} );