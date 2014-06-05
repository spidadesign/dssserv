<?php
/*
Template Name: Property
*/
get_header();
$count = 1;
if (have_posts()) : while (have_posts()) : the_post();
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
<div class="single-housing">
	<div class="pref beige"></div>
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
			<div class="single-listing">
				<?php foreach ( $images as $attachment_id => $attachment ):
					$attr = array('class'=> "attachment-$size img-responsive");
					$image = wp_get_attachment_image_src( $attachment_id, 'large' );
				?>
					<div>

						<a href="<?php echo $image[0];?>" class="lightbox-gallery" data-lightbox-gallery="gallery<?php echo $count; ?>" title="<?php the_title();?>" id="test">
							<?php echo wp_get_attachment_image( $attachment_id, 'large', '', $attr ); ?>
							<div class="overlay"></div>
							<div class="pan_frame">&nbsp;</div>
						</a>
					</div>
				<?php endforeach;?>
			</div>
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
			<div class="col-md-6 share">
				Share this Listing on:
				<!-- AddThis Button BEGIN -->
				<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
					<a class="addthis_button_facebook"></a>
					<a class="addthis_button_twitter"></a>
				</div>
				<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
				<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52b35f5a2a8b16b7"></script>
				<!-- AddThis Button END -->
			</div>
		</div>
	</div>
</div>
<div class="modal fade interested" id="interested" tabindex="-1" role="dialog" aria-labelledby="interestedLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<div class="modal-title" id="title">
					<img src="<?php bloginfo('template_directory'); ?>/assets/images/logo-white.png" alt="DSS Services">
					<h4>Request Apartment Information</h4>
				<h3><span>call</span>1-212-369-9212</h3>
				</div>
			</div>
			<div class="pref beige"></div>
			<div class="modal-body">
				<p>I am interested in <span><?php the_title(); ?></span> at <span><?php echo $custom['location'][0]; ?></span></p>
				<div class="col-md-2 col-md-offset-5"><hr></div>
				<?php echo do_shortcode(apply_filters("the_content", '[contact-form-7 id="45" title="Property Information"]')); ?>
			</div>

		</div>
	</div>
</div>
<?php
	$count++;
	endwhile;
	endif;
	get_footer();
?>