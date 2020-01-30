<?php
/**
 * Plugin Name: Display Posts - Alpha View
 * Plugin URI: https://github.com/billerickson/Display-Posts-Alpha-View
 * Description: Display content broken down by the title's first letter. You must have Display Posts installed.
 * Version: 1.0.0
 * Author: Bill Erickson
 * Author URI: https://www.billerickson.net
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

class BE_DPS_Alpha_View {

	/**
	 * Primary constructor
	 *
	 */
	function __construct() {

		add_filter( 'display_posts_shortcode_args', array( $this, 'query_args' ), 10, 2 );
		add_filter( 'display_posts_shortcode_wrapper_open', array( $this, 'opening_header' ), 10, 3 );
		add_filter( 'display_posts_shortcode_wrapper_close', array( $this, 'closing_markup' ) );
		add_filter( 'display_posts_shortcode_output', array( $this, 'post_output' ), 10, 11 );
	}

	/**
	 * Query Args
	 *
	 */
	function query_args( $args, $atts ) {
		if( empty( $atts['alpha_view'] ) || ! filter_var( $atts['alpha_view'], FILTER_VALIDATE_BOOLEAN ) )
			return $args;

		$args['orderby'] = 'title';
		$args['order'] = 'ASC';
		if( empty( $atts['posts_per_page'] ) )
			$args['posts_per_page'] = -1;
		$args = apply_filters( 'display_posts_alpha_view_query_args', $args, $atts );

		return $args;
	}

	/**
	 * Opening header
	 *
	 */
	function opening_header( $markup, $atts, $listing ) {
		$markup = $this->heading( $listing->posts[0], $atts ) . $markup;
		return $markup;
	}

	/**
	 * Closing markup
	 *
	 */
	function closing_markup( $markup ) {
		global $dps_alpha_heading;
		$dps_alpha_heading = false;
		return $markup;
	}

	/**
	 * Post output
	 *
	 */
	function post_output( $output, $atts, $image, $title, $date, $excerpt, $inner_wrapper, $content, $class, $author, $category_display_text ) {

		global $post, $dps_listing;
		$heading = $this->heading( $post, $atts );
		if( empty( $heading ) || 0 == $dps_listing->current_post )
			return $output;

		$wrapper = !empty( $atts['wrapper'] ) ? $atts['wrapper'] : 'ul';
		$wrapper_class = !empty( $atts['wrapper_class'] ) ? $atts['wrapper_class'] : 'display-posts-listing';
		$output = '</' . $wrapper . '>' . $heading . '<' . $wrapper . ' class="' . $wrapper_class . '">' . $output;
		return $output;
	}

	/**
	 * Heading
	 *
	 */
	function heading( $post, $atts ) {

		if( empty( $post ) || is_wp_error( $post ) )
			return;

		if( empty( $atts['alpha_view'] ) || ! filter_var( $atts['alpha_view'], FILTER_VALIDATE_BOOLEAN ) )
			return;

		global $dps_alpha_heading;
		$letter = substr( get_the_title( $post->ID ), 0, 1 );
		if( $letter !== $dps_alpha_heading ) {
			$dps_alpha_heading = $letter;
			return $this->heading_open() . $letter . $this->heading_close();
		}

	}

	/**
	 * Heading Open
	 *
	 */
	function heading_open() {
		return '<' . $this->heading_tag() . ' class="' . $this->heading_class() . '">';
	}

	/**
	 * Heading Close
	 *
	 */
	function heading_close() {
		return '</' . $this->heading_tag() . '>';
	}

	/**
	 * Heading Tag
	 *
	 */
	function heading_tag() {
		return apply_filters( 'display_posts_alpha_view_heading_tag', 'h4' );
	}

	/**
	 * Heading class
	 *
	 */
	function heading_class() {
		return apply_filters( 'display_posts_alpha_view_heading_class', 'display-posts-letter' );
	}

}
new BE_DPS_Alpha_View;
