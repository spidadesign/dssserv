<?php
/*
Template Name: Home
*/
get_header();
?>
<div class="top-home">

	<ul class="top-slider">
		<li><img src="<?php bloginfo('template_directory'); ?>/assets/images/slider/harlem.jpg" title="
			<div class='container caption'>
				<span class='type'>Apartments</span>
				<span class='place'>in
					<span class='last'>Harlem</span>
				</span>
			</div>
			"></li>
		<li><img src="<?php bloginfo('template_directory'); ?>/assets/images/slider/harlem.jpg" title="<span class='type'>Apartments</span>  <span class='place'>in <span class='last'>Harlem</span></span>"></li>
	</ul>
	<div class="top-overlay">&nbsp;</div>
</div>
<div class="pref"></div>
<div class="middle-home">
	<div class="container">
		<div class="col-md-5 col-md-offset-1">
			<div class="col-md-8 col-md-offset-2">
				<div class="line"></div>
			</div>

			<h3 class="title">
				Check out our Exclusive Properties you won't find elsewhere!
			</h3>


			<ul class="mid-page">
				<?php $args = array('post_type' => 'exclusive');
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<li>
					<div class="exc-img">
						<?php the_post_thumbnail('large'); ?>
					<div class="pan_frame">&nbsp;</div>
						<div class="exc-title">
							<?php the_title(); ?>
						</div>
					</div>
				</li>
				<?php endwhile;	?>
			</ul>
		</div>
		<div class="col-md-5">
			<div class="col-md-8 col-md-offset-2">
				<div class="line"></div>
			</div>
			<h3 class="title">
				Check out our Available Apartments
			</h3>
		</div>
	</div>
</div>
<div class="bottom-home">
<div class="pref"></div>
	<div class="container">
		<div class="col-md-12">
			<div class="content">
				<?php echo apply_filters('the_content', get_post()->post_content); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>