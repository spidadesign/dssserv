<?php
	/*
	Template Name: Rentals
	*/
	get_header();
?>
<div class="static-page">
	<div class="container">
		<div class="page-title">
			<h3><?php the_title(); ?></h3>
		</div>
		<div class="breadcrumbs"></div>
	</div>
	<div class="ps-options">
		<div class="container">
			Select Type:
			<a class="btn btn-default active" href="<?php echo site_url(); ?>/rentals">Rentals</a>
			<a class="btn btn-default" href="<?php echo site_url(); ?>/sales">Sales</a>
		</div>
	</div>
	<div class="content">
		<div class="pref beige"></div>
		<div class="container">
			<?php echo apply_filters('the_content', get_post()->post_content); ?>
		</div>
	</div>
</div>


<?php get_footer(); ?>