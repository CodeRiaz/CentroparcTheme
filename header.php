<!DOCTYPE html>
<html <?php language_attributes(); ?> xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.png" type="image/x-icon">
    <link rel="icon" href="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/favicon.png" type="image/x-icon">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

    <div class="wrapper">
        <header class="header">
            <div class="container">
                <div class="header__row">
                    <div class="header__logo">
                        <a href="<?php bloginfo( 'url' ); ?>">
                            <?php bloginfo( 'name' ); ?></a>
                    </div>

                    <?php
                        wp_nav_menu(array(
                            'theme_location' => 'header',
                            'container' => 'div',
                            'container_class' => 'header__menu'
                        ));
                    ?>
                    <div id="hamburger">
                        <span></span>
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </div>
            </div>
        </header>