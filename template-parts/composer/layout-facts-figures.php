<?php
    $layout_id = 'layout-' . get_query_var( 'layout_count' );
?>
<style>
    <?php echo '#' . $layout_id; ?>:after {
        background-image: url(<?php echo wp_get_attachment_url( get_sub_field( 'image' ) ); ?>);
        background-position: <?php echo str_replace('_', ' ', get_sub_field( 'image_position' )); ?>
    }
</style>
<h4 class="section-title--mobile">
    <?php the_sub_field( 'heading' ); ?>
</h4>
<section id="<?php echo $layout_id; ?>" class="numbers">
    <div class="container">
        <div class="numbers__row">
            <div class="numbers__cards">
                <h3 class="title hidden-mobile">
                    <?php the_sub_field( 'heading' ); ?>
                </h3>
                <div class="numbers__row">
                    <?php
                        cp_the_field( 'left_column', '<div class="left-col">', '</div>', true );
                        cp_the_field( 'right_column', '<div class="right-col">', '</div>', true );
                    ?>
                </div>

                <?php cp_the_link( get_sub_field( 'button' ), '', '', 'btn btn--black' ); ?>
            </div>
            <div class="numbers__thumbnail pull-right">
                <?php cp_get_attachment( get_sub_field( 'image' ), 'full', true ); ?>
            </div>
        </div>
    </div>
    <?php /*
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            return;
            window.od = [];
            var elements = document.querySelectorAll('.numbers .numbers__row strong');
            elements.forEach(function (el) {
                var value = el.getAttribute('data-value')
                var format = el.getAttribute('data-format')

                var o = new Odometer({
                    el: el,
                    value: value,

                    // Any option (other than auto and selector) can be passed in here
                    format: format
                });

                od.push(o);
                o.render();

                // console.log(value)
                // od.update(value)
                // el.innerHTML = value
            });
        })
    </script>
    */ ?>
</section>