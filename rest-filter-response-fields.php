<?php
/*
 Plugin Name: REST Filter Response Fields
 Plugin URI: http://wordpress.org/extend/plugins/rest-filter-response-fields/
 Description: Specify fields for the response JSON. See https://core.trac.wordpress.org/ticket/38131.
 Author: adamsilverstein, kadamwhite, rmccue.
 Version: 1.0.0
 Author URI: http://wordpress.org/
 */



/**
* Filter the API response to include only a white-listed set of response object fields.
*
* @since 4.8.0
*
* @param WP_REST_Response $response Current response being served.
* @param WP_REST_Server   $server   ResponseHandler instance (usually WP_REST_Server).
* @param WP_REST_Request  $request  The request that was used to make current response.
*
* @return WP_REST_Response Response to be served, trimmed down to contain a subset of fields.
*/
function rest_filter_response_fields( $response, $server, $request ) {
	if ( ! isset( $request['_fields'] ) || $response->is_error() ) {
		return $response;
	}

	$data = $response->get_data();

	$fields = (array) explode( ',', $request['_fields'] );

	if ( 0 === count( $fields ) ) {
		return $response;
	}

	// Trim off outside whitespace from the comma delimited list.
	$fields = array_map( 'trim', $fields );

	$fields_as_keyed = array_combine( $fields, array_fill( 0, count( $fields ), true ) );

	if ( wp_is_numeric_array( $data ) ) {
		$new_data = array();
		foreach ( $data as $item ) {
				$new_data[] = array_intersect_key( $item, $fields_as_keyed );
		}
	} else {
		$new_data = array_intersect_key( $data, $fields_as_keyed );
	}

	$response->set_data( $new_data );

	return $response;
}

add_filter( 'rest_post_dispatch', 'rest_filter_response_fields', 10, 3 );
