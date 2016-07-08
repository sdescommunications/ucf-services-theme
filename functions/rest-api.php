<?php
/**
 * Routes for the WordPress REST API.
 *
 * @see http://v2.wp-api.org
 * @see https://developer.wordpress.com/docs/api/
 */
namespace SDES\ServicesTheme\API;

require_once( get_stylesheet_directory() . '/custom-posttypes.php' );
	use SDES\ServicesTheme\PostTypes\StudentService as StudentService;

const SEARCH_FILTER_SERVICES = 'services';

/**
 * @see https://developer.wordpress.org/reference/hooks/rest_api_init/ WP-Ref: rest_api_init hook
 * @see https://developer.wordpress.org/reference/functions/register_rest_route/ WP-Ref: register_rest_route()
 */
function register_routes() {
	//register_rest_route( string $namespace, string $route, array $args = array(), bool $override = false );

	// ~/wp-json/rest/v1/services
	register_rest_route( 'rest/v1', '/services/', array(
		'methods'  => 'GET',
		'callback' => __NAMESPACE__ . '\route_services'
	) );

	// ~/wp-json/rest/v1/services/{id}
	register_rest_route( 'rest/v1', '/services/(?P<id>\d+)', array(
		'methods'  => 'GET',
		'callback' => __NAMESPACE__ . '\route_services_id'
	) );

	// ~/wp-json/rest/v1/services/search/
	register_rest_route( 'rest/v1', '/services/search/', array(
		'methods'  => 'GET',
		'callback' => __NAMESPACE__ . '\route_services_search'
	) );

	// ~/wp-json/rest/v1/services/search/{rest_query}
	register_rest_route( 'rest/v1', '/services/search/(?P<rest_query>\w+)', array(
		'methods'  => 'GET',
		'callback' => __NAMESPACE__ . '\route_services_search'
	) );
	
	// TODO: add REST routes for active campaigns.
	// ~/wp-json/rest/v1/campaign
	// ~/wp-json/rest/v1/campaign/{id}
	// ~/wp-json/rest/v1/campaign/search/
	// ~/wp-json/rest/v1/campaign/search/{rest_query}
}
add_action( 'rest_api_init', __NAMESPACE__ . '\register_routes');


/**
 *  Handle a JSON request, return an object to be converted to JSON by WordPress.
 *  @see https://developer.wordpress.org/reference/classes/wp_rest_request/ WP-Ref: WP_REST_Request class
 */
function route_services( $request ) {
	// die( print_r( $request ) );
	$posts = get_posts( array(
		'post_type' => StudentService::NAME,
		'post_per_page' => -1,
		'orderby' => 'modified',
		'order' => 'DESC',
	) );
	if ( empty( $posts ) ) {
		return null;
	}
	$retval = null;
	foreach ( $posts as $post ) {
		$retval[] = StudentService::get_render_context_from_post( $post );
	}
	return $retval;
}


function route_services_id( $request ) {
	return StudentService::get_render_context_from_post( $request->get_param( 'id' ) );
}

/**
 * Enable querying student_service terms and metadata.
 * Filter applies to any WP_Query when to the parameter 'ucf_search_filter' is set to SEARCH_FILTER_SERVICES.
 */
function ucf_search_filter_services( $search, &$wp_query ) {
	if (
		isset( $wp_query->query_vars['ucf_search_filter'] )
		&& $wp_query->query_vars['ucf_search_filter'] === SEARCH_FILTER_SERVICES
		&& isset( $wp_query->query_vars['rest_query'] )
		&& !empty( $wp_query->query_vars['rest_query'] )
		&& isset( $wp_query->query_vars['post_type'] )
	) {
		global $wpdb;
		if ( empty( $search ) ) {
			return $search;
		}
		$prefix = StudentService::NAME . '_';
		$search_term = '%'.$wpdb->esc_like( $wp_query->query_vars[ 'rest_query' ] ).'%';
		$search .= $wpdb->prepare( " AND (
			($wpdb->posts.post_title LIKE %s) /* Title (query post object itself) */
			OR EXISTS
			(	/* Categories and Tags (query related terms in these taxonomies). */
				SELECT * FROM $wpdb->terms
				INNER JOIN $wpdb->term_taxonomy
					ON $wpdb->term_taxonomy.term_id = $wpdb->terms.term_id
				INNER JOIN $wpdb->term_relationships
					ON $wpdb->term_relationships.term_taxonomy_id = $wpdb->term_taxonomy.term_taxonomy_id
				WHERE object_id = $wpdb->posts.ID
					AND ( /* Search associated taxonomies: */
						taxonomy = 'category' 
						OR taxonomy = 'post_tag'
					)
					AND $wpdb->terms.name LIKE %s
			)
			OR EXISTS
			(	/* short_descr (query related metadata) */
				SELECT * FROM $wpdb->postmeta
				WHERE post_id = $wpdb->posts.ID
					AND ( /* Search associated meta keys: */
						meta_key = '{$prefix}short_description'
						OR meta_key = '{$prefix}heading_text'
					)
					AND meta_value LIKE %s
			)
			OR ($wpdb->posts.post_content LIKE %s) /* Long_descr */
		)", $search_term, $search_term, $search_term, $search_term);
		$search = strtr( $search, array( "\r\n" => " ", "\t" => ' ') ); // Prettier print.
	}
	return $search;
}
add_filter( 'posts_where', __NAMESPACE__ . '\ucf_search_filter_services', 500, 2 );


function route_services_search( $request ) {
	$args = array(
		'post_status' => array('publish'),
		'post_type' => StudentService::NAME,
		'post_per_page' => -1,
		'rest_query' => $request->get_param( 'rest_query' ),
		'ucf_search_filter' => SEARCH_FILTER_SERVICES,
		'orderby' => 'title',
		'order' => 'ASC',
	);
	$services = new \WP_Query( $args );
	if ( empty( $services ) ) {
		return null;
	}
	$retval = null;
	global $post;
	while ( $services->have_posts() ) {
		$services->the_post();
		$retval[] = StudentService::get_render_context_from_post( $post );
	}
	wp_reset_postdata();
	return $retval;
}
