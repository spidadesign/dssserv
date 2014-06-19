<?php
/*
Template Name: Exclusive Property
*/
get_header();
?>
<div class="exclusive">
	<div class="container">
		<div class="page-title">
			<h3><?php the_title(); ?></h3>
		</div>
	</div>
	<div class="pref white"></div>
	<div class="prop-desc">
		<div class="container">
			<div class="row">
				<?php
					$currProp = sanitize_text_field($_GET['location']);
					$args = array(
						'post_type' => 'property',
						'posts_per_page' => 1,
						'post_parent' => 0,
						'name' => $currProp,
						'meta_query' => array(
							array('key' => 'random_8', 'value'=>'Exclusive', 'compare'=>'LIKE')
							)
						);
					$loop = new WP_Query( $args );
					while ( $loop->have_posts() ) : $loop->the_post();
						$id = get_the_ID();
					?>
					<div class="col-md-4">
						<?php echo the_post_thumbnail('large'); ?>
					</div>
					<div class="col-md-8">
						<div class="row title">
							<?php echo the_title(); ?>
						</div>
						<div class="row content">
							<?php the_content(); ?>
						</div>
					</div>
					<?php
						endwhile;
						unset($args);
						unset($loop);
					?>
			</div>
		</div>
	</div>


<div class="listings">
	<div class="container">
		<div class="title">
			Current Properties
		</div>
		<div class="row top-bar">
			<div class="col-md-1 col-xs-2 number">#</div>
			<div class="col-md-1 col-xs-2">Unit</div>
			<div class="col-md-1 col-xs-2">Bdrm</div>
			<div class="col-md-1 col-xs-2">Baths</div>
			<div class="col-md-1 col-md-offset-1 col-xs-2 col-xs-offset-0">Price</div>
		</div>

			<?php
				$parentTitle = get_the_title();
				$currPropID = $id;
				$args = array(
				'post_type' => 'property',
				'posts_per_page' => -1,
				'post_parent' => $currPropID,
				'meta_query' => array(
					array('key' => 'random_8', 'value'=>'Exclusive', 'compare'=>'LIKE')
					)
				);

			wp_reset_query();
			$loop = new WP_Query( $args );
			$listingCount = $loop->post_count;
			$count = 1;
			while ( $loop->have_posts() ) : $loop->the_post();
				$custom = get_post_custom(get_the_ID());
			if($count === $listingCount):
					echo '<div class="row individual last" data-toggle="collapse" data-target="#prop-'.$count.'">';
				else:
					echo '<div class="row individual" data-toggle="collapse" data-target="#prop-'.$count.'">';
				endif;
				?>
				<div class="col-md-1 col-xs-2 number">
					<div class="count">
						<?php
							if($count < 10):
								echo '0'.$count;
							else:
								echo $count;
							endif;
						?>
					</div>
				</div>
				<div class="col-md-1 col-xs-2">
					<?php the_title(); ?>
				</div>
				<div class="col-md-1 col-xs-2">
					<?php echo $custom['bedrooms'][0]; ?>
				</div>
				<div class="col-md-1 col-xs-2">
					<?php echo $custom['bathrooms'][0]; ?>
				</div>
				<div class="col-md-1 col-md-offset-1 col-xs-2 col-xs-offset-0">
					$<?php echo $custom['price'][0]; ?>
				</div>
				<div class="col-md-1 col-md-offset-5">
					<button type="button" class="btn btn-default"  data-toggle="collapse" data-target="#prop-<?php echo $count; ?>"></button>
				</div>
			</div>
			<div class="row prop-content">
				<div id="prop-<?php echo $count; ?>" class="collapse single-prop">
					<div class="inner">
					<div class="pref white"></div>
					<div class="col-md-4">
						 <?php
							 	$images =& get_children( array (
							 		'post_parent' => $post->ID,
							 		'post_type' => 'attachment',
							 		'post_mime_type' => 'image'
							 		));

							 	if ( empty($images) ):
								 	// no attachments here
								else:?>
									<ul class="collapse-content">
										<?php
											foreach ( $images as $attachment_id => $attachment ):
												$image = wp_get_attachment_image_src( $attachment_id, 'large' );
											?>
											<div>
												<a href="<?php echo $image[0];?>"
													class="lightbox-gallery"
													data-lightbox-gallery="gallery<?php echo $count; ?>"
													title="Apartment <?php the_title();?>">
													<?php echo wp_get_attachment_image( $attachment_id, 'medium' ); ?>
												</a>
											</div>
										<?php endforeach;?>
									</ul>
								<?php endif; ?>
					</div>
					<div class="col-md-8">
						<div class="row">
							<hr class="col-md-2">
						</div>
						<div class="row top">
							<div class="fl title">
								Apartment <?php the_title(); ?>
							</div>
							<div class="fr">
								<a type="button" class="btn btn-primary" href="#" data-toggle="modal" data-target="#interested<?php echo $count; ?>">
									Interested in this apartment?
								</a>
							</div>
						</div>
						<div class="row bottom">
							<?php the_content();?>
						</div>
						<div class="row">
							<hr class="share">
							<div class="share">
								<div class="col-md-5">
								Share this Listing on:
								<!-- AddThis Button BEGIN -->
								<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
									<a class="addthis_button_facebook"></a>
									<a class="addthis_button_twitter"></a>
								</div>
								<script type="text/javascript">var addthis_config = {"data_track_addressbar":false};</script>
								<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52b35f5a2a8b16b7"></script>
								<!-- AddThis Button END -->
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
	<div class="single-property">
		<div class="modal fade interested" id="interested<?php echo $count; ?>" tabindex="-1" role="dialog" aria-labelledby="interestedLabel" aria-hidden="true">
		<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				<div class="modal-title" id="title">
					<img src="<?php bloginfo('template_directory'); ?>/assets/images/logo-white.png" alt="DSS Services">
					<h4>Request Apartment Information</h4>
				<h3><span>call</span>1-212-369-9212</h3>
				</div>
			</div>
			<div class="modal-body">
				<p>I am interested in <span> Apartment <?php the_title(); ?></span> at <span><?php echo $parentTitle; ?></span></p>
				<div class="col-md-2 col-md-offset-5"><hr></div>
				<?php echo do_shortcode(apply_filters("the_content", '[contact-form-7 id="45" title="Property Information"]')); ?>
			</div>
			<div class="modal-footer">
			</div>
		</div>
	</div>
</div>
	</div>
			</div>
			<?php $count++; endwhile; ?>
	</div>
</div>
</div>


<?php get_footer(); ?>