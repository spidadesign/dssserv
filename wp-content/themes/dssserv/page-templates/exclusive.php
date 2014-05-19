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
	<div class="container">
		<?php
			$args = array('post_type' => 'exclusive');
			$loop = new WP_Query( $args );
			while ( $loop->have_posts() ) : $loop->the_post();
		?>
		<div class="col-md-4">
			<div class="row">
				<?php the_post_thumbnail('large'); ?>
			</div>
			 <div class="row">
			 	<?php the_title(); ?>
			 </div>
		</div>
			<?php endwhile; ?>
	</div>
</div>
<?php get_footer(); ?>