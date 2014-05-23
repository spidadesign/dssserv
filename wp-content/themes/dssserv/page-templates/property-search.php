<?php
/*
Template Name: Property
*/
get_header();
?>
<div class="container">
	<div class="page-title">
		<h3><?php the_title(); ?></h3>
	</div>
	<div class="breadcrumbs"></div>
</div>
<div class="ps-options">
	<div class="container">
		Select Type:
			<a class="btn btn-default" href="?type=rental">Rental</a>
			<a class="btn btn-default" href="?type=sale">Sale</a>
		<div class="fr">
			Select Area:
			<a type="button" class="btn btn-default" href="?borough=manhattan">Manhattan</a>
			<a type="button" class="btn btn-default" href="?borough=bronx">Bronx</a>
			<a type="button" class="btn btn-default" href="?borough=brooklyn">Brooklyn</a>
			<a type="button" class="btn btn-default" href="?borough=queens">Queens</a>
			<a type="button" class="btn btn-default" href="?borough=staten_island">Staten Island</a>
		</div>
	</div>
</div>
<div class="listings">
	<div class="container">
	<div class="row top-bar">
		<div class="col-md-1 number">#</div>
		<div class="col-md-1 col-md-offset-4">Location</div>
		<div class="col-md-1 col-md-offset-1">Bdrm</div>
		<div class="col-md-1">Baths</div>
		<div class="col-md-1 col-md-offset-1">Price</div>
	</div>
	<hr>

		<?php
			if($_GET['borough'] === 'staten_island'):
				$island = explode('_',$_GET['borough']);
				$island = implode(' ', $island);
				$borough = sanitize_text_field(ucwords(strtolower($island)));
			else:
				$borough = sanitize_text_field(ucwords(strtolower($_GET['borough'])));
			endif;
			if(isset($_GET['type'])):
				$type = sanitize_text_field($_GET['type']);
			endif;
			$args = array(
				'post_type' => 'property',
				'posts_per_page' => 10,
				'meta_query' => array(
					array('key' => 'borough', 'value' => $borough, 'compare' => 'LIKE'),
					array('key' => 'random_219', 'value'=> $type, 'compare' => 'LIKE'),
					array('key' => 'random_8', 'value'=>'Exclusive', 'compare'=>'NOT LIKE')
					)
				);
			$loop = new WP_Query( $args );
			$count = 01;
			while ( $loop->have_posts() ) : $loop->the_post();
				$custom = get_post_custom(get_the_ID());
				//print_r($custom);
				//echo $GLOBALS['wp_query']->request;
			?>
			<div class="row individual">
				<div class="col-md-1 number">
					<div class="count">
						<?php echo $count; ?>
					</div>
				</div>
				<div class="col-md-4">
					 <?php
					 	$images =& get_children( array (
					 		'post_parent' => $post->ID,
					 		'post_type' => 'attachment',
					 		'post_mime_type' => 'image'
					 		));

					 	if ( empty($images) ):
						 	// no attachments here
						else:
							echo "<div class='small-gallery'>";
							foreach ( $images as $attachment_id => $attachment ):
								echo wp_get_attachment_image( $attachment_id, 'thumbnail' );
							endforeach;
							echo "</div>";
						endif;
						?>

				</div>
				<div class="col-md-1">
					<?php echo $custom['area'][0]; ?>
				</div>
				<div class="col-md-1 col-md-offset-1">
					<?php echo $custom['bedrooms'][0]; ?>
				</div>
				<div class="col-md-1">
					<?php echo $custom['bathrooms'][0]; ?>
				</div>
				<div class="col-md-1 col-md-offset-1">
					$<?php echo $custom['price'][0]; ?>
				</div>
				<div class="col-md-1">
					<button type="button" class="btn btn-default"  data-toggle="collapse" data-target="#prop-<?php echo $count; ?>"></button>
				</div>
			</div>
			<hr>
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
													<a href="<?php echo $image[0];?>" class="lightbox-gallery" data-lightbox-gallery="gallery<?php echo $count; ?>" title="<?php the_title();?>">
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
								<?php the_title(); ?>
							</div>
							<div class="fr">
								<a href="<?php the_permalink(); ?>">Learn More</a>
							</div>
						</div>
						<div class="row bottom">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</div>
			</div>

			<?php $count++; endwhile; ?>
	</div>
</div>

<?php get_footer()?>