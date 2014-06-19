<?php
	/*
	Template Name: Renter's Guide
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
			Select Guide:
			<a class="btn btn-default rentals" href="<?php echo site_url(); ?>/renters-guide">Renter's Guide</a>
			<a class="btn btn-default sales" href="<?php echo site_url(); ?>/sellers-guide">Seller's Guide</a>
			<a class="btn btn-default mortgage" href="<?php echo site_url(); ?>/mortgage-guide">Mortgage Guide</a>
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