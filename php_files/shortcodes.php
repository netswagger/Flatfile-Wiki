<?php
function bartag_func( $atts ) {
    $args = shortcode_atts( array(
      'foo' => 'bbbbbbb',
      'baz' => 'default baz',
    ), $atts );
    return "{$args['foo']}";
}
add_shortcode( 'bartag', 'bartag_func' );

//Title Shortcode
function caption_shortcode( $atts, $content = null ) {
	return '<h2 class="sub-header">' . $content . '</h2>';
}
add_shortcode( 'title', 'caption_shortcode' );