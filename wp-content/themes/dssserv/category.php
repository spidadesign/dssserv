<?php
	get_header();
	wp_reset_postdata();
    $cur_cat_id = get_cat_id(single_cat_title("",false) );
	$temp = $wp_query;
	$wp_query = null;
	$wp_query = new WP_Query();
	$wp_query->query('cat='.$cur_cat_id.'&post_type=neighborhood-guide');
	if (have_posts()) :
		$args = array(
			'hide_empty' => '0',
			'parent' => '7'
		);
		$categories = get_categories( $args );

		while (have_posts()) : the_post();
			$guide = ucwords(strtolower($wp_query->query_vars['category_name']));
			$custom = get_post_custom(get_the_ID());
			unset($custom['_edit_last']);
			unset($custom['_edit_lock']);
			unset($custom['_wp_old_slug']);
			//echo "<pre>"; print_r($custom); echo "</pre>";
	?>
		<div class="container">
			<div class="page-title">
				<h3><?php echo $guide; ?> Neighborhood Guide</h3>
				<div class="breadcrumbs"></div>
			</div>
		</div>
		<div class="guide">
			<div class="pref beige"></div>
			<div class="container">
				<div class="col-md-9">
					<div class="title"><?php the_title(); ?></div>
				</div>
				<div class="col-md-3">
					<div class="title">Neighborhoods</div>
				</div>
				<div class="col-md-9">
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
						<div class="overlay"></div>
						<div class="pan_frame">
							<img src="<?php bloginfo('template_directory'); ?>/assets/images/corners-guide.png">
						</div>
					</div>
					<div class="col-md-3 neighborhoods">
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
								?>
								<ul>
									<?php foreach($neighborhoods as $neighborhood):?>
										<li><a href="<?php echo site_url().'/neighborhood-guide/'.$neighborhood->slug;?>"><?php echo $neighborhood->name; ?></a></li>
								<?php endforeach; ?>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="neighborhood-content">
			<div class="container">
				<div class="col-md-8">
					<div class="row">
						<div class="overview">
							<div class="title">Neighborhood Overview</div>
							<div class="content"><?php the_content(); ?></div>
						</div>
					</div>

					<?php foreach($custom as $key => $value): ?>
					<div class="row">
						<div class="title"><?php echo $key; ?></div>
						<div class="content"><?php echo $value[0]; ?></div>
					</div>
					<?php endforeach; ?>
					<div class="trains row">
					<div class="title">Transportation</div>
					Subway:
					<?php
						$tagArg = array('orderby'=>'desc');
						$tags = get_tags($tagArg);
						foreach($tags as $tag):
					?>
						<img src="<?php echo get_template_directory_uri().'/assets/images/trains/'.strtoupper($tag->name).'.jpg';?>">
					<?php endforeach; ?>
					</div>
				</div>
			</div>
		</div>

	<?php endwhile; else: ?>
				<p><?php _e('Sorry, no posts matched your criteria.'); ?></p>
				<?php endif; ?>
	
<?php get_footer(); ?>