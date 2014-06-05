	<?php //if
		$curr_page = get_post();
		if($curr_page->ID === 5):
			echo '<div class="logo-divider"></div>';
		else:
			echo '<div class="big-space"><div class="pref white"></div></div>';
		endif;
		?>
		<div class="city">
			<?php if($curr_page->ID !== 5): ?>
			<div class="branding">
				<img src="<?php bloginfo('template_directory'); ?>/assets/images/logo-blue.png" alt="DSS Services">
				<span class="apt">Apartments</span> in <span class="city">New York</span>
			</div>
			<?php endif; ?>
		</div>

		<div class="home-contact">
		<div class="pref beige"></div>
			<div class="container">
				<div class="col-md-3 col-md-offset-5">
					<span class="text-center title">Contact Us</span>
				</div>
				<?php
					echo do_shortcode(apply_filters("the_content", "[contact-form-7 id='14' title='General Contact']")); ?>
				<div class="col-md-5 col-md-offset-1">

				</div>
			</div>
		</div>
	</div>
		<div class="footer">
			<div class="top">
				<div class="container">
					&copy; <?php echo date('Y'); ?> DSS Services
					<span class="light">New York Office:</span> 13 East 124th street Basement Suite New York, NY 10035
					<span class="light">Phone:</span> 212-369-9212
					<span class="light">Fax:</span> 212-369-2070
					<span class="site-by">
						<span class="light">Site by:</span>
						<a href="http://www.spidadesign.com">Spida Design</a>
					</span>
				</div>
			</div>
			<div class="bottom"></div>
		</div>

		<!-- Modal -->
		<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
						<h4 class="modal-title" id="myModalLabel">Modal title</h4>
					</div>
					<div class="modal-body">
						<?php
							echo do_shortcode(apply_filters("the_content", "[contact-form-7 id='14' title='General Contact']"));
						//echo do_shortcode([[contact-form-7 id="14" title="General Contact"]]);
						?>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-primary">Save changes</button>
			      </div>
			    </div>
			  </div>
			</div>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js" type="text/javascript"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/nivo-lightbox/nivo-lightbox.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/assets/javascripts/bootstrap/dropdown.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/assets/javascripts/bootstrap/modal.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/assets/javascripts/bootstrap/collapse.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/assets/javascripts/bootstrap/transition.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/assets/plugins/slick/slick.min.js"></script>
		<script src="<?php echo get_template_directory_uri(); ?>/assets/javascripts/random.js"></script>
		<script>
			$(document).ready(function() {
				$('.home-slider').slick({
					dots: true,
					draggable: false,
					arrows: false,
				});
				$('.mid-page').slick({
					dots: true,
					draggable: false,
					arrows: false
				});
				$('.collapse-content').slick({
					dots: true,
					draggable: false,
					arrows: false
				});
				$('.single-listing').slick({
					dots: true,
					draggable: false,
					arrows: false
				});
				$('.lightbox-gallery').nivoLightbox({
					effect: 'fade',
					theme: 'default',
					clickOverlayToClose: true,
				});
				if ($(this).hasClass('in')) {
					$(this).parent().addClass('active');
				}
				if(click%3 !== 0){
					$(".bath-nav").addClass("sort");
					$(".bath").addClass("sort");
				}
			});


			var click = 0;
			$(".price-nav").click(function(){
				click = ++click;
				window.location.href = "<?php echo strtok($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],'?'); ?>";
				console.log(window.location.href);
				if(click%3 === 0){
					$(this).removeClass("sort");
					$(".price").removeClass("sort");
				}
				else{
					if(click%3 === 1){
						window.location.href = "<?php echo strtok($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],'?'); ?>?sort=price&order=DESC";
						//console.log("<?php echo strtok($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],'?'); ?>");
					}
					if(click%3 === 2){
						window.location.href = "<?php echo strtok($_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"],'?'); ?>?sort=price&order=DESC";
						//window.location.href = window.location.href + "?sort=price&order=ASC";
					}
					$(this).addClass("sort");
					$(".price").addClass("sort");
				}

			});

</script>
		<?php
			$curr_page = get_post();
			if($curr_page->ID == 18):
		?>
			<script>
				var borough = $(".b-name").html().toLowerCase();
				$('.b-name').filter(function () {
					return $(this).text().toLowerCase() === "<?php echo $_GET['borough']; ?>";
				}).addClass('active');
			</script>
		<?php endif; ?>
	</body>
</html>
