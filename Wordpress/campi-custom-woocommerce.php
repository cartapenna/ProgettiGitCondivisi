<?php
/**
 * creo campi custom per i prodotti di woocommerce
 *  https://code4life.it/guide/come-aggiungere-campi-personalizzati-in-woocommerce/
 */


// Aggiunge un nuovo campo di tipo testo ai prodotti di WooCommerce
add_action( 'woocommerce_product_options_general_product_data', function() {
    woocommerce_wp_text_input( array(
        'id'            => '_campo_personalizzato',
        'name'          => 'campo_personalizzato',
        'label'         => __( 'Campo personalizzato', 'woocommerce' ),
        'description'   => __( 'Descrizione: questo campo fa qualcosa di speciale', 'woocommerce' ),
        'desc_tip'      => true,
        'placeholder'   => __( 'Inserisci qui il valore del tuo campo personalizzato', 'woocommerce' )
    ) );
} );


// Salva nel database il valore del campo personalizzato
add_action( 'woocommerce_process_product_meta', function( $post_id ) {
    if ( ! empty( $_POST['campo_personalizzato'] ) ) {
        update_post_meta( $post_id, '_campo_personalizzato', esc_attr( $_POST['campo_personalizzato'] ) );
    }
} );

/**
 * il codice che segue va inserito nel file del template per visualizzare il campo

* Recupera il campo "campo_personalizzato"
*/
// echo get_post_meta( $post_id, 'campo_personalizzato' );


/**
 * altro Esempio
 * https://www.labdesign80.it/aggiungere-custom-fields/
 */
 add_action( 'woocommerce_after_shop_loop_item_title', 'ins_woocommerce_product_excerpt', 35, 2);
 if (!function_exists('ins_woocommerce_product_excerpt'))
 {
 function ins_woocommerce_product_excerpt() {
 global $post;
 if ( is_home() || is_shop() || is_product_category() || is_product_tag() ) {
 echo '<span class="excerpt">';
 echo get_post_meta( $post->ID, 'loopdesc', true );
 echo '</span>';
 }
 }
 }
