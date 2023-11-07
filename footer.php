</div>
<footer>
    <?php
    wp_nav_menu([
        'theme_location' => 'footer',
        'container' => false,
        'menu_class' => 'navbar-nav mr-auto',
    ]);
    the_widget(YoutubeWidget::class, ['youtube' => 'CLeZyIID9Bo'], ['after_widget' => '', 'before_widget' => '']);
    ?>
</footer>
<div>
    <?= esc_html(get_option('agence_horaire')) ?>
</div>
<?php wp_footer() ?>
</body>

</html>