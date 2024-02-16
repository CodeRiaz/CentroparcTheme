<h4 class="section-title--mobile"><?php the_sub_field( 'heading' ); ?></h4>
<section class="textual-section">
    <div class="container">
        <h4 class="title hidden-mobile"><?php the_sub_field( 'heading' ); ?></h4>
        <?php cp_the_field( 'content', '<p class="copy">', '</p>', true ); ?>
    </div>
</section>