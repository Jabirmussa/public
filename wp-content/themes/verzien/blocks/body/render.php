<?php
$show_title = get_field('show_title');
$body = get_field('body');
$button = get_field('button');

if($show_title || !empty($body)) : ?>
    <section class="body">
        <div class="wrapper grid">
            <div class="body-text">
                <?= $body; ?>
                <?= ($button ? '<a class="btn" href="'. $button['url'] .'">'. $button['title'] .'</a>' : null); ?>
                <div class="text-container">
                    <?= ($show_title ? '<h1>' . get_the_title() . '</h1>' : null); ?>
                    
                </div>
            </div>
        </div>
    </section>
<?php endif;