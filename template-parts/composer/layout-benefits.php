<h4 class="section-title--mobile">
    <?php the_sub_field( 'heading' ); ?>
</h4>
<section class="benefits">
    <div class="container">
        <h3 class="main-heading hidden-mobile">
            <?php the_sub_field( 'heading' ); ?>
        </h3>
        <div class="benefits__row">
            <div class="left-col">
                <?php for($i = 1; $i <= 2; $i++) : ?>
                <?php if ( get_sub_field( "content_{$i}_generic" ) || get_sub_field( "content_{$i}_figures" ) ) : ?>
                <div class="col">
                    <?php
                        if ( get_sub_field( "type_{$i}" ) == 'generic' ):
                            the_sub_field( "content_{$i}_generic" );
                        else :
                            while ( have_rows( "content_{$i}_figures" ) ) {
                                the_row();

                                cp_the_field( 'figure', '<span class="orange">', '</span>', true );
                                cp_the_field( 'label', '<span class="black">', '</span>', true );
                            }
                        endif;
                    ?>
                </div>
                <?php endif; ?>
                <?php endfor; ?>
            </div>
            <div class="right-col">
            <?php for($i = 3; $i <= 3; $i++) : ?>
                <?php if ( get_sub_field( "content_{$i}_generic" ) || get_sub_field( "content_{$i}_figures" ) ) : ?>
                <div class="col">
                    <?php
                        if ( get_sub_field( "type_{$i}" ) == 'generic' ):
                            the_sub_field( "content_{$i}_generic" );
                        else :
                            while ( have_rows( "content_{$i}_figures" ) ) {
                                the_row();

                                cp_the_field( 'figure', '<span class="orange">', '</span>', true );
                                cp_the_field( 'label', '<span class="black">', '</span>', true );
                            }
                        endif;
                    ?>
                </div>
                <?php endif; ?>
                <?php endfor; ?>
            </div>
        </div>
    </div>
</section>