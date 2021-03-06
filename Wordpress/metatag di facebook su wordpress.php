<?php
/* inserisco questa funzione in functions.php */


function set_meta_description() {
if(is_home()) {
echo get_bloginfo ( 'description' ) .". Allungo un po' il motto del Blog per far contento Google.";
} else if(have_posts()&& is_single()OR is_page()) {
while(have_posts()):the_post(); the_excerpt_rss(); endwhile;
} else if(is_tag()) {
echo "Argomenti relativi al tag ".ucfirst(single_tag_title("", FALSE));
} else if(is_category()) {
$cat_desc = category_description();
if($cat_desc != '') {
echo $cat_desc;
} else {
echo "Argomenti relativi alla categoria ".ucfirst(single_cat_title("", FALSE));
}
} else {
echo get_bloginfo ( 'description' ) .". Allungo un po' il motto del Blog per far contento Google.";
}
}
?>

inserisco questa riga nell'header.php
--------------------------------------
<meta property="og:description" content="<?php set_meta_description(); ?>" />


inserisco con queste righe la foto in evidenza dell'articolo o un'immagine generica
------------------------------------------------------------------------------------
<?php if (is_single()&& has_post_thumbnail()) { ?>

  <meta property="og:image" content="<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 300, 300 ), false, '' ); echo $src[0]; ?>" />
  <meta property="og:image:width" content="200" />
  <meta property="og:image:height" content="200" />

<?php }else{ ?>



e quindi tutti i meta tag insieme
----------------------------------
<meta property="og:title" content="<?php global $page, $paged; wp_title( '&laquo;', true, 'right' ); bloginfo( 'name' ); if ( $paged >= 2 || $page >= 2 ) echo ' &raquo; ' . sprintf( __( 'Page %s' ), max( $paged, $page ) ); ?>" />

<?php if (is_single()OR is_page()) { ?>

  <meta property="og:type" content="article" />
  <meta property="og:url" content="<?php the_permalink() ?>" />

<?php }else{ ?>

  <meta property="og:type" content="website" />
  <meta property="og:url" content="<?php bloginfo('url'); ?>/" />

<?php } ?>

<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<meta property="og:description" content="<?php set_meta_description(); ?>" />

<?php if (is_single()&& has_post_thumbnail()) { ?>

  <meta property="og:image" content="<?php $src = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), array( 300, 300 ), false, '' ); echo $src[0]; ?>" />
  <meta property="og:image:width" content="200" />
  <meta property="og:image:height" content="200" />

<?php }else{ ?>

  <meta property="og:image" content="<?php echo get_bloginfo('url'); ?>/wp-content/themes/MyTheme/images/preview.jpg" />
  <meta property="og:image:width" content="200" />
  <meta property="og:image:height" content="200" />

<?php } ?>


ALTRA VERSIONE
------------------


<!-- the default values -->
<meta property="fb:app_id" content="192711544406736" />
<meta property="fb:admins" content="https://www.facebook.com/fabio.m.giacomini" />

<!-- if page is content page -->
<?php if (is_single()) { ?>
<meta property="og:url" content="<?php the_permalink() ?>"/>
<meta property="og:title" content="<?php single_post_title(''); ?>" />
<meta property="og:description" content="<?php echo strip_tags(get_the_excerpt($post->ID)); ?>" />
<meta property="og:type" content="article" />
<meta property="og:image" content="<?php if (function_exists('wp_get_attachment_thumb_url')) {echo wp_get_attachment_thumb_url(get_post_thumbnail_id($post->ID)); }?>" />

<!-- if page is others -->
<?php } else { ?>
<meta property="og:url" content="http://www.politecnos.it/"/>
<meta property="og:title" content="Politecnos - Corsi di formazione e consulenza manageriale" />
<meta property="og:site_name" content="<?php bloginfo('name'); ?>" />
<meta property="og:description" content="<?php bloginfo('description'); ?>" />
<meta property="og:type" content="website" />
<meta property="og:image" content="http://www.politecnos.it/wpress/wp-content/uploads/logo200x200FB.jpg" />
<?php } ?>
