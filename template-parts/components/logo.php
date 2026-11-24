<?php
/**
 * Site logo component.
 *
 */

$site_name = get_bloginfo( 'name' );
$logo_url = isset( $args['url'] ) ? $args['url'] : home_url( '/' );
?>
  <a href="<?php echo esc_url( $logo_url ); ?>" rel="home" aria-label="<?php echo esc_attr( $site_name ); ?>">
    SAMSA
  </a>
