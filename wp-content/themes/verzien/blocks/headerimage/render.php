<?php
$image = get_field('header_image');

if($image) : ?>
    <section class="header-image cover-image">
        <?= wp_get_attachment_image($image, 'full'); ?>
    </section>
<?php endif ?>