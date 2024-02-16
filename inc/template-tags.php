<?php

/**
 * Custom template tags and layout/styling helpers
 *
 * @since 1.0
 */

/**
 * Get logo URL
 *
 * @param string $location Location of the logo
 * @return mixed
 */
function cp_get_logo($location = 'header', $echo = false)
{

    $logo = get_field('logo_' . $location, 'option');

    if (!$logo) {
        $logo = get_template_directory_uri() . '/assets/images/logo-' . $location . '.png';
    }

    if (!$echo) {
        return $logo;
    }

    $title = get_bloginfo('name');
    echo "<img class=\"logo\" src=\"{$logo}\" alt=\"{$title}\" title=\"{$title}\">";
}

/**
 * Get and prepare copyright message
 *
 * @return mixed Copyright message
 */
function cp_get_copyright($echo = false)
{

    $copyright = get_field('copyright_message', 'option', false, false);

    if (empty($copyright)) {
        return false;
    }

    $copyright = str_replace(array('{{year}}'), date('Y'), $copyright);

    if (!$echo) {
        return $copyright;
    }

    echo $copyright;
}

/**
 * Renders ACF Flexible Content
 *
 * @param  string $template The ACF Flexible template
 */
function cp_render_flexible_rows($template = 'composer', $id = 0)
{

    if (!$id) {
        $id = get_the_ID();
    }

    if (have_rows($template, $id)) {

        $layout_count = 1;

        while (have_rows($template, $id)) {
            the_row();

            set_query_var( 'layout_count', absint( $layout_count ) );

            $layout = str_replace('_', '-', get_row_layout());
            get_template_part('template-parts/' . $template . '/layout', $layout);

            $layout_count++;
        }
    }
}

function cp_the_field($name = false, $before = '', $after = '', $sub_field = false, $option = false)
{

    if (!$name) {
        return;
    }

    $output = '';

    if (!$option) {
        if (!$sub_field && get_field($name)) {
            $output = get_field($name);
        } else if ($sub_field && get_sub_field($name)) {
            $output = get_sub_field($name);
        }
    } else {
        if (!$sub_field && get_field($name, 'option')) {
            $output = get_field($name, 'option');
        }
    }

    if (!empty($output)) {
        echo $before . $output . $after;
    }

}

/**
 * Return or echo attachment
 *
 * @param  integer $attchment_id Attachment ID
 * @param  string  $size         Thumbnail size
 * @param  boolean $echo         Whether to print the image or return URL, default = false
 * @return Mixed                 Print <img> if $echo = true or return URL
 */
function cp_get_attachment($attachment_id = 0, $size = 'thumbnail', $echo = false)
{

    if (!$attachment_id) {
        return false;
    }

    if (!$echo) {
        return wp_get_attachment_image_url($attachment_id, $size);
    }

    echo wp_get_attachment_image($attachment_id, $size);
}

/**
 * Returns archive friendly post type title
 *
 * @param  string $post_type Slug of the post type
 * @return string 			 Title of the post type
 */
function cp_get_post_type_singular($post_type)
{
    $singular_name = get_post_type_object($post_type)->labels->singular_name;
    if ($singular_name == 'Post') {
        $singular_name = 'Article';
    }

    return $singular_name;
}

/**
 * Excerpt with custom length
 */
function cp_get_excerpt($limit = 25, $read_more = '...', $post = false)
{
    if (!$post) {
        $post = get_the_ID();
    }

    return wp_trim_words(get_the_excerpt($post), $limit, $read_more);
}

/**
 * Change WPP's 'Sorry. No data so far.' message
 */
function cp_wpp_custom_no_posts_found($no_data_html)
{
    return '';
}
add_filter('wpp_no_data', 'cp_wpp_custom_no_posts_found', 10, 1);

/**
 * Numeric pagination
 */
function cp_numeric_pagination()
{

    if (is_singular())
        return;

    global $wp_query;

    /** Stop execution if there's only 1 page */
    if ($wp_query->max_num_pages <= 1)
        return;

    $paged = get_query_var('paged') ? absint(get_query_var('paged')) : 1;
    $max = intval($wp_query->max_num_pages);

    /** Add current page to the array */
    if ($paged >= 1)
        $links[] = $paged;

    /** Add the pages around the current page to the array */
    if ($paged >= 3) {
        $links[] = $paged - 1;
        $links[] = $paged - 2;
    }

    if (($paged + 2) <= $max) {
        $links[] = $paged + 2;
        $links[] = $paged + 1;
    }

    /** Previous Post Link */
    $prev_link = '';
    if (get_previous_posts_link()) {
        $prev_link .= '<li><a href="' . get_pagenum_link(get_query_var('paged', 1) - 1) . '" class="mck-arrow-left-icon"></a></li>';
    }

    /** Next Post Link */
    $next_link = '';
    if (get_next_posts_link()) {
        $next_link = '<li><a href="' . get_pagenum_link(get_query_var('paged') + 1) . '" class="mck-arrow-right-icon"></a></li>';
    }

    echo '<span class="current-page">Page <?php echo $page; ?></span>';

    echo '<ul class="pagination">';
    echo $prev_link;

    /** Link to first page, plus ellipses if necessary */
    if (!in_array(1, $links)) {
        $class = 1 == $paged ? ' class="active"' : '';

        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link(1)), '1');

        if (!in_array(2, $links))
            echo '<li>…</li>';
    }

    /** Link to current page, plus 2 pages in either direction if necessary */
    sort($links);
    foreach ((array)$links as $link) {
        $class = $paged == $link ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($link)), $link);
    }

    /** Link to last page, plus ellipses if necessary */
    if (!in_array($max, $links)) {
        if (!in_array($max - 1, $links))
            echo '<li>…</li>' . "\n";

        $class = $paged == $max ? ' class="active"' : '';
        printf('<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url(get_pagenum_link($max)), $max);
    }

    echo $next_link;
    echo '</ul>';
}

function cp_the_link($link = array(), $before = '', $after = '', $classes = '', $target = '')
{

    if (!is_array($link) || !count($link)) {
        return;
    }

    $output = '';

    if (!empty($target)) {
        $link['target'] = $target;
    }

    $output .= '<a href="' . $link['url'] . '" class="' . $classes . '" target="' . $link['target'] . '">' . $link['title'] . '</a>';

    if (!empty($output)) {
        echo $before . $output . $after;
    }
}

function cp_get_svg($name = '')
{
    if (empty($name)) {
        return;
    }

    get_template_part('template-parts/svg/svg', $name);
}