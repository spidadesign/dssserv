<?php
/*
Template Name: Single Neighborhood Guide
*/
get_header();
$guide = ucwords(strtolower($wp_query->query_vars['neighborhood-guide']));
$args = array(
	'hide_empty' => '0',
	'parent' => '7'
);
$guide = explode('-', $guide);
foreach($guide as $guides):
	ucwords(strtolower($guides));
endforeach;
echo "<pre>"; print_r($guide); echo "</pre>";
$categories = get_categories( $args );
?>
<div class="container">
	<div class="page-title">
		<h3><?php echo $guide; ?> Neighborhood Guide</h3>
		<div class="breadcrumbs">
			<a href="<?php echo site_url();?>">Home</a>
			<?php 
				if($borough):
					echo " - <a href='".site_url()."/property-search/".strtolower($borough)."'>".$borough."</a>";
				endif;
				if($type):
					echo " - <a href='$currURL'>".ucwords(strtolower($type))."</a>";
				endif;
			?>
		</div>
	</div>
</div>
<div class="guide">
	<div class="pref beige"></div>
		<div class="container">
			<div class="col-md-10">
				<div class="title"><?php the_title(); ?></div>
			</div>
			<div class="col-md-2">
				<div class="title">Neighborhoods</div>
			</div>
			<div class="col-md-10">
			<?php
			 	$images =& get_children( array (
			 		'post_parent'    => $post->ID,
			 		'post_type'      => 'attachment',
			 		'post_mime_type' => 'image'
			 		));

			 	if ( empty($images) ):
				 	// no attachments here
				else:
					echo "<div class='guide-img'>";
						$args = array('class' => 'next-row');
					foreach ( $images as $attachment_id => $attachment ):
						echo "<div>";
							echo wp_get_attachment_image( $attachment_id, '' );
						echo "</div>";
					endforeach;
					echo "</div>";
				endif;
				?>
			</div>
			<div class="col-md-2 neighborhoods">
				<?php foreach($categories as $category): ?>
					<div class="title">
						<?php echo $category->name; ?>
					</div>
					<div class="links">
						<?php
							$nhargs = array(
								'hide_empty' => '0',
								'parent' => $category->term_id
							);
							$neighborhoods = get_categories( $nhargs );
							foreach($neighborhoods as $neighborhood):
								echo $neighborhood->name."<br>";
							endforeach;
							?>
					</div>
				<?php endforeach; ?>
			</div>
	</div>
</div>
<?php get_footer(); ?>