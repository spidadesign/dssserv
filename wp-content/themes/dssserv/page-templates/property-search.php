<?php
/*
Template Name: Property
*/

global $wp_query;
get_header();

$borough = $wp_query->query_vars['borough'];
$currURL =  $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
$currURL = explode('/', $currURL);
foreach($currURL as $url):
	if($url === 'rental'):
		$type = 'rental';
	elseif($url === 'sale'):
		$type = 'sale';
	endif;
endforeach;
$wp_query->query_vars['type'] = $type;
$boroughURL = $borough;
if($borough === 'staten_island'):
		
		$island = explode('_',$borough);
		$island = implode(' ', $island);
		$borough = sanitize_text_field(ucwords(strtolower($island)));
	else:
		$borough = sanitize_text_field(ucwords(strtolower($borough)));
	endif;
	$currURL = implode('/', $currURL);
	$sort = sanitize_text_field($_GET['sort']);
	$order = sanitize_text_field($_GET['order']);
		$args = array(
		'post_type' => 'property',
		'posts_per_page' => 10,
		'meta_key' => $sort,
		'orderby' => 'meta_value_num',
		'order' => $order,
		'meta_query' => array(
			array('key' => 'borough', 'value' => $borough, 'compare'   => 'LIKE'),
			array('key' => 'random_219', 'value'=> $type, 'compare'    => 'LIKE'),
			//array('key' => 'price', 'value' => order, 'compare'   => 'LIKE'),
			array('key' => 'random_8', 'value'=>'Exclusive', 'compare' => 'NOT LIKE'),
			array('key' => 'bathrooms', 'value'=>'Exclusive', 'compare' => 'NOT LIKE')
			)
		);
			$loop = new WP_Query( $args );
	$listingCount = $loop->post_count;
	$count = 1;
?>
<div class="container">
	<div class="page-title">
		<h3><?php the_title(); ?></h3>
	</div>
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
<div class="ps-options">
	<div class="container">
		<span>Select Type:</span>
			<a class="btn btn-default" href="<?php echo site_url();?>/property-search/<?php echo $boroughURL; ?>/rental/" id="rental">Rental</a>
			<a class="btn btn-default" href="<?php echo site_url();?>/property-search/<?php echo $boroughURL; ?>/sale/" id="sale">Sale</a>
		<div class="fr">
			<span>Select Area:</span>
			<a type="button" class="btn btn-default b-name" id="manhattan" href="<?php echo site_url();?>/property-search/manhattan">Manhattan</a>
			<a type="button" class="btn btn-default b-name" id="bronx" href="<?php echo site_url();?>/property-search/bronx">Bronx</a>
			<a type="button" class="btn btn-default b-name" id="brooklyn" href="<?php echo site_url();?>/property-search/brooklyn">Brooklyn</a>
			<a type="button" class="btn btn-default b-name" id="queens" href="<?php echo site_url();?>/property-search/queens">Queens</a>
			<a type="button" class="btn btn-default b-name" id="staten_island" href="<?php echo site_url();?>/property-search/staten_island">Staten Island</a>
		</div>
	</div>
</div>
<div class="listings property-search">
	<div class="pref beige"></div>
	<div class="container">
		<div class="row top-bar">
			<div class="col-md-1 col-sm-1 col-xs-1 number">#</div>
			<div class="col-md-1 col-sm-1 col-xs-3 col-xs-offset-0 col-md-offset-4">Location</div>
			<div class="col-md-1 col-sm-1 col-xs-2 col-xs-offset-0 col-md-offset-1">Bdrm</div>
			<div class="col-md-1 col-sm-1 col-xs-2 col-xs-offset-0 bath-nav">Baths</div>
			<div class="col-md-1 col-sm-1 col-xs-2 col-xs-offset-0 col-md-offset-1 price-nav">Price</div>
		</div>
	<div class="list-reload">
		<?php

			while ( $loop->have_posts() ) : $loop->the_post();
				$custom = get_post_custom(get_the_ID());
				//echo "<pre>"; print_r($custom); echo "</pre>";
				if($count === $listingCount):
					echo '<div class="row individual last" data-toggle="collapse" data-target="#prop-'.$count.'">';
				else:
					echo '<div class="row individual" data-toggle="collapse" data-target="#prop-'.$count.'">';
				endif;
				?>
				<div class="col-md-1 col-sm-1 col-xs-1 col-xs-offset-0 number">
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
				<div class="col-md-4 hidden-xs">
					 <?php
					 	$images =& get_children( array (
					 		'post_parent'    => $post->ID,
					 		'post_type'      => 'attachment',
					 		'post_mime_type' => 'image'
					 		));

					 	if ( empty($images) ):
						 	// no attachments here
						else:
							echo "<div class='small-gallery'>";
								$imgCount = 1;
								$args = array('class' => 'next-row attachment-thumbnail');
							foreach ( $images as $attachment_id => $attachment ):
								if($imgCount <= 3):
									echo wp_get_attachment_image( $attachment_id, 'thumbnail' );
								elseif($imgCount > 3):
									//echo wp_get_attachment_image( $attachment_id, 'thumbnail', 1, $args );
								endif;
								$imgCount++;
							endforeach;
							$imgCount = 0;
							echo "</div>";
						endif;
						?>

				</div>
				<div class="col-md-1 col-sm-1 col-xs-3">
					<?php echo $custom['area'][0]; ?>
				</div>
				<div class="col-md-1 col-sm-1 col-xs-2 col-xs-offset-0 col-md-offset-1">
					<?php echo $custom['bedrooms'][0]; ?>
				</div>
				<div class="col-md-1 col-sm-1 col-xs-2 col-xs-offset-0 bath">
					<?php echo $custom['bathrooms'][0]; ?>
				</div>
				<div class="col-md-1 col-md-offset-1 col-sm-1 col-xs-2 col-xs-offset-0 price">
					$<?php echo $custom['price'][0]; ?>
				</div>
				<div class="col-md-1">
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
									<li class="collapse-content">
										<?php
											foreach ( $images as $attachment_id => $attachment ):
												$image = wp_get_attachment_image_src( $attachment_id, 'large' );
											?>

												<div>
													<a href="<?php echo $image[0];?>" class="lightbox-gallery" data-lightbox-gallery="gallery<?php echo $count; ?>" title="<?php the_title();?>">
														<?php echo wp_get_attachment_image( $attachment_id, 'medium' ); ?>
														<div class="overlay"></div>
														<div class="pan_frame">
															<img src="<?php bloginfo('template_directory'); ?>/assets/images/corners.png">
														</div>

													</a>
												</div>
										<?php endforeach;?>
									</div>
								<?php endif; ?>
					</div>
					<div class="col-md-8">
						<div class="row">
							<hr class="col-md-2">
						</div>
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
						<div class="row">
							<hr class="share">
							<div class="share">
								Share this Listing on:
								<!-- AddThis Button BEGIN -->
								<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
									<a class="addthis_button_facebook"></a>
									<a class="addthis_button_twitter"></a>
								</div>
									<script type="text/javascript">var addthis_config = {};</script>
									<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-52b35f5a2a8b16b7"></script>
									<!-- AddThis Button END -->
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