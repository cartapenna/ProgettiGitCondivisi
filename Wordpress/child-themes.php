<?php
/*** 
*** fonte https://codex.wordpress.org/Child_Themes#How_to_Create_a_Child_Theme
**/


/*** 
*** la funzione serve a caricare prima il file css del tema principale e poi il mio in un array per ereditarne le proprietà
**/
function my_theme_enqueue_styles() {

    $parent_style = 'nome-assegnato-allo-stile-genitore'; // nel caso del sito di caro 'twentyseventeen-style'.

    wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css' );
    wp_enqueue_style( 'child-style',
        get_stylesheet_directory_uri() . '/style.css',
        array( $parent_style ),
        wp_get_theme()->get('Version')
    );
}
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );

