<!DOCTYPE html>
<html <?php language_attributes() ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ) ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">    
    <title><?= get_bloginfo('name'); ?> | <?php the_title(); ?></title>
    <?php wp_head(); ?>
</head>

<body <?= body_class(); ?>>

<?php wp_body_open(); ?>

<div id="site-container"><?php // Style Gravity Forms more easy ?> 

<header class="fixed headeractive">
    <div class="wrapper">
        
    
        <button class="header-burger">
                <?= svg('menu-open', 'header-burger-open') ?>
                <?= svg('menu-close', 'header-burger-close') ?>
            </button>

        <?php wp_nav_menu([
            'theme_location' => 'headermenu',
            'container' => '',
            'container_class' => '',
            'menu_class' => 'header-menu-large',
            'depth' => 2
        ]); ?>
    </div>
</header>

<div class="header-menu-small">
    <div class="wrapper">
        <?php wp_nav_menu([
            'theme_location' => 'headermenu',
            'container' => '',
            'container_class' => '',
            'depth' => 2
        ]); ?>
    </div>
</div>

<div id="content-container">