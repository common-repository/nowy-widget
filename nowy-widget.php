<?php
/**
 * =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
 *   LICENSE
 *   =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=

 *   Copyright by Code Boxx

 *   Permission is hereby granted, free of charge, to any person obtaining a copy
 *   of this software and associated documentation files (the "Software"), to deal
 *   in the Software without restriction, including without limitation the rights
 *   to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 *   copies of the Software, and to permit persons to whom the Software is
 *   furnished to do so, subject to the following conditions:

 *   The above copyright notice and this permission notice shall be included in all
 *   copies or substantial portions of the Software.

 *   THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 *   IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 *   FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 *   AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 *   LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 *   OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 *   SOFTWARE.


 *   =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
 *   MORE
 *   =-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=
 *   Please visit https://code-boxx.com/ for more!
 * Hello World
 *
 * @package     NowyWidget
 * @author      nowy.io
 * @copyright   2022 Nowy widget
 * @license     GPL-2.0-or-later
 *
 * @wordpress-plugin
 * Plugin Name: Nowy Widget
 * Plugin URI:  https://nowy.io/
 * Description: This plugin prints "Nowy Widget" inside an admin page.
 * Version:     1.0.3
 * Author:      nowy.io
 * Author URI:  https://nowy.io
 * Text Domain: nowy-widget
 * License:     GPL v2 or later
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 */

/**
 * Admin side display noway plugin Setting
 *
 * @since 1.0.0
 * @access public
 **/ 
function noway_display() {   
    include_once 'setting.php';
}

/**
 * Admin Menu Setting
 *
 * @since 1.0.0
 * @access public
 **/ 
function noway_world_admin_menu() {
    add_menu_page(
        __('Nowy Widget Setting', 'nowy-widget'),// page title
        __('Nowy Widget Setting', 'nowy-widget'), // menu title
        'manage_options',// capability
        'nowy-widget-setting',// menu slug
        'noway_display' // callback function
    );
}

add_action('admin_menu', 'noway_world_admin_menu');

/**
 * Enqueue nowy scripts and styles. - Frontend
 * 
 * @since 1.0.0
 * @access public
 */
function nowy_widget_enqueue_scripts() {
    // wp_register_script( 'nowy-front-js', plugins_url( '/js/front/nowy.js', __FILE__) , array ('jquery'), '', true );
    wp_register_script( 'bootstrap-nowy-js', plugins_url( '/js/nowy-bootstrap.js', __FILE__) , array ('jquery'), '', true );
    wp_register_script( 'freewall-nowy-js', plugins_url( '/js/freewall.js', __FILE__) , '', '', true );
    wp_register_style( 'style-nowy-style', plugins_url( '/css/front/nowy-style.css', __FILE__ ) );
    wp_register_style( 'front-nowy-style', plugins_url( '/css/front-style.css', __FILE__ ) );
    wp_register_style( 'pinterest-nowy-style', plugins_url( '/css/pinterest-style.css', __FILE__ ) );
    wp_register_style( 'font-awesome-nowy-style', plugins_url( '/css/font-awesome.min.css', __FILE__ ) );
    wp_register_style( 'bootstrap-nowy-style', plugins_url( '/css/nowy-bootstrap.css', __FILE__ ) );

}
add_action( 'wp_enqueue_scripts', 'nowy_widget_enqueue_scripts' );

/**
 * Enqueue nowy scripts and styles. - Backend
 * 
 * @since 1.0.0
 * @access public
 */
function noway_enqueue_custom_admin_style() {
    wp_register_script( 'admin-nowy-bootstrap-js' , plugins_url( '/js/nowy-bootstrap.js', __FILE__) , '', '', true );
    wp_register_script( 'admin-nowy-underscore-js' , plugins_url( '/js/underscore-umd-min.js', __FILE__) , '', '', true );
    wp_register_style( 'admin-nowy-setting-style-style' , plugins_url( '/css/setting-style.css', __FILE__ ) );
    wp_register_style( 'admin-nowy-bootstrap-style' , plugins_url( '/css/nowy-bootstrap.css', __FILE__ ) );
}
add_action( 'admin_enqueue_scripts', 'noway_enqueue_custom_admin_style' );

/**
 * Written in PHP and used to generate the final HTML.
 *
 * @since 1.0.0
 * @access public
 */
function nowy_widget_call($atts=[]) {
    // Turn on output buffering
    ob_start();

    if(isset($atts['id'])){

        wp_enqueue_style( 'bootstrap-nowy-style' );
        wp_enqueue_style( 'style-nowy-style' );
        wp_enqueue_style( 'front-nowy-style' );
        wp_enqueue_style( 'pinterest-nowy-style' );
        wp_enqueue_style( 'font-awesome-nowy-style' );
        wp_enqueue_script( 'bootstrap-nowy-js' );
        wp_enqueue_script( 'freewall-nowy-js' );
        
        // HTML + JS
        include_once('nowy-widget-shortcode.php');

    }

    // return buffering output
    return ob_get_clean();
}

add_shortcode('nowy_widget', 'nowy_widget_call');