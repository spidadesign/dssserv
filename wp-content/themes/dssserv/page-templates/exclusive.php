<?php
/*
Template Name: Exclusive
*/
get_header();
?>
<div class="container">
	<div class="page-title">
		<h3><?php the_title(); ?></h3>
	</div>
	<div class="breadcrumbs"></div>
</div>

<div class="exclusive-body">
	<div class="pref beige"></div>
	<div class="container">
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
			while ( $loop->have_posts() ) : $loop->the_post();
		?>
		<div class="col-md-4">
		<?php
			$title = strtolower(get_the_title());
			$title = explode(' ', $title);
			$link = implode('-', $title);
		?>
		<a href="<?php echo site_url().'/exclusive-property/'.'?location='.$link;?>">
			<div class="row">
				<?php the_post_thumbnail('large'); ?>
				<div class="overlay"></div>
				<div class="pan_frame">
					<img src="<?php bloginfo('template_directory'); ?>/assets/images/corners.png">
				</div>
			</div>
			 <div class="row title">
			 	<?php the_title(); ?>
			 </div>
		</div>
		</a>

			<?php endwhile; ?>
	</div>
</div>
<?php get_footer(); ?>