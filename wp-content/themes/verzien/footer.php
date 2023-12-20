    <footer>
        <div class="wrapper">
            <div>
                <a class="header-logo" href="/"><?= svg('logo'); ?></a>
            </div>
            <div>
                <?php
                    $adress = get_field('adress', 'option');
                    if($adress) : ?>
                    <div class="text-container">
                        <?= $adress; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </footer>

    </div><?php // #content-container ?>
    </div><?php // #site-container ?>
    <?php wp_footer(); ?>
</body>
</html>