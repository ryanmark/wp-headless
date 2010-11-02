<?php
/*
Plugin Name: Headless Wordpress
Plugin URI: http://apps.chicagotribune.com/
Description: Rips out most of the functionality related to the front end of Wordpress.
Version: 1.0
Author: Ryan Mark
Author URI: http://apps.chicagotribune.com/
Network: true
*/

/*
 * Turn off some admin menus that won't be used
 */
function headless_admin_menu() {

	global $menu, $submenu;

    # Remove links
    unset($menu[15]);

    # Remove appearance
    unset($menu[60]);

    # Add option page
    add_options_page('Headless', 'Headless', 'update_core', 'headless', 'headless_admin');

}
add_action( 'admin_menu', 'headless_admin_menu' );

/*
 * Turn off some capabilities that won't be used
 */
function headless_remove_capabilities( $caps, $cap ) {
    
    $disallow = array(
        'delete_themes',
        'edit_theme_options',
        'edit_themes',
        'install_themes',
        'switch_themes',
        'update_themes'
    );

    if ( in_array($cap, $disallow) ) $caps[] = 'do_not_allow';

    return $caps;

}
add_filter( 'map_meta_cap', 'headless_remove_capabilities', 10, 2 );

/*
 * Muck up the theme
 */
function headless_theme() {

    # we'll let JSON-API work
    if ( ! get_query_var('json') )
        wp_redirect(get_admin_url(), 301);

}
add_action( 'template_redirect', 'headless_theme' );

/*
 * Make the permalink work
 */
function headless_permalink( $url, $post ) {
    
    global $headless_url;
    
    if ( $post->post_status != 'publish' ) $path = $post->ID;
    else $path = str_replace( get_option( 'siteurl' ), '', $url );
    return rtrim($headless_url, ' /') . '/' . ltrim($path, ' /');

}
add_filter( 'post_link', 'headless_permalink', 10, 2 );

/*
 * Display the admin page
 */
function headless_admin() {

    global $headless_url;

    if ( $_POST['headless_url'] ) {
        update_option( 'headless_url', $_POST['headless_url'] );
        $headless_url = $_POST['headless_url'];
    }

    include('headless_admin.php');
}

/*
 * Setup options
 */
function headless_install() {

  global $headless_url;

  if ( ! get_option( 'headless_url' ) )
     add_option( 'headless_url', get_option( 'siteurl' ).'/' );

  $headless_url = get_option( 'headless_url' );

}
add_action( 'plugins_loaded', 'headless_install' );

?>
