<?php
$choose = get_field('choose_overview');
$posts_per_page = 9;

if ($choose) :
    $args = array(
        'post_type' => $choose,
        'posts_per_page' => $posts_per_page
    );

    $query = new WP_Query($args);
    $items = $query->posts;

    if ($items) : ?>
        <section class="overview with-margin">
            <div class="wrapper ajax-container">
                <?php foreach ($items as $item) : ?>
                    <?php get_template_part('includes/overview-item', $choose, ['item' => $item]) ?>
                <?php endforeach; ?>
            </div>
        </section>

        <?php get_template_part('includes/overview-more', null, [
            'query' => $query,
            'post_type' => $choose,
            'posts_per_page' => $posts_per_page
        ]) ?>
    <?php endif;
endif;