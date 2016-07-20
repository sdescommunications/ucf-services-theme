<?php
/**
 * Routes for the WordPress REST API.
 * Implement a REpresentationl State Transfer (REST) architecture from this file.
 * For an overview of REST architecture, see: http://www.slideshare.net/apigee/restful-api-design-second-edition/102
 *  (and video: https://apigee.com/about/resources/webcasts/restful-api-design-second-edition)
 *
 * @see http://v2.wp-api.org
 * @see https://developer.wordpress.com/docs/api/
 */
namespace SDES\ServicesTheme\API;

require_once( get_stylesheet_directory() . '/custom-posttypes.php' );
	use SDES\ServicesTheme\PostTypes\StudentService as StudentService;

// Use abstract class as an "Enum" of custom search filters.
abstract class UCF_SEARCH_FILTER {
	const SERVICES = 'services';
}

/**
 * @see https://developer.wordpress.org/reference/hooks/rest_api_init/ WP-Ref: rest_api_init hook
 * @see https://developer.wordpress.org/reference/functions/register_rest_route/ WP-Ref: register_rest_route()
 * @link http://www.regular-expressions.info/named.html Regular expression named capturing groups.
 */
function register_routes() {
	//register_rest_route( string $namespace, string $route, array $args = array(), bool $override = false );

	// ~/wp-json/rest/v1/services
	register_rest_route( 'rest/v1', '/services/', array(
		'methods'  => 'GET',
		'callback' => __NAMESPACE__ . '\route_services',
		'args' => array(
			'search' => array(),
			'slug' => array(),
		),
	) );

	// TODO: add to regex `[\w-]` to allow any character allowed in slugs.
	// ~/wp-json/rest/v1/services/{slug}
	register_rest_route( 'rest/v1', '/services/(?P<slug>[\w-]+)', array(
		'methods'  => 'GET',
		'callback' => __NAMESPACE__ . '\route_services_slug',
	) );
	// TODO: add more granular routes with subsets of the data (e.g., /services/{slug}/hours).
	
	// TODO: add REST routes for active campaigns.
	// ~/wp-json/rest/v1/campaigns
	// ~/wp-json/rest/v1/campaigns/{slug}
}
add_action( 'rest_api_init', __NAMESPACE__ . '\register_routes');


/**
 * ~/wp-json/rest/v1/services/{slug}
 * @see https://codex.wordpress.org/Function_Reference/get_page_by_path WP-Codex:get_page_by_path()
 */ 
function route_services_slug( $request ) {
	if ( null === $request ) { $request = new \WP_REST_Request(); }
	$post = \get_page_by_path( $request->get_param( 'slug' ), OBJECT, 'student_service' );
	return StudentService::get_render_context_from_post( $post );
}

/**
 * ~/wp-json/rest/v1/services
 * Handle a JSON request, return an object to be converted to JSON by WordPress.
 * @see https://developer.wordpress.org/reference/classes/wp_rest_request/ WP-Ref: WP_REST_Request class
 * @see http://codex.wordpress.org/Class_Reference/WP_Query WP-Codex: WP_Query
 */
function route_services( $request ) {
	// die( print_r( $request ) );
	if ( null === $request ) { $request = new \WP_REST_Request(); }
	// Build WP Query based on request.
	// /rest/v1/services/
	$args = array(
		'post_type' => StudentService::NAME,
		'post_status' => array('publish'),
		'posts_per_page' => -1,  // TODO: determine reasonable limit, implement pagination.
		'orderby' => 'title',
		'order' => 'ASC',
	);

	// TODO: Make and merge multiple WP_Query statements instead of calling $wpdb. $query_search $query_tax $query_meta

	// ?search=&s= // Set to 'search' if both are present.
	if ( $request->get_param( 'search' ) || $request->get_param( 's' ) ) {
		$search_term = $request->get_param( 'search' ) ?: $request->get_param( 's' );
		$args = array_merge( $args, array(
			'ucf_search_filter' => UCF_SEARCH_FILTER::SERVICES,
			'ucf_query_services' => $search_term,
		) );
	}
	// ?name=&slug=  // Set to 'name' if both are present.
	if ( $request->get_param( 'name' ) || $request->get_param( 'slug' ) ) {
		$name = $request->get_param( 'name' ) ?: $request->get_param( 'slug' );
		$args = array_merge( $args, array(
			'name' => $name,
		) );
	}
	// ?id=
	if ( $request->get_param( 'id' ) ) {
		$args = array_merge( $args, array(
			'p' => $request->get_param( 'id' ),
		) );
	}
	// ?limit=
	if ( $request->get_param( 'limit' ) ) {
		$args = array_merge( $args, array(
			'posts_per_page' => $request->get_param( 'limit' ),
		) );
	}
	$services = new \WP_Query( $args );
	if ( empty( $services ) ) {
		return null;
	}
	// Loop through queried posts and get a render context for each matching post.
	$retval = null;
	global $post;
	while ( $services->have_posts() ) {
		$services->the_post();
		$retval[] = StudentService::get_render_context_from_post( $post );
	}
	wp_reset_postdata();
	return $retval;
}

/**
 * Enable querying student_service terms and metadata.
 * Filter applies to any WP_Query when the parameter 'ucf_search_filter' is set to constant UCF_SEARCH_FILTER::SERVICES.
 */
function ucf_search_filter_services( $search, &$wp_query ) {
	if (
		isset( $wp_query->query_vars['ucf_search_filter'] )
		&& $wp_query->query_vars['ucf_search_filter'] === UCF_SEARCH_FILTER::SERVICES
		&& isset( $wp_query->query_vars['ucf_query_services'] )
		&& !empty( $wp_query->query_vars['ucf_query_services'] )
		&& isset( $wp_query->query_vars['post_type'] )
	) {
		global $wpdb;
		if ( empty( $search ) ) {
			return $search;
		}
		$prefix = StudentService::NAME . '_';
		$search_term = '%'.$wpdb->esc_like( $wp_query->query_vars[ 'ucf_query_services' ] ).'%';
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

