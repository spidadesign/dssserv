<?php
/**
 * @package Custom Post
 * @author Faaiq Ahmed
 * @version 1.0.0
 */
/*
Plugin Name: Pretty Urls
Description: Associate Search engine friendly urls with category,post and pages.
Author: Faaiq
Version: 1.5.4
*/

global $pretty_db_version;	
$pretty_db_version = "2.0";

class pretty_url {
		function __construct() {
				add_action('admin_menu', array($this,'prettyurl_menu'));
				add_action('admin_head', array($this,'add_style'));
				add_action('add_meta_boxes', array($this,'myplugin_add_custom_box' ));
				add_action('save_post', array($this,'prettyurl_save_postdata' ));
				add_filter("term_link",array($this,"prettyurl_category_link"),10, 3);
				add_filter("page_link",array($this,"prettyurl_page_link"),10,3);
				add_filter("post_link",array($this,"prettyurl_post_link"),10,3);
				add_filter('post_type_link', array($this,'post_type_link'), 1, 3);
				
				add_filter('redirect_canonical', array($this,'bwp_cancel_redirect_canonical'));
				add_filter('rewrite_rules_array', array($this,'bwp_insertrules'));
				add_filter('wp_title', array($this,'meta_title'),1,2);
				add_action('wp_head', array($this,'meta_head'));
				register_deactivation_hook(__FILE__, array($this,'prettyurl_uninstall'));
				register_activation_hook(__FILE__, array($this,'pretty_install'));
				//add_filter("get_pagenum_link",array($this,"page_num"),1);
				//add_filter('parse_request', array($this,'custom_rule'));
				
		}
		
		function meta_head() {
				global $wpdb,$wp_query;
				
				
				$cat = get_query_var("cat");
				if($cat) {
						$row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where target_type	 = 'cat' and target_id = '$cat'");
				}
				$p = get_query_var("p");
				if($p) {
						
						$row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where target_type	 = 'post' and target_id = '$p'");
				}
				
				$page_id = get_query_var("page_id");
				if($page_id) {
						$row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where target_type	 = 'page' and target_id = '$page_id'");
				}
				
				$post_type = get_query_var("post_type");
				if($post_type) {
						$name = get_query_var("name");
						if(get_query_var($post_type) == get_query_var("name")) {
								$row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where target_type	 = '$post_type' and target_id = '$post_type'");		
						}else {
								$row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where target_type	 = 'post_type' and target_id = '$post_type'");		
						}
				}
				
				if($row->disable_meta == 0) {
						if($row->meta_description != '') {
								print '<META NAME="description" CONTENT="'.$row->meta_description.'">';
						}
						if($row->meta_keyword != '') {
								print '<META NAME="KEYWORDS" CONTENT="'.$row->meta_keyword.'">';
						}
						if($row->nofollow == 1) {
								print '<META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">';
						}
				}
				
				
		}
		
		function meta_title($title, $sep ) {
				global $wpdb,$wp_query;
				
				$cat = get_query_var("cat");
				if($cat) {
						$row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where target_type	 = 'cat' and target_id = '$cat'");
				}
				$p = get_query_var("p");
				if($p) {
						
						$row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where target_type	 = 'post' and target_id = '$p'");
				}
				
				$page_id = get_query_var("page_id");
				if($page_id) {
						$row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where target_type	 = 'page' and target_id = '$page_id'");
				}
				
				$post_type = get_query_var("post_type");
				if($post_type) {
						$name = get_query_var("name");
						if(get_query_var($post_type) == get_query_var("name")) {
								$row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where target_type	 = '$post_type' and target_id = '$post_type'");		
						}else {
								$row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where target_type	 = 'post_type' and target_id = '$post_type'");		
						}
				}
				
				if($row->disable_meta == 0) {
						if($row->meta_title != '') {
								$title = "  >  ".$row->meta_title;
						}
				}
				return $title;
		}
		
		function page_num($link) {
				global $wpdb;
				
				$home_url = home_url("/");
				$remaining_url = str_replace($home_url,"",$link);
				$remaining_url_arr = explode("/page",$remaining_url);
				$url = $remaining_url_arr[0];
				$url_row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where url = '$url'");
				if($url_row->id > 0) {
					$link_arr  = explode("/",$link);
					 for($i=0; $i< count($link_arr); ++$i) {
								if($link_arr[$i] == 'page') {
										$page = $link_arr[$i+1];
										break;
								}
						}
						if($page > 0 ) {
								$link_dot_arr = explode(".",$link);
								if(count($link_dot_arr) > 1) {
										$link = implode("-".$page.".",$link_dot_arr);		
								}else {
										$link = $link . "-";		
								}
								$link_arr = explode("/page",$link);
								$link = $link_arr[0];
						}
				}
				
				return $link;
		}
		function custom_rule($array) {
				global $wpdb,$post;

		}


		function pretty_install() {
				global $wpdb;
				global $pretty_db_version;
				$table_name = $wpdb->prefix ."prettyurls";
				
				$sql = "CREATE TABLE IF NOT EXISTS `".$table_name."` (
						`id` int(11) NOT NULL AUTO_INCREMENT,
						`target_id` varchar(50) NOT NULL,
						`target_type` varchar(50) NOT NULL,
						`url` varchar(250) NOT NULL,
						`meta_title` varchar(250) DEFAULT NULL,
						`meta_description` text,
						`meta_keyword` text,
						`disable_meta` int(1) NOT NULL,
						`nofollow` int(1) NOT NULL,
				PRIMARY KEY (`id`)
				) ENGINE=MyISAM  DEFAULT CHARSET=latin1;";
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($sql);
				
				add_option('pretty_db_version', $pretty_db_version);
		}	
		
		
			
		function prettyurl_uninstall() {
				global $wpdb;
				global $ccpo_db_version;
				$table_name = $wpdb->prefix ."prettyurls";
				
				$sql = "DROP TABLE IF EXISTS $table_name;";
				require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
				dbDelta($sql);
				delete_option('pretty_db_version');
				
		}	
		
		
		function prettyurl_menu() {
				add_menu_page('Pretty Urls', 'Pretty Urls', 'administrator', 'prettyurls', array($this,'prettyurls_manage'));
		}



		function prettyurls_manage() {
			global $wpdb;
			
			$act = $_REQUEST['act'];
			list($target_id,$target_type) = explode("~",$_POST['category']);
			$url = trim($_POST['url']);
			$id = trim($_REQUEST['id']);
			
			$meta_title = trim($_POST['meta_title']);
			$meta_description = trim($_POST['meta_description']);
			$meta_keyword = trim($_POST['meta_keyword']);
			$disable_meta = trim($_POST['disable_meta']);
			$nofollow = $_POST['nofollow'];
			$sanitize = $_POST['sanitize'];
			if($sanitize == 1) {
				$url = sanitize_title($url);
			}
			
			
			$data = array();
			$data[] = "target_id = '$target_id'";
			$data[] = "target_type = '$target_type'";
			$data[] = "url = '$url'";
			$data[] = "meta_title	 = '$meta_title'";
			$data[] = "meta_description	 = '$meta_description'";
			$data[] = "meta_keyword	 = '$meta_keyword'";
			$data[] = "disable_meta	 = '$disable_meta'";
			$data[] = "nofollow	 = '$nofollow'";
			
			
			if($target_id != '' && $target_type != '' &&  $url != '') {
				if($id) {
						$sql = "update ".$wpdb->prefix ."prettyurls set ".implode(",",$data)." where id = '$id'";
						$wpdb->query($sql);
				}else {
					$sql = "insert into ".$wpdb->prefix ."prettyurls set ".implode(",",$data);
					$wpdb->query($sql);
				}
				$this->pretty_redirect("admin.php?page=prettyurls");
			}
			
			if($act == 'delete') {
				$wpdb->query("delete from ".$wpdb->prefix."prettyurls where id = '$id'");
				$this->pretty_redirect("admin.php?page=prettyurls");
			}
			
			if($act == 'edit') {
				$results = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where id = '$id'");
				
				$target_id = $category = $results->target_id;
				$url = $results->url;
				$meta_title = trim($results->meta_title);
				$meta_description = trim($results->meta_description);
				$meta_keyword = trim($results->meta_keyword);
				$disable_meta = trim($results->disable_meta);
				$nofollow = $results->nofollow;
			}
			
			$sql = "select * from  ".$wpdb->prefix."posts where post_status = 'publish' and post_type = 'page'";
			$results = $wpdb->get_results($sql);
			$opt = array();
			$opt[] = '<option value="" selected>Selected</option>';
				for ( $i =0 ; $i< count($results); ++$i) {
				$result = $results[$i];
				//$opt[] = '<option value="'.$result->ID.'">'.$result->post_title.'</option>';
				}
			
			$sql = "select post_type from  ".$wpdb->prefix."posts where post_type not in ('attachment','revision') group by post_type ";
			$results = $wpdb->get_results($sql);
			$opt = array();
				for ( $i =0 ; $i< count($results); ++$i) {
						$result = $results[$i];
						if($target_id == $result->post_type) {
								$opt[] = '<option value="'.$result->post_type.'~post_type" selected>'.$result->post_type.' - post type </option>';		
						}else {
								$opt[] = '<option value="'.$result->post_type.'~post_type">'.$result->post_type.' - post type </option>';		
						}
						
				}
			
			$args = array(
			'type'                     => 'post',
			'child_of'                 => '',
			'parent'                   => '',
			'orderby'                  => 'name',
			'order'                    => 'ASC',
			'hide_empty'               => false,
			'exclude'                  => array(1),
			'hierarchical'             => true,
			'taxonomy'                 => 'category',
			'pad_counts'               => true );
		
			$categories = get_categories( $args );
			
			foreach($categories as $key => $cat) {
					if($cat->term_id == $category) {
							$opt[] = '<option value="'.$cat->term_id.'~cat" selected>'.$cat->name.'</option>';
					}else  {
							$opt[] = '<option value="'.$cat->term_id.'~cat">'.$cat->name.'</option>';
					}
			}
			
			if($category > 0 ) {
			
				$args = array(
						'numberposts'     => -1,
						'offset'          => 0,
						'category'        => $category,
						'orderby'         => 'post_date',
						'order'           => 'DESC',
						'post_type'       => 'post',
						'post_status'     => 'publish' );
					$posts_array = get_posts( $args );
			}
			
			
			$checked = get_option( "ccpo_category_ordering_".$category );
			
		$this->fblike();
		print '<div class="wrap">
			<h2>Manage urls and meta data</h2><fieldset>
			<a href="#list">Goto List</a>
			<form method="post">';
			wp_nonce_field('update-options');
			
				print '
				<input type="hidden" name="id" value="'.$id.'">
				<table class="form-table" style="border:1px solid #cccccc;">
				<tr valign="top">
				<th scope="row">Select Category:</th>
				<td><select name="category" id="category">'.implode("",$opt).'</select></td>
				</tr>';
				
				print '<th scope="row">Enter Url:</th>
				<td>'.home_url().'/<input type="text" name="url" size="40" value="'.$url.'"><br>Example:portfolio/web.html</td>
				</tr>';
				print '<th scope="row">Sanitize Url:</th>
				<td><input type="checkbox" name="sanitize" value="1" ></td>
				</tr>';
				
				print '<th scope="row">Meta Title:</th>
				<td><input type="text" name="meta_title" size="40" value="'.$meta_title.'"></td>
				</tr>';
				
				print '<th scope="row">Meta Description:</th>
				<td><textarea name="meta_description" rows="3" cols="50">'.$meta_description.'</textarea></td>
				</tr>';
				
				print '<th scope="row">Meta Keywords:</th>
				<td><textarea name="meta_keyword" rows="3" cols="50">'.$meta_keyword.'</textarea></td>
				</tr>';
				
				$checked = ($disable_meta == 1) ? 'checked' : '';
				print '<th scope="row">Disable Metainfo:</th>
				<td><input type="checkbox" name="disable_meta" value="1" '.$checked.'></td>
				</tr>';
				
				$checked = ($nofollow == 1) ? 'checked' : '';
				print '<th scope="row">Search Engine No Follow for this page:</th>
				<td><input type="checkbox" name="nofollow" value="1" '.$checked.'></td>
				</tr>';
				
				print '<tr valign="top"><td>
				<input type="submit" class="button" value="Save" class="button-primary" />
				</td></tr>
				</table></form></fieldset>';
				
				$results = $wpdb->get_results("select * from wp_prettyurls order by url asc");
				$html = '<br>';
				$html .= '<div id="list"></div>';
				$html .= '	<table class="form-table" style="border:1px solid #cccccc;">';
				$html .= '<tr style="border-bottom:1px solid #cccccc;"><td><b>Name</b></td><td><b>Type</b></td><td><b>Url</b></td></tr>';
				$class = array('background:#CCCCCC;','background:#FFFFFF');
				foreach($results as $key => $row) {
						$name = "";
						if($row->target_type == 'cat') {
								$cat =  get_category( $row->target_id);
								$name = $cat->name;
								$edit = '<a href="admin.php?page=prettyurls&act=edit&id='.$row->id.'">Edit</a>&nbsp;|&nbsp;<a href="admin.php?page=prettyurls&act=delete&id='.$row->id.'">Delete</a>';
						}else if($row->target_type == 'post' or $row->target_type == 'page') {
								$name =  $wpdb->get_var("select post_title from ".$wpdb->prefix."posts where ID ='$row->target_id'");
								$edit = '<a href="post.php?post='.$row->target_id.'&action=edit">Edit</a>';
						}else {
								$name =  $row->target_id;
						  $edit = '<a href="admin.php?page=prettyurls&act=edit&id='.$row->id.'">Edit</a>&nbsp;|&nbsp;<a href="admin.php?page=prettyurls&act=delete&id='.$row->id.'">Delete</a>';
						}
						$odd = ($odd == 0) ? 1 : 0;
					$html .= '<tr style="'.$class[$odd].'">';
					$html .= '<td>'.$name.'</td>';
					$html .= '<td>'.$row->target_type.'</td>';
					$html .= '<td>'.$row->url.'</td>';
					$html .= '<td>'.$edit.'</td>';
					$html .= '</tr>';
				}
				
				$html .= '</table>';
				print $html;
				print '<input type="hidden" name="action" value="update" />
				</form>
				</div><br>Note:- Goto to <a href="options-permalink.php">Permalink Settings</a> and press Save Changes in order to effect any url<br/>For Post and page goto individual edit page and put url in prettyurl box.<br>For support email at faaiqsj@gmail.com';
		}
		
		
		function pretty_redirect($url) {
				?>
		<script>
			location.href = "<?php print $url;?>";
		</script>
				<?php
		}
		
		
		
		function bwp_cancel_redirect_canonical($redirect_url) {
				
						return false;
		}
		
		
		// Adding a new rewrite rule
		function bwp_insertrules($rules) {
				global $wpdb;
				$result = $wpdb->get_results("select * from ".$wpdb->prefix."prettyurls where url != ''");
				$newrules = array();
				for($i =0; $i < count($result); ++$i) {
						$url = $result[$i]->url;
						$url = str_replace("/",".",$url);
						$url_arr = explode("/",$url);
						
						if($result[$i]->target_type == 'cat') {
								
								$newrules[$url.'$'] = 'index.php?cat='.$result[$i]->target_id;
								$newrules[$url.'/page/(.*)$'] = 'index.php?cat='.$result[$i]->target_id.'&paged=$matches[1]';
								
						}else if($result[$i]->target_type == 'post') {
								
								$newrules[$url.'$'] = 'index.php?p='.$result[$i]->target_id;
								
								
						}else if($result[$i]->target_type == 'page') {
								
								$newrules[$url.'$'] = 'index.php?page_id='.$result[$i]->target_id;
								
								
						}else if($result[$i]->target_type == 'post_type') {
								
								$newrules[$url.'$'] = 'index.php?post_type='.$result[$i]->target_id;
								$newrules[$url.'/page/(.*)$'] = 'index.php?post_type='.$result[$i]->target_id.'&paged=$matches[1]';
								
						}else {
								$total = $wpdb->get_var("select count(*) from ".$wpdb->prefix."posts where post_type = '".$result[$i]->target_type."'");
								if($total > 0) {
										$name = $wpdb->get_var("select post_name from ".$wpdb->prefix."posts where ID = '".$result[$i]->target_id."'");
										$newrules[$url.'$'] = 'index.php?'.$result[$i]->target_type.'='.$name;
								}
						}
						
						//?acesblty=iclicker-go
				}
				return $newrules + $rules;
		}
		
		
		//add_filter('query_vars', 'bwp_insertqv');
		// Tell WordPress to accept our 'fake_page' query variable
		function bwp_insertqv($vars) {
			array_push($vars, 'fake_page');
			return $vars;
		}
		
		function my_get_category_link($category_slug) {
				global $wpdb;
				$baseurl = get_bloginfo('url');
				$row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where category_slug = '$category_slug'");
				return $baseurl."/".$row->url;
		}
		
		//meta box code
		
		
		
		/* Adds a box to the main column on the Post and Page edit screens */
		function myplugin_add_custom_box() {
						add_meta_box( 'prettyurl_metaboxid',  __( 'Custom Url & Page	Meta Data', 'prettyurl_textdomain' ),  array($this,'prettyurl_inner_custom_box'));
				
		}
		
		/* Prints the box content */
		function prettyurl_inner_custom_box( $post ) {
				global $wpdb;
				
				$row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where target_id = '$post->ID'");
				
				$url = $row->url;
				$meta_title = trim($row->meta_title);
				$meta_description = trim($row->meta_description);
				$meta_keyword = trim($row->meta_keyword);
				$disable_meta = trim($row->disable_meta);
				$nofollow = $row->nofollow;
				
				// Use nonce for verification
				wp_nonce_field( plugin_basename( __FILE__ ), 'prettyurl_noncename' );
		
				// The actual fields for data entry
				echo '<label for="myplugin_new_field">';
									_e("Enter custom Url for this post", 'prettyurl_textdomain' );
				echo '</label> ';
				echo '<input type="text" id="prettyurl_post_url" name="prettyurl_post_url" value="'.$url.'" size="50" />';
				print '<br><small>Example: if you need url like http://www.example.com/products.html then enter only products.html</small>';
				print '<table width="100%">';
				print '<td scope="row">Sanitize Url:</td>
				<td><input type="checkbox" name="sanitize" value="1" ></td>
				</tr>';
				
				print '<td scope="row">Meta Title:</td>
				<td><input type="text" name="meta_title" size="40" value="'.$meta_title.'"></td>
				</tr>';
				
				print '<td scope="row">Meta Description:</td>
				<td><textarea name="meta_description" rows="3" cols="50">'.$meta_description.'</textarea></td>
				</tr>';
				
				print '<td scope="row">Meta Keywords:</td>
				<td><textarea name="meta_keyword" rows="3" cols="50">'.$meta_keyword.'</textarea></td>
				</tr>';
				
				$checked = ($disable_meta == 1) ? 'checked' : '';
				print '<td scope="row">Disable Metainfo:</td>
				<td><input type="checkbox" name="disable_meta" value="1" '.$checked.'></td>
				</tr>';
				
				$checked = ($nofollow == 1) ? 'checked' : '';
				print '<td scope="row">Search Engine No Follow for this page:</td>
				<td><input type="checkbox" name="nofollow" value="1" '.$checked.'></td>
				</tr></table>';
		}
		
		/* When the post is saved, saves our custom data */
		function prettyurl_save_postdata( $post_id ) {
				// verify if this is an auto save routine. 
				// If it is our form has not been submitted, so we dont want to do anything
			
				if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
								return;
		
				// verify this came from the our screen and with proper authorization,
				// because save_post can be triggered at other times
		
				if ( !wp_verify_nonce( $_POST['prettyurl_noncename'], plugin_basename( __FILE__ ) ) )
								return;
				
				// Check permissions
				if ( 'page' == $_POST['post_type'] ) {
						if ( !current_user_can( 'edit_page', $post_id ) )
										return;
				}
				else{
						if ( !current_user_can( 'edit_post', $post_id ) )
										return;
				}
		
				// OK, we're authenticated: we need to find and save the data
				global $wpdb;
				$post_row = $wpdb->get_row("select post_status,post_type from ".$wpdb->prefix."posts where ID = '$post_id'");
				$post_status = $post_row->post_status;
				$post_type = $post_row->post_type;
				
				if($post_status == 'publish') {
						$url = trim($_POST['prettyurl_post_url']);
						$meta_title = trim($_POST['meta_title']);
						$meta_description = trim($_POST['meta_description']);
						$meta_keyword = trim($_POST['meta_keyword']);
						$disable_meta = trim($_POST['disable_meta']);
						$nofollow = $_POST['nofollow'];
						$sanitize = $_POST['sanitize'];
						if($sanitize == 1) {
							$url = sanitize_title($url);
						}
						
						$data = array();
						$data[] = "target_id = '$post_id'";
						$data[] = "target_type = '$post_type'";
						$data[] = "url = '$url'";
						$data[] = "meta_title	 = '$meta_title'";
						$data[] = "meta_description	 = '$meta_description'";
						$data[] = "meta_keyword	 = '$meta_keyword'";
						$data[] = "disable_meta	 = '$disable_meta'";
						$data[] = "nofollow	 = '$nofollow'";
						
						$row = $wpdb->get_row("select * from wp_prettyurls where target_id ='$post_id'");
						
						if($row->id > 0 ) {
								if($url != "") {
												if($this->url_exists($url)) {
														if($this->match_url($url,$row->id)) {
																$wpdb->query("update ".$wpdb->prefix."prettyurls SET ".implode(",",$data)." where id = '$row->id'");		
														}
												}else {
																$wpdb->query("update ".$wpdb->prefix."prettyurls SET ".implode(",",$data)." where id = '$row->id'");		
												}
								}else {
										$wpdb->query("delete from  ".$wpdb->prefix."prettyurls where id = '$row->id'");
								}
						}else {
								if($url != "" and $this->url_exists($url) == false) {
										$wpdb->query("insert into  ".$wpdb->prefix."prettyurls set ".implode(",",$data));
								}
						}		
				}
		}
		
		function url_exists($url) {
		 global $wpdb;
				$id = $wpdb->get_var("select id from ".$wpdb->prefix."prettyurls where url = '$url'");
				if($id > 0) {
						return $id;
				}else {
						return false;
				}
		}
		
		function match_url($url,$id) {
		 global $wpdb;
				$id = $wpdb->get_var("select id from ".$wpdb->prefix."prettyurls where url = '$url' and id ='$id'");
				if($id > 0) {
						return $id;
				}else {
						return false;
				}
		}
		
		function post_type_link($permalink, $post) {
				global $wpdb;
				
				if(is_admin()) {
						return $permalink;
				}
				$post_id = $post->ID;
				$post_type = $post->post_type;
				
				$row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where target_id='$post_id' and target_type = '$post_type'");
				if($row->url) {
						return home_url($row->url);		
				}else {
						return $permalink;		
				}
		}
		
		function prettyurl_post_link($permalink, $post, $leavename) {
				global $wpdb;
				
				if(is_admin()) {
						return $permalink;
				}
				$post_id = $post->ID;
				$post_type = $post->post_type;
				
				$row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where target_id='$post_id' and target_type = '$post_type'");
				if($row->url) {
						return home_url($row->url);		
				}else {
						return $permalink;		
				}
		}
		
		
		
		function prettyurl_category_link($termlink, $term, $taxonomy) {
				if(is_admin()) {
						return $termlink;
				}
				global $wpdb;
				$row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where target_id = '$term->term_id' and target_type = 'cat'");
				if($row) {
						$baseurl = get_bloginfo('url');
						return home_url($row->url);
						
				}else {
						return $termlink;		
				}
		}
		
		function prettyurl_page_link($link, $id, $sample) {
				global $wpdb;
				if(is_admin()) {
						return $link;
				}
				$post_id = $id;
				$row = $wpdb->get_row("select * from ".$wpdb->prefix."prettyurls where target_id='$post_id' and target_type in('page')");
				if($row->url) {
							return home_url($row->url);
				}else {
					return $link;
				}
		}
		function fblike() {
				?>
						Help Us, Like Us <div class="fb-like" data-href="http://www.facebook.com/pages/Wordpress-Expert/105504792973227" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>
				<?php
		}
		
  function add_style() {

   $this->add_fb_like();
  }
  function add_fb_like() {
   ?>
				<div id="fb-root"></div>
				<script>(function(d, s, id) {
				var js, fjs = d.getElementsByTagName(s)[0];
				if (d.getElementById(id)) return;
				js = d.createElement(s); js.id = id;
				js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1";
				fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));</script>
				<?php
  }
}

new pretty_url();