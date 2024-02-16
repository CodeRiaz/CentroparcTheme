<?php
global $post;
add_shortcode('page-blocks','page_blocks');
function page_blocks($atts, $content = null)
{
	$return = '';
	$atts = shortcode_atts( array(
	   'title'    => '',
	   'icon_class'  => '',
	   'link'     => '',
	   'description'  => '',
	), $atts );

	$title = $atts['title'];
	$icon_class = $atts['icon_class'];
	$link = $atts['link'];
	$description = $atts['description'];

	$return  =  '<div class="col-sm-4">
				<div class="media service-box wow fadeInRight text-center animated" style="visibility: visible; animation-name: fadeInRight;">
				<i class="fa '.$icon_class.'"></i>
				<br>
				<div class="media-body">
				<h4 class="media-heading">'.$title.'</h4>
				<div><a href="'.$link.'"><p> '.$description.' </p></a></div>
				</div>
				</div>
				</div>';
	return $return;
}
add_shortcode('testimonial-blocks','testimonial_blocks');
function testimonial_blocks($atts, $content = null)
{
	$return = '';
	$atts = shortcode_atts( array(
	   'title'    => '',
	   'image'  => '',
	   'description'  => '',
	   'logo'  => '',
	), $atts );

	$title = $atts['title'];
	$image = $atts['image'];
	$description = $atts['description'];
	$logo = $atts['logo'];

	$return  =  '<section class="clientquote '.$title.'">
				<div class="container">
				<div class="row">
				<div class="col-md-12">
				<div class="client-quote">
				<img src="https://prescouter.com/wp-content/themes/prescouter2018/assets/images/quote.png" alt="quote" class="qt">
				<strong>'.$description.'</strong>

				<div class="client-quote-meta">
					<div class="cq-meta-photo">
						<img src="'.$image.'" class="clientimg ">
					</div>

					<div class="cq-meta-info">
						<small class="text-muted">'.$title.'</small>
						<img src="'.$logo.'" class="clientlogo clientlogo2">
					</div>
				</div>
				</div>
				</div>
				</div>
				</div>
				</section>';
	return $return;
}
add_shortcode('work-blocks','work_blocks');
function work_blocks($atts, $content = null)
{
	$return = '';
	$atts = shortcode_atts( array(
	   'title'    => '',
	   'image'  => '',
	   'description'  => '',
	), $atts );

	$title = $atts['title'];
	$image = $atts['image'];
	$description = $atts['description'];

	$return  =  '<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="how-it-box">
				<div class="wow fadeInUp animated" data-wow-duration="400ms" data-wow-delay="0ms" style="visibility: visible; animation-duration: 400ms; animation-delay: 0ms; animation-name: fadeInUp;">
				<div class="w100p text-center">
				<img class="img-responsive" src="'.$image.'" alt="how ot works">
				</div>
				<h6 class="text-uppercase">'.$title.'</h6>
				<p class="font18 ">'.$description.'</p>
				</div>
				</div>
				</div>';
	return $return;
}
add_shortcode('blog-blocks','blog_blocks');
function blog_blocks($atts, $content = null)
{
	$return = '';
	$post_type = 'post';
	$sticky = get_option( 'sticky_posts' );
	$postargs = array(
		'post_type' => $post_type,
		'posts_per_page' => 3,
		'post__in'  => $sticky,
		'ignore_sticky_posts' => 1
	);
	query_posts($postargs);

	if ( have_posts() ):
		while ( have_posts() ):
			the_post();
			$cont = get_the_content();
			$trimmed_content = wp_trim_words( $cont, 12);
			$date = get_the_date('d M Y');
			$author = get_the_author();
			$author_img = get_avatar( get_the_author_meta( 'ID' ), 50 );
			$return .='<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="lblogpost pull-left">
				<div class="lblogpost-date text-center"><i class="fa fa-clock-o"></i><br>'.$date.'<span class="post-format post-format-video"><i class="fa fa-file-text"></i></span></div>
				<div class="lblogpost-img pull-left">';
				if (has_post_thumbnail(get_the_ID()) ):
				$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail' );
				$thumbnailSrc = $image[0];
				if(!empty($thumbnailSrc)):
				$return .='<img class="img-responsive" src="'.$thumbnailSrc.'">';
				endif;
				endif;
				$return .='</div><div class="lblogpost-txt pull-left"><div class="lblogpost-author pull-left">'.$author_img.'</br> '.$author.'</div>
				<h2 class="entry-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>
				<div class="entry-content"><p>'.$trimmed_content.'</p>
				<a href="'.get_the_permalink().'" class="btn btn-primary">Read More</a>
				</div></div></div></div>';
		endwhile;
		wp_reset_query();
	endif;
	return $return;
}


add_shortcode('animated-number','animated_number');
function animated_number($atts, $content = null)
{
	$return = '';
	$atts = shortcode_atts( array(
	   'title'    => '',
	   'number'  => '',
	), $atts );

	$title = $atts['title'];
	$number = $atts['number'];
	$return  =  '
	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12"><div class="wow fadeInUp animated animated" data-wow-duration="400ms" data-wow-delay="100ms"><strong>'.$title.'</strong><div class="animated-number" data-digit="'.$number.'" data-duration="1000">'.$number.'</div></div></div>';
	return $return;
}


add_shortcode('newsletter-form','newsletter_form');
function newsletter_form($atts, $content = null)
{
	$return = '';
	$atts = shortcode_atts( array(
		'content'    => '',
		'title'    => '',
		'button_content' => '',
	    'button_text' => '',
		'button_link' => '',
	), $atts );

	$newsletter_form = of_get_option('newsletter_form');

	$content = $atts['content'];
	$title = $atts['title'];
	$button_content = $atts['button_content'];
	$button_text = $atts['button_text'];
	$button_link = $atts['button_link'];
	$return  =  '
	<section id="contact">
	<div class="foot-emailcon">
	<div class="container">
	<div class="row">
	<div class="form-subscribe">
	<div class="col-md-6">
	<strong class="text-center signtext text-uppercase">'.$content.'</strong><br><strong class="text-center text-uppercase">'.$title.'</strong><br>'.$newsletter_form.'</div>
	<div class="post-proj">
	<div class="col-md-6 text-center">
	<strong class="text-center text-uppercase signtext" style="margin-top:40px;">'.$button_content.'</strong><br> <a href="'.$button_link.'" target="_blank" class="btn btn-primary">'.$button_text.'</a>
	</div>
	</div>
	</div>
	</div>
	</div>
	</div>
	</section>';
	return $return;
}



add_shortcode('testimonial-slider','testimonial_slider');
function testimonial_slider($atts, $content = null)
{
	global $post;

	$return = '';

	$post_type = 'testimonial';
	$postargs = array(
		'post_type' => $post_type,
	);
	query_posts($postargs);
	$return  .=   '<section id="testimonial" class="testimonial01">
				<div class="container">
				<div class="row">
				<div class="col-sm-8 col-sm-offset-2">
				<div data-ride="carousel" class="carousel slide text-center" id="carousel-testimonial">
				<div role="listbox" class="carousel-inner">';
				if ( have_posts() ):
					while ( have_posts() ):
						the_post();
						$profession = get_post_meta($post->ID,'profession', true);
						$return  .=   '<div class="item"><p>';
						if (has_post_thumbnail(get_the_ID()) ):
						$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail' );
						$thumbnailSrc = $image[0];
						if(!empty($thumbnailSrc)):
						$return  .=   '<img src="'.$thumbnailSrc.'" class="img-circle img-thumbnail">';
						endif;
						endif;
						$return  .=    '</p><h4>'.get_the_title().'</h4>';
						$return  .=    '<small>'.$profession.'</small>';
						$return  .=    '<p>'.get_the_content().'</p></div>';
					endwhile;
					wp_reset_query();
				endif;
	$return  .= '</div></div></div></div></div></section>';

	return $return;

}





add_shortcode('clients-filter','client_filter');
function client_filter($atts, $content = null)
{
	global $post;
	$return = '';

	$client_terms = get_terms('client-category');

	$post_type = 'client';
	$postargs = array(
		'post_type' => $post_type,
		'posts_per_page' => -1
	);
	query_posts($postargs);
	$return  .='<div class="text-center"><ul class="portfolio-filter">';
	if($client_terms)
	{
		foreach($client_terms as $client_term)
		{
			$return  .='<li><a href="#" data-filter=".'.$client_term->slug.'">'.$client_term->name.'</a></li>';
		}
	}
	$return  .='</ul></div>';
		if ( have_posts() ):
			$return  .= '<div class="portfolio-items">';
			while ( have_posts() ):
				the_post();
				$client_posts_terms = get_the_terms(  get_the_ID(), 'client-category' );
				$return  .= '<div class="portfolio-item';
				if($client_posts_terms)
				{
					foreach ($client_posts_terms as $client_posts_term){ $return  .= ' '.strtolower(preg_replace('/\s+/', '-', $client_posts_term->slug)). ' '; }
				}
				$return  .= '">';
				$return  .= '<ul class="benif-client-logos pull-left"><li>';
				if (has_post_thumbnail(get_the_ID()) ):
				$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail' );
				$thumbnailSrc = $image[0];
				if(!empty($thumbnailSrc)):
				$return  .='<img class="img-responsive" alt="client" src="'.$thumbnailSrc.'">';
				endif;
				endif;
				$return  .='</li></ul></div>';
			endwhile;
			$return  .= '</div>';
			wp_reset_query();
		endif;
	$return  .= '</div>';
	return $return;
}


add_shortcode('team-left-blocks','team_left_blocks');
function team_left_blocks($atts, $content = null)
{
	$return = '';
	$atts = shortcode_atts( array(
	   'title'    => '',
	   'profession'    => '',
	   'image'  => '',
	   'description'  => '',
	   'linkedin_link'  => '',
	), $atts );

	$title = $atts['title'];
	$profession = $atts['profession'];
	$image = $atts['image'];
	$description = $atts['description'];
	$linkedin_link = $atts['linkedin_link'];

	$return  =  '<li class="pull-left">
				<div class="row">
					<div class="col-sm-3">
						<img class="img-responsive" src="'.$image.'" alt="team">
					</div>
					<div class="col-sm-9">
						<strong>'.$title.'</strong><br>
					    <em>'.$profession.'</em><br>
					   <a target="_blank" href="'.$linkedin_link.'" class="btn btn-sm btn-primary text-uppercase"><i class="fa fa-linkedin-square"></i> Linked In</a><br>
					   <p>'.$description.'</p>
					</div>
				</div>
			</li>';
	return $return;
}
add_shortcode('team-right-blocks','team_right_blocks');
function team_right_blocks($atts, $content = null)
{
	$return = '';
	$atts = shortcode_atts( array(
	   'title'    => '',
	   'profession'    => '',
	   'image'  => '',
	   'description'  => '',
	   'linkedin_link'  => '',
	   'email_id'  => '',
	), $atts );

	$title = $atts['title'];
	$profession = $atts['profession'];
	$image = $atts['image'];
	$description = $atts['description'];
	$linkedin_link = $atts['linkedin_link'];
	$email_id = $atts['email_id'];

	$return  =  '
			<li class="pull-left">
				<div class="row">
					<div class="col-sm-3 pull-right">
						<img class="img-responsive" src="'.$image.'" alt="team">
					</div>
					<div class="col-sm-9 text-right pull-left">
						<strong>'.$title.'</strong><br>
						<em>'.$profession.'</em><br>';
						if($linkedin_link){
							$return  .='<a target="_blank" href="'.$linkedin_link.'" class="btn btn-sm btn-primary text-uppercase"><i class="fa fa-linkedin-square"></i> Linked In</a>&nbsp;';
						}
						if($email_id){
							$return  .='<a target="_blank" href="mailto:'.$email_id.'" class="btn btn-sm btn-success text-uppercase"><i class="fa fa-envelope-o"></i> Email</a>';
						}
						'<br><p>'.$description.'</p>
					</div>
				</div>
			 </li>';
	return $return;
}



add_shortcode('left-blocks','all_left_blocks');
function all_left_blocks($atts, $content = null)
{
	$return = '';
	$atts = shortcode_atts( array(
	   'title'    => '',
	   'image'  => '',
	   'description'  => '',
	   'left_col' => '',
	   'right_col' => ''
	), $atts );

	$title = $atts['title'];
	$image = $atts['image'];
	$description = $atts['description'];
	$left_col = $atts['left_col'];
	$right_col = $atts['right_col'];

	$image_id = prescouter_get_image_id($image);
	$image_thumb = wp_get_attachment_image_src($image_id, 'thumbnail');
	$thumb_img = get_post($image_id);

	$return  =  '<div class="col-md-12 col-sm-12 wow fadeInUp animated">
					<div class="servicebox row">
						<div class="col-sm-'.$left_col.'">
							<div class="servicebox-right">
								<img class="img-responsive" src="'.$image.'" alt="">
								<i class="suffering-part">'.$thumb_img->post_excerpt.'</i>
							</div>
						</div>
						<div class="col-sm-'.$right_col.'">
							<div class="servicebox-left">
								<div>
								<strong>'.$title.'</strong>
								<p>'.$description.'</p>
								</div>
							</div>
						</div>
					</div>
				</div>';
	return $return;
}


add_shortcode('right-blocks','all_right_blocks');
function all_right_blocks($atts, $content = null)
{
	$return = '';
	$atts = shortcode_atts( array(
	   'title'    => '',
	   'image'  => '',
	   'description'  => '',
	   'left_col' => '',
	   'right_col' => ''
	), $atts );


	$title = $atts['title'];
	$image = $atts['image'];
	$description = $atts['description'];
	$left_col = $atts['left_col'];
	$right_col = $atts['right_col'];

	$image_id = prescouter_get_image_id($image);
	$image_thumb = wp_get_attachment_image_src($image_id, 'thumbnail');
	$thumb_img = get_post($image_id);

	$return  =  '<div class="col-md-12 col-sm-12 wow fadeInUp animated">
					<div class="servicebox row">
						<div class="col-sm-'.$left_col.' text-center pull-right">
							<div class="servicebox-right">
								<img class="img-responsive" src="'.$image.'" alt="">
								<i class="suffering-part">'.$thumb_img->post_excerpt.'</i>
							</div>
						</div>
						<div class="col-sm-'.$right_col.' pull-left">
							<div class="servicebox-left">
								<div>
								<strong>'.$title.'</strong>
								<p>'.$description.'</p>
								</div>
							</div>
						</div>
					</div>
				</div>';
	return $return;
}

add_shortcode('category-blog-blocks','category_blog_blocks');
function category_blog_blocks($atts, $content = null)
{
	$return = '';

	$atts = shortcode_atts( array(
	   'category'    => '',
	), $atts );

	$category = $atts['category'];


	$post_type = 'post';
	//$sticky = get_option( 'sticky_posts' );
	$postargs = array(
		'post_type' => $post_type,
		'posts_per_page' => 3,
		//'post__in'  => $sticky,
		//'ignore_sticky_posts' => 1,
		'cat' => $category
	);
	query_posts($postargs);

	if ( have_posts() ):
		while ( have_posts() ):
			the_post();
			$cont = get_the_content();
			$trimmed_content = wp_trim_words( $cont, 15);
			$date = get_the_date('d M Y');
			$author = get_the_author();
			$author_img = get_avatar( get_the_author_meta( 'ID' ), 50 );
			$return .='<div class="category_blog col-lg-4 col-md-4 col-sm-4 col-xs-12">
				<div class="lblogpost pull-left">
				<div class="lblogpost-date text-center"><i class="fa fa-clock-o"></i><br>'.$date.'<span class="post-format post-format-video"><i class="fa fa-file-text"></i></span></div>
				<div class="lblogpost-img pull-left">';
				if (has_post_thumbnail(get_the_ID()) ):
				$image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'single-post-thumbnail' );
				$thumbnailSrc = $image[0];
				if(!empty($thumbnailSrc)):
				$return .='<img class="img-responsive" src="'.$thumbnailSrc.'">';
				endif;
				endif;
				$return .='</div><div class="lblogpost-txt pull-left"><div class="lblogpost-author pull-left">'.$author_img.'</br> '.$author.'</div>
				<h2 class="entry-title"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h2>
				<div class="entry-content"><p>'.$trimmed_content.'</p>
				<a href="'.get_the_permalink().'" class="btn btn-primary">Read More</a>
				</div></div></div></div>';
		endwhile;
		wp_reset_query();
	endif;
	return $return;
}