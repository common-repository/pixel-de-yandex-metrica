<?php
/*
Plugin Name: Pixel de Yandex Metrica
Plugin URI: https://www.labschool.es
Description: Agrega f&aacute;cilmente el c&oacute;digo de Yandex Metrica a tu web y activa las funciones Webvisor, Scroll Map y An&aacute;lisis de Formularios.
Version: 1.0.2
Tested up to: 5.4
Author: Lab School
Author URI: https://www.labschool.es
License: GPLv2
*/

if(!defined('ABSPATH')) exit;
require_once('ym-admin.php');

/* ACTIVAR PLUGIN */
register_activation_hook( __FILE__, 'pym_counter_install' );

function pym_counter_install() {
    $pym_counter_options 		= array(
        'id' 					=> '',
		'include_snippet_ya' 	=> '0',
		'webvisor' 				=> '0'
	);
    
	if (!get_option('pym_counter_options')) {
		update_option( 'pym_counter_options', $pym_counter_options );
	}
}

/* INICIAR PLUGIN */
add_action( 'plugins_loaded', 'pym_counter_setup');
function pym_counter_setup() {
  add_action( 'wp_head', 'pym_counter_header', 101);
}

function pym_counter_header() {
	$options 					= get_option('pym_counter_options');
    $id 						= $options['id'];
	$snippet					= $options['include_snippet_ya'];
	$webvisor					= $options['webvisor'];
    if (!isset($snippet) != '1' || $snippet) { ?> 

<!-- Yandex Metrica by Lab School -->
<script type="text/javascript"> (function (d, w, c) { (w[c] = w[c] || []).push(function() { try { w.yaCounter<?php echo esc_html($id);?> = new Ya.Metrika({ id:<?php echo esc_html($id);?>, clickmap:true, trackLinks:true, accurateTrackBounce:true<?php echo (isset($webvisor) && $webvisor) ?  ", webvisor:true" : "";?> }); } catch(e) { } }); var n = d.getElementsByTagName("script")[0], s = d.createElement("script"), f = function () { n.parentNode.insertBefore(s, n); }; s.type = "text/javascript"; s.async = true; s.src = "https://mc.yandex.ru/metrika/watch.js"; if (w.opera == "[object Opera]") { d.addEventListener("DOMContentLoaded", f, false); } else { f(); } })(document, window, "yandex_metrika_callbacks"); </script> <noscript><div><img src="https://mc.yandex.ru/watch/<?php echo esc_html($id);?>" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
<!-- Yandex Metrica by Lab School -->
<?php 
	}
}