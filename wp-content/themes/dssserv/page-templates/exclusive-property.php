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
							//array('key' => 'random_219', 'value'=> $type, 'compare' => 'LIKE'),
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
		<div class="col-md-1 number">#</div>
		<div class="col-md-1">Unit</div>
		<div class="col-md-1">Bdrm</div>
		<div class="col-md-1">Baths</div>
		<div class="col-md-1">Price</div>
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
			$count = 01;
			while ( $loop->have_posts() ) : $loop->the_post();
				$custom = get_post_custom(get_the_ID());
			?>
			<div class="row individual" data-toggle="collapse" data-target="#prop-<?php echo $count; ?>">
				<div class="col-md-1 number">
					<div class="count">
						<?php echo $count; ?>
					</div>
				</div>
				<div class="col-md-1">
					<?php the_title(); ?>
				</div>
				<div class="col-md-1">
					<?php echo $custom['bedrooms'][0]; ?>
				</div>
				<div class="col-md-1">
					<?php echo $custom['bathrooms'][0]; ?>
				</div>
				<div class="col-md-1 ">
					$<?php echo $custom['price'][0]; ?>
				</div>
				<div class="col-md-1 col-md-offset-6">
					<button type="button" class="btn btn-default"  data-toggle="collapse" data-target="#prop-<?php echo $count; ?>"></button>
				</div>
			</div>
			<div class="row prop-content">
				<div id="prop-<?php echo $count; ?>" class="collapse">
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

												<li style="width:100%">
													<a href="<?php echo $image[0];?>" 
														class="lightbox-gallery" 
														data-lightbox-gallery="gallery<?php echo $count; ?>" 
														title="Apartment <?php the_title();?>">
															<?php echo wp_get_attachment_image( $attachment_id, 'medium' ); ?>
													</a>
												</li>
										<?php endforeach;?>
									</ul>
								<?php endif; ?>
					</div>
					<div class="col-md-8">
						<div class="row top">
							<div class="fl title">
								Apartment <?php the_title(); ?>
							</div>
							<div class="fr">
								<a type="button" class="btn btn-primary" href="#" data-toggle="modal" data-target="#interested<?php echo $count; ?>">
									Interested in this apartment
								</a>
							</div>
						</div>
						<div class="row bottom">
							<?php the_content(); 
								
								//echo "<pre>"; print_r($loop); echo "</pre>";
							?>
						</div>
						<div class="row">
							<div class="fr contact">
								Interested? Click to email us, or call 1-212-369-9212
							</div>
						</div>
						<hr><br>
						<div class="col-md-6 share">
							Share this Listing on:
							<!-- AddThis Button BEGIN -->
							<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
								<a 
									class="addthis_button_preferred_1"
									addthis:url="<?php echo the_permalink();?>"
									addthis:title="Check out Apartment <?php the_title(); ?> at <?php echo $parentTitle; ?>"
									></a>
								<a 
									class="addthis_button_preferred_2"
									addthis:url="<?php echo the_permalink();?>"
									addthis:title="Check out Apartment <?php the_title(); ?> at <?php echo $parentTitle; ?>"
								></a>
							</div>
							<script type="text/javascript">var addthis_config = {};</script>
							<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52b35f5a2a8b16b7"></script>
							<!-- AddThis Button END -->
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
			<?php $count++; endwhile; ?>
	</div>
</div>
</div>


<?php get_footer(); ?>