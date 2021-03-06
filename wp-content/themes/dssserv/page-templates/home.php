<?php
/*
Template Name: Home
*/
get_header();
?>
<div class="top-home container">
	<div class="home-slider">
		<div>
			<img src="<?php bloginfo('template_directory'); ?>/assets/images/slider/harlem.jpg">
			<div class="top-overlay">
				<div class='container caption'>
					<img src="<?php bloginfo('template_directory'); ?>/assets/images/logo-white.png" class="logo">
					<span class='type'>Apartments</span>
					<span class='place'>in
						<span class='last'>Harlem</span>
					</span>
					<a class="btn btn-default" href="<?php echo site_url(); ?>/property-search">Search For Apartments</a>
				</div>
			</div>
		</div>
		<div>
			<img src="<?php bloginfo('template_directory'); ?>/assets/images/slider/harlem.jpg">
		</div>
	</div>
	<div class="pref beige"></div>
</div>
<div class="middle-home">
	<div class="container">
		<div class="col-md-6">
			<div class="col-md-6 col-md-offset-3">
				<div class="line"></div>
			</div>

			<h3 class="title">
				Check out our Exclusive Properties you won't find elsewhere!
			</h3>
			<div class="mid-page">
				<?php
					$args = array(
					'post_type' => 'property',
					'posts_per_page' => -1,
					'post_parent' => 0,
					'meta_query' => array(
						array('key' => 'random_8', 'value'=>'Exclusive', 'compare'=>'LIKE')

					)
				);
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post(); ?>
				<div>
					<div class="exc-img">
						<?php the_post_thumbnail('large'); ?>
					<div class="pan_frame">
						<img src="<?php bloginfo('template_directory'); ?>/assets/images/img-overlay.png">
						<a type="button" class="btn btn-default">Search Area</a>
					</div>
					</div>
				</div>
				<?php
					endwhile;
					wp_reset_postdata();
					wp_reset_query();
				?>
			</ul>
		</div>
		</div>
		<div class="col-md-6">
			<div class="col-md-6 col-md-offset-3">
				<div class="line"></div>
			</div>
			<h3 class="title">
				Check out our Available Apartments
			</h3>
			<div class="exc-img map">
				<div class="background"></div>
				<div class="tooltip"></div>
					<img src="<?php bloginfo('template_directory'); ?>/assets/images/map.jpg" usemap="#image-maps-2014-06-06-150317" class="map"/>
					<map name="image-maps-2014-06-06-150317" id="ImageMapsCom-image-maps-2014-06-06-150317">
						<area data-toggle="tooltip" href="#" id="example" data-placement="left" title="Tooltip on left" title="Staten Island" shape="rect" coords="13,213,160,320" style="outline:none;" target="_self">
						<area title="Manhattan" shape="rect" coords="177,40,233,174" style="outline:none;" target="_self">
<area shape="rect" coords="408,318,410,320" alt="Image Map" style="outline:none;" title="Image Map" href="http://www.image-maps.com/index.php?aff=mapped_users_0" />
</map>
				<!--<img src="<?php bloginfo('template_directory'); ?>/assets/images/map.jpg">-->
			</div>
		</div>
	</div>
</div>
<div class="bottom-home">
<div class="pref beige"></div>
	<div class="container">
		<div class="col-md-12">
			<div class="content">
				<hr>
				<?php echo apply_filters('the_content', get_post()->post_content); ?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>