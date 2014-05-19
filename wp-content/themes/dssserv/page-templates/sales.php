<?php
	/*
	Template Name: Sales
	*/
	get_header();
?>
<div class="container">
	<?php echo apply_filters('the_content', get_post()->post_content); ?>
</div>

<?php get_footer(); ?>