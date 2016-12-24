<?php
/**
 * Plugin Name: Bulk Page Maker
 * Plugin URI: http://www.slimbobwp.com/plugins/bulk-page-maker/
 * Description: Allows user to create up to 20 pages or posts at a time, choosing title, slug, parent, template, status, format, and content via the default WordPress Editor.
 * Version: 1.1.3
 * Author: Bob Whitis
 * Author URI: http://slimbobwp.com
 * License: GPL2
 */

function bpm_register_admin_menu() {

	$page_title    =    'Bulk Add New';
	$menu_title    =    'Bulk Add New';
	$capability    =    'edit_pages';
	$menu_slug     =    'bulk-add-new-pages';
	$function      =    'bpm_admin_page';

	add_pages_page( $page_title, $menu_title, $capability, $menu_slug, $function );

	$menu_slug     =    'bulk-add-new-posts';

	add_posts_page( $page_title, $menu_title, $capability, $menu_slug, $function);
}

add_action( 'admin_menu', 'bpm_register_admin_menu' );

function bpm_admin_page() {

	$current_screen = get_current_screen();

	if( $current_screen->base == 'posts_page_bulk-add-new-posts' ) {

		$screen = 'post';

	}

	if( $current_screen->base == 'pages_page_bulk-add-new-pages' ) {

		$screen = 'page';
		
	}

	if( $screen == 'post' ) {

		if ( current_theme_supports( 'post-formats' ) ) {

		    $post_formats = get_theme_support( 'post-formats' );

		    if ( is_array( $post_formats[0] ) ) {

		        $post_formats = $post_formats[0];

		    }

		}

	}

	if( $screen == 'page' ) {

		$parents = array(

			'hierarchical'    =>    0,
			'post_status'     =>    'publish,future,draft,pending,private'

		);

		$pages = get_pages( $parents );

		$templates = get_page_templates();

	}

	$statuses = array(

		'publish'    =>    'Published',
		'future'     =>    'Scheduled',
		'draft'      =>    'Draft',
		'pending'    =>    'Pending',
		'private'    =>    'Private',

	);

	echo '<div class="wrap">';

		echo '<h1>Bulk Add New ' . ucwords( $screen ) . '</h1>';

		echo '<form method="post" action="">';

			if( isset( $_POST['bulk-add-new-' . $screen] ) ) {

				if( $_POST['bpm']['bpm_success_count'] > 1 ) {

					echo '<div id="message" class="updated notice">Successfully created ' . sanitize_text_field( (int) $_POST['bpm']['bpm_success_count'] ) . ' ' . $screen . 's!</div>';
				
				} else {

					echo '<div id="message" class="updated notice">Successfully created ' . sanitize_text_field( (int) $_POST['bpm']['bpm_success_count'] ) . ' ' . $screen . '!</div>';
				
				}

			}

			echo '<div id="poststuff">';

				echo '<h2><label for="bpm_new_' . $screen . '_content">Default Content</label></h2>';

				echo '<div id="postdivrich" class="postarea wp-editor-expand">';

					$lorem_ipsum_text = "Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam laoreet erat eu nisl congue, eu scelerisque justo cursus. Sed vitae enim feugiat, consequat justo suscipit, bibendum sem. Nam euismod nisi tortor, eget tristique sapien congue bibendum. Suspendisse fringilla enim quis dolor tincidunt, et elementum nisl rhoncus. Suspendisse mattis dui ex, ut ultrices risus scelerisque tincidunt. Nunc lectus nisl, tincidunt sed condimentum vel, hendrerit at mi. Aliquam in nunc lacinia ante placerat bibendum a sed tortor.

Maecenas ornare ligula id dolor tempus, a ultrices justo pharetra. Morbi convallis, mauris et vestibulum dictum, nisl tortor molestie purus, vitae commodo nisi orci aliquet justo. Mauris a volutpat nisl. Vestibulum auctor, leo a pulvinar euismod, purus nibh porttitor nunc, nec volutpat leo orci quis mauris. Nam nunc tellus, pharetra vel nisi at, hendrerit bibendum sem. Aenean condimentum vulputate metus eu semper. Maecenas porta sapien a lorem volutpat sodales. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Donec mattis dictum venenatis.";
					
					wp_editor( esc_textarea( $lorem_ipsum_text ), 'bpm_new_' . $screen . '_content', $settings = array( 'textarea_rows' => '10' ) );
				
				echo '</div>';

				echo '<table class="form-table">';

					echo '<tbody>';

						echo '<tr>';

							echo '<th scope="row">Title</th>';

							echo '<th scope="row">Slug (Optional)</th>';

							if( $screen == 'page' ) {

								echo '<th scope="row">Parent</th>';

								echo '<th scope="row">Template</th>';

							}

							if( $screen == 'post' ) {

								echo '<th scope="row">Format</th>';

							}

							echo '<th scope="row">Status</th>';

						echo '</tr>';

						for( $x = 0; $x < 20; $x++ ) {

							echo '<tr>';

								echo '<td><input class="regular-text ltr" type="text" name="bpm[' . $x . '][new_' . $screen . '_title]" id="bpm[' . $x . '][new_' . $screen . '_title]" /></td>';
								
								echo '<td><input class="regular-text ltr" type="text" name="bpm[' . $x . '][new_' . $screen . '_slug]" id="bpm[' . $x . '][new_' . $screen . '_slug]" /></td>';
								
								if( $screen == 'page' ) {

									echo '<td><select name="bpm[' . $x . '][new_page_parent]" id="bpm[' . $x . '][new_page_parent]">';
										
										echo '<option value="0">None</option>';
										
										foreach( $pages as $page ) {
											
											echo '<option value="' . $page->ID . '">' . $page->post_title . '</option>';
										
										}
									
									echo '</select></td>';
									
									echo '<td><select name="bpm[' . $x . '][new_page_template]" id="bpm[' . $x . '][new_page_template]">';
										
										echo '<option value="0">Default</option>';
										
										foreach( $templates as $template => $filename ) {
											
											echo '<option value="' . $filename . '">' . $template . '</option>';
										
										}

									echo '</select></td>';

								}

								if( $screen == 'post' ) {

									echo '<td><select name="bpm[' . $x . '][new_post_format]" id="bpm[' . $x . '][new_post_format]">';

										echo '<option value="0">Default</option>';

										foreach( $post_formats as $post_format ) {

											echo '<option value="' . $post_format . '">' . ucwords( $post_format ) . '</option>';

										}

									echo '</select></td>';

								}
								
								echo '<td><select name="bpm[' . $x . '][new_' . $screen . '_status]" id="bpm[' . $x . '][new_' . $screen . '_status]">';
									
									foreach( $statuses as $status => $name ) {
										
										echo '<option value="' . $status . '">' . $name . '</option>';
									
									}
								
								echo '</select></td>';
								
								echo '<input type="hidden" name="bulk-add-new-' . $screen . '" id="bulk-add-new-' . $screen . '" value="true" />';
							
							echo '</tr>';

						}

					echo '</tbody>';

				echo '</table>';

				submit_button( 'Bulk Publish' );

			echo '</div>';

		echo '</form>';

	echo '</div>';

}

function bpm_bulk_insert() {

	if( isset( $_POST['bulk-add-new-post'] ) ) {

		$screen = 'post';

	}

	if( isset( $_POST['bulk-add-new-page'] ) ) {

		$screen = 'page';

	}

	if( isset( $_POST['bulk-add-new-post'] ) || isset( $_POST['bulk-add-new-page'] ) ) {

		$bpm_success_count = 0;

		if( $screen == 'page' ) {

			$bpm_new_page = array(

				'post_title'       =>    '',
				'post_name'        =>    '',
				'post_status'      =>    '',
				'post_content'     =>    '',
				'post_type'        =>    'page',
				'post_parent'      =>    '0',
				'page_template'    =>    '',

			);

		}

		if( $screen == 'post' ) {

			$bpm_new_post = array(

				'post_title'      =>    '',
				'post_name'       =>    '',
				'post_status'     =>    '',
				'post_content'    =>    '',
				'post_type'       =>    'post',
				'post_format'     =>    '',

			);

		}

		for( $x = 0; $x < 20; $x++ ) {

			if( $_POST['bpm'][$x]['new_' . $screen . '_title'] != '' ) {

				if( $screen == 'page' ) {

					$bpm_new_page['post_title']       =    sanitize_text_field( $_POST['bpm'][$x]['new_page_title'] );
					$bpm_new_page['post_name']        =    sanitize_text_field( $_POST['bpm'][$x]['new_page_slug'] );
					$bpm_new_page['post_parent']      =    sanitize_text_field( $_POST['bpm'][$x]['new_page_parent'] );
					$bpm_new_page['page_template']    =    sanitize_text_field( $_POST['bpm'][$x]['new_page_template'] );
					$bpm_new_page['post_status']      =    sanitize_text_field( $_POST['bpm'][$x]['new_post_status'] );
					$bpm_new_page['post_content']     =    wp_kses_post( $_POST['bpm_new_page_content'] );

					if( wp_insert_post( $bpm_new_page ) ) {

						$bpm_success_count++;

					}

				}

				if( $screen == 'post' ) {

					$bpm_new_post['post_title']       =    sanitize_text_field( $_POST['bpm'][$x]['new_post_title'] );
					$bpm_new_post['post_name']        =    sanitize_text_field( $_POST['bpm'][$x]['new_post_slug'] );
					$bpm_new_post['post_format']      =    sanitize_text_field( $_POST['bpm'][$x]['new_post_format'] );
					$bpm_new_post['post_status']      =    sanitize_text_field( $_POST['bpm'][$x]['new_post_status'] );
					$bpm_new_post['post_content']     =    wp_kses_post( $_POST['bpm_new_post_content'] );

					$bpm_new_post_id = wp_insert_post( $bpm_new_post );

					if( $bpm_new_post_id != 0 ) {

						$bpm_success_count++;

						set_post_format( $bpm_new_post_id , $bpm_new_post['post_format'] );

					}

				}

			}

		}

		$_POST['bpm']['bpm_success_count'] = $bpm_success_count;

	}

}

add_action( 'wp_loaded','bpm_bulk_insert' );
 
?>