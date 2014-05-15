<?php
/*
Template Name: Property
*/
get_header();
?>
<?php if (have_posts()) : while (have_posts()) : the_post();
		$custom = get_post_custom(get_the_ID());
?>
<div class="container">
	<div class="page-title">
		<h3><?php the_title(); ?></h3>
		<div class="back">
			<a href="<?php echo site_url();?>/property-search">Back to Listings</a>
		</div>
	</div>
	<div class="breadcrumbs"></div>
</div>
	<div class='single-housing'>
		<div class="pref"></div>
	<div class="container">
		<div class="col-md-6">
	<?php
	 $images =& get_children( array (
	 		'post_parent' => $post->ID,
	 		'post_type' => 'attachment',
	 		'post_mime_type' => 'image'
	 		));

	 	if ( empty($images) ):
		 	// no attachments here
		else:?>
			<ul class="single-listing">
				<?php foreach ( $images as $attachment_id => $attachment ):
					$attr = array('class'=> "attachment-$size img-responsive");
				?>
					<li>
						<?php echo wp_get_attachment_image( $attachment_id, 'large', '', $attr ); ?>
						<div class="pan_frame">&nbsp;</div>
					</li>
				<?php endforeach;?>
			</ul>
		<?php endif;?>
		</div>
		<div class="col-md-6">
			<div class="row title">
				<?php the_title(); ?>
			</div>
			<div class="row info">
				<div class="row">
					<div class="col-md-3">
						<div class="col-md-8">Bedrooms:</div>
						<div class="col-md-4 number"><?php echo $custom['bedrooms'][0]; ?></div>
					</div>
					<div class="col-md-3">
						<div class="col-md-8">Price:</div>
						<div class="col-md-4 number"><?php echo $custom['price'][0]; ?></div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-3">
						<div class="col-md-8">Bathrooms:</div>
						<div class="col-md-4 number"><?php echo $custom['bathrooms'][0]; ?></div>
					</div>
					<div class="col-md-3">
						<div class="col-md-8">Price:</div>
						<div class="col-md-4 number"><?php echo $custom['price'][0]; ?></div>
					</div>
				</div>
				<div class="content">
					<?php the_content(); ?>
				</div>
			</div>
			<div class="row">
				<a type="button" class="btn btn-primary" href="#" data-toggle="modal" data-target="#interested">
					Interested in this apartment
				</a>
				<div class="fr contact">
					Click to email us, or call 1-212-369-9212
				</div>
			</div>
			<hr>
			Share this listing on:
		</div>
	</div>
</div>
<div class="modal fade" id="interested" tabindex="-1" role="dialog" aria-labelledby="interestedLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<div class="modal-title" id="title">
					<img src="<?php bloginfo('template_directory'); ?>/assets/images/modal-logo.png" alt="DSS Services">
					<h4>Request Apartment Information</h4>
				<h3><span>call</span>1-212-369-9212</h3>
				</div>
			</div>
			<div class="modal-body">
				<?php //echo "<pre>"; print_r($custom); echo "</pre>"; ?>
				<p>I am interested in <span><?php the_title(); ?></span> at <span><?php echo $custom['location'][0]; ?></span></p>
				<div class="col-md-2 col-md-offset-5">
					<hr>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
<?php endwhile; endif; ?>
<?php get_footer()?>