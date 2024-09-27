<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
    <script type="text/javascript">
        document.addEventListener("DOMContentLoaded", function() {
            const hamburger = document.querySelector('.hamburger-menu');
            const nav = document.querySelector('.ict-main-navigation');

            hamburger.addEventListener('click', function() {
                nav.classList.toggle('active');
            });
        });

    </script>
</head>
<body <?php body_class(); ?>>
<header>
    <div class="ict-top-header">
        <div class="ict-site-logo">
            <?php if (function_exists('the_custom_logo')) {
                the_custom_logo();
            } ?>
            <h1><a href="<?php echo site_url();?>"><?php bloginfo('name'); ?></a></h1>
            <p><?php bloginfo('description'); ?></p>
        </div>
        <div class="ict-site-contact">
            <a href="#">Contact</a>
        </div>
    </div>
    <nav class="ict-main-navigation">
        <?php
            wp_nav_menu(array(
                'theme_location' => 'primary_menu', 
                'menu_class'     => 'menu',
                'container'      => false,
                'depth'          => 3,
                'fallback_cb'    => false,
                'walker'         => new Custom_Walker_Nav_Menu(),
            ));
        ?>
    </nav>

</header>
