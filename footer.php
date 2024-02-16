    <footer class="footer">
        <div class="container">

            <?php if ( have_rows( 'footer_columns', 'option' ) ) : ?>
            <?php while ( have_rows( 'footer_columns', 'option' ) ) : the_row(); ?>
            <div class="footer__row">

                <div class="footer__contact">
                    <span class="title">
                        <?php the_sub_field( 'contact_title' ); ?></span>

                    <?php
                        if ( $phone = get_sub_field( 'contact_phone' ) ) {
                            echo "<a href=\"tel:{$phone}\">{$phone}</a>";
                        }

                        if ( $address = get_sub_field( 'contact_address' ) ) {
                            if ( $map_link = get_sub_field( 'contact_map_link' ) ) {
                                echo "<a href=\"{$map_link}\" target=\"_blank\">{$address}</a>";
                            } else {
                                echo $address;
                            }
                        }
                    ?>
                </div>

                <div class="footer__social">
                    <span class="title">
                        <?php the_sub_field( 'social_title' ); ?></span>

                    <?php if ( have_rows( 'social_profiles', 'option' ) ) : ?>
                    <ul>
                        <?php while ( have_rows( 'social_profiles', 'option' ) ) : the_row(); ?>
                        <li>
                            <a href="<?php the_sub_field( 'link' ); ?>" target="_blank">
                                <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/social-<?php the_sub_field( 'network' ); ?>.svg">
                            </a>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>
                </div>

                <div class="footer__partners">
                    <span class="title">
                        <?php the_sub_field( 'partners_title' ); ?></span>

                    <?php if ( have_rows( 'partner_logos', 'option' ) ) : ?>
                    <ul>
                        <?php while ( have_rows( 'partner_logos', 'option' ) ) : the_row(); ?>
                        <li>
                            <?php
                                if ( $link = get_sub_field( 'link' ) ) {
                                    echo "<a href=\"{$link}\" target=\"_blank\"><img src=\"" . wp_get_attachment_url( get_sub_field( 'logo' ) ) . "\"></a>";
                                } else {
                                    echo "<img src=\"" . wp_get_attachment_url( get_sub_field( 'logo' ) ) . "\">";
                                }
                            ?>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                    <?php endif; ?>
                </div>

            </div>
            <?php endwhile; ?>
            <?php endif; ?>

            <div class="copyright">
                <?php
                    cp_the_field( 'copyright_text', '<span>', '</span>', false, true );
                    cp_the_field( 'designer_credits', '<span>', '</span>', false, true );
                ?>
            </div>

        </div>
    </footer>
    </div>

    <a href="#" id="back-to-top" title="Back to top">
        <?php cp_get_svg( 'arrow-up' ); ?>
    </a>

    <?php wp_footer(); ?>
</body>
</html>