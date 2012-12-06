<?php

/**
 * Improved pagination output for posts.
 *
 * @see wp_link_pages()
 *
 * @param string|array $args
 *
 * @return string
 */
function hw_link_pages( $args = '' ) {

	$defaults = array(
		'before'           => __( 'Pages:' ),
		'after'            => '',
		'link_before'      => '',
		'link_after'       => '',
		'next_or_number'   => 'number',
		'nextpagelink'     => __( 'Next page' ),
		'previouspagelink' => __( 'Previous page' ),
		'pagelink'         => '%',
		'echo'             => true,
	);

	$r = wp_parse_args( $args, $defaults );
	$r = apply_filters( 'hw_link_pages_args', $r );

	global $page, $numpages, $multipage, $more;

	$output = '';

	if ( $multipage ) {

		if ( 'number' == $r['next_or_number'] ) {

			$output .= '<div class="pagination"><ul>';

			if ( ! empty( $r['before'] ) )
				$output .= '<li><span>'. $r['before'] . '</span></li>';

			for ( $i = 1; $i < ( $numpages + 1 ); $i = $i + 1 ) {

				$j = str_replace( '%', $i, $r['pagelink'] );

				$not_current = ( $i != $page ) || ( ( ! $more ) && ( $page == 1 ) );

				if ( $not_current )
					$output .= '<li>' . _wp_link_page( $i );
				else
					$output .= '<li class="active"><span>';

				$output .= $r['link_before'] . $j . $r['link_after'];

				if ( $not_current )
					$output .= '</a></li>';
				else
					$output .= '</span></li>';
			}

			if ( ! empty( $r['after'] ) )
				$output .= '<li><span>'. $r['after'] . '</span></li>';

			$output .= '</ul></div>';
		}
		else {

			if ( $more ) {

				$output .= '<ul class="pager">';

				$i = $page - 1;

				if ( $i && $more ) {

					$output .= '<li class="previous">' . _wp_link_page( $i );
					$output .= $r['link_before'] . $r['previouspagelink'] . $r['link_after'] . '</a></li>';
				}

				$i = $page + 1;

				if ( $i <= $numpages && $more ) {

					$output .= '<li class="next">' . _wp_link_page( $i );
					$output .= $r['link_before'] . $r['nextpagelink'] . $r['link_after'] . '</a></li>';
				}

				$output .= '</ul>';
			}
		}
	}

	$output = apply_filters( 'hw_link_pages_html', $output );

	if ( $r['echo'] )
		echo $output;

	return $output;
}