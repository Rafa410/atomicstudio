<?php

// Carga el script de Google Analytics en el head de todas las páginas
add_action( 'wp_head', 'gpc_load_google_analytics' );
function gpc_load_google_analytics() {
	?>

	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-4GW0HTZMHT"></script>
	<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());
	gtag('config', 'G-4GW0HTZMHT');
	</script>

	<?php
}

// Carga scripts personalizados
add_action( 'wp_enqueue_scripts', 'custom_scripts' );
function custom_scripts() {
	
	// Todas las páginas
	wp_register_script( 'custom-js', get_stylesheet_directory_uri(). '/js/custom.min.js', array( 'jquery' ), '1.0', true );
	wp_enqueue_script( 'custom-js' );

}

// Añade el logo al menu del header
add_action( 'generate_inside_navigation' , 'gpc_generate_menu_logo' );
function gpc_generate_menu_logo() {
	$html = '<div class="logo-menu"><a href="https://www.atomicstudio75.com"><img src="https://atomicstudio75.com/wp-content/uploads/2020/08/logo-atomic-studio.png" alt="Atomic Studio" /></a></div>';
	echo $html;
}

// Quita el texto "Menú" del header 
add_filter( 'generate_mobile_menu_label', 'gpc_remove_text_menu' );
function gpc_remove_text_menu( $text ) {
	$text = '';
	return $text;
}

// Cambia los iconos SVG del menu por iconos CSS
// $output = apply_filters( 'generate_svg_icon_element', $output, $icon ); [navigation.php]
// add_filter( 'generate_svg_icon_element', 'gpc_modify_menu_icon', 10, 2 );
function gpc_modify_menu_icon($output, $icon) {
	if ($icon == 'menu-bars') {
		$output = '<span></span><span></span><span></span><span></span>';
	}
	return $output;
}

// Sobreescribe el footer para quitar "Funciona con GeneratePress"
// apply_filters( 'generate_copyright', $copyright );
add_filter( 'generate_copyright', 'gpc_generate_custom_copyright' );
function gpc_generate_custom_copyright( $copyright ) {
	$copyright = sprintf( '<span class="copyright">&copy; %1$s <a href="%3$s">%2$s</a></span>',
		date( 'Y' ),
		get_bloginfo( 'name' ),
		get_home_url()
	);
	return $copyright;
}

// Quita los dashicons si no se muestra la barra de admin
add_action( 'wp_print_styles', 'gpc_remove_dashicons' , 100 );
function gpc_remove_dashicons() {
    if ( ! is_admin_bar_showing() ) {
		wp_deregister_style( 'dashicons' );
	}
}

?>