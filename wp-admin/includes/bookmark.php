		if ( false === $wpdb->update( $wpdb->links, compact( 'link_url', 'link_name', 'link_image', 'link_target', 'link_description', 'link_visible', 'link_rating', 'link_rel', 'link_notes', 'link_rss' ), compact( 'link_id' ) ) ) {
			if ( $wp_error ) {
				return new WP_Error( 'db_update_error', __( 'Could not update link in the database' ), $wpdb->last_error );
			} else {
				return 0;
			}
		}
	} else {
		if ( false === $wpdb->insert( $wpdb->links, compact( 'link_url', 'link_name', 'link_image', 'link_target', 'link_description', 'link_visible', 'link_owner', 'link_rating', 'link_rel', 'link_notes', 'link_rss' ) ) ) {
			if ( $wp_error ) {
				return new WP_Error( 'db_insert_error', __( 'Could not insert link into the database' ), $wpdb->last_error );
			} else {
				return 0;
			}
		}
		$link_id = (int) $wpdb->insert_id;
	}

	wp_set_link_cats( $link_id, $link_category );

	if ( $update ) {
		/**
		 * Fires after a link was updated in the database.
		 *
		 * @since 2.0.0
		 *
		 * @param int $link_id ID of the link that was updated.
		 */
		do_action( 'edit_link', $link_id );
	} else {
		/**
		 * Fires after a link was added to the database.
		 *
		 * @since 2.0.0
		 *
		 * @param int $link_id ID of the link that was added.
		 */
		do_action( 'add_link', $link_id );
	}
	clean_bookmark_cache( $link_id );

	return $link_id;
}

/**
 * Update link with the specified link categories.
 *
 * @since 2.1.0
 *
 * @param int   $link_id         ID of the link to update.
 * @param int[] $link_categories Array of link category IDs to add the link to.
 */
function wp_set_link_cats( $link_id = 0, $link_categories = array() ) {
	// If $link_categories isn't already an array, make it one:
	if ( ! is_array( $link_categories ) || 0 == count( $link_categories ) ) {
		$link_categories = array( get_option( 'default_link_category' ) );
	}

	$link_categories = array_map( 'intval', $link_categories );
	$link_categories = array_unique( $link_categories );

	wp_set_object_terms( $link_id, $link_categories, 'link_category' );

	clean_bookmark_cache( $link_id );
}

/**
 * Updates a link in the database.
 *
 * @since 2.0.0
 *
 * @param array $linkdata Link data to update.
 * @return int|WP_Error Value 0 or WP_Error on failure. The updated link ID on success.
 */
function wp_update_link( $linkdata ) {
	$link_id = (int) $linkdata['link_id'];

	$link = get_bookmark( $link_id, ARRAY_A );

	// Escape data pulled from DB.
	$link = wp_slash( $link );

	// Passed link category list overwrites existing category list if not empty.
	if ( isset( $linkdata['link_category'] ) && is_array( $linkdata['link_category'] ) && 0 != count( $linkdata['link_category'] ) ) {
		$link_cats = $linkdata['link_category'];
	} else {
		$link_cats = $link['link_category'];
	}

	// Merge old and new fields with new fields overwriting old ones.
	$linkdata                  = array_merge( $link, $linkdata );
	$linkdata['link_category'] = $link_cats;

	return wp_insert_link( $linkdata );
}

/**
 * Outputs the 'disabled' message for the WordPress Link Manager.
 *
 * @since 3.5.0
 * @access private
 *
 * @global string $pagenow
 */
function wp_link_manager_disabled_message() {
	global $pagenow;
	if ( 'link-manager.php' != $pagenow && 'link-add.php' != $pagenow && 'link.php' != $pagenow ) {
		return;
	}

	add_filter( 'pre_option_link_manager_enabled', '__return_true', 100 );
	$really_can_manage_links = current_user_can( 'manage_links' );
	remove_filter( 'pre_option_link_manager_enabled', '__return_true', 100 );

	if ( $really_can_manage_links && current_user_can( 'install_plugins' ) ) {
		$link = network_admin_url( 'plugin-install.php?tab=search&amp;s=Link+Manager' );
		/* translators: %s: URL to install the Link Manager plugin. */
		wp_die( sprintf( __( 'If you are looking to use the link manager, please install the <a href="%s">Link Manager</a> plugin.' ), $link ) );
	}

	wp_die( __( 'Sorry, you are not allowed to edit the links for this site.' ) );
}
