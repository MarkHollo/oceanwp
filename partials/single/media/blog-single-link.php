<?php
/**
 * Blog single link format media
 *
 * @package OceanWP WordPress theme
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Return if there isn't a thumbnail defined.
if ( ! has_post_thumbnail() ) {
	return;
}

$icon_class = '';
if ( 'svg' === oceanwp_theme_icon_class() ) {
	$icon_class = 'link-post-svg-icon';
} else {
	$icon_class = '';
}

// Image args.
$img_args = array(
	'alt' => get_the_title(),
);

if ( oceanwp_get_schema_markup( 'image' ) ) {
	$img_args['itemprop'] = 'image';
}

// Caption.
$caption = get_the_post_thumbnail_caption();

$link_format_url    = '';
$link_format_target = 'self';

if ( class_exists( 'Ocean_Extra' ) && function_exists( 'oe_get_meta' ) ) {
	$link_format_url    = oe_get_meta( '_ocean_meta_link_format_url' );
	$link_format_target = oe_get_meta( '_ocean_meta_link_format_target' );
} else {
	$link_format_url    = get_post_meta( get_the_ID(), 'ocean_link_format', true );
	$link_format_target = get_post_meta( get_the_ID(), 'ocean_link_format_target', true );
}

?>

<div class="thumbnail">

	<?php
	// Display post thumbnail.
	the_post_thumbnail( 'full', $img_args );

	// Caption.
	if ( $caption ) {
		?>
		<div class="thumbnail-caption">
			<?php echo wp_kses_post( $caption ); ?>
		</div>
		<?php
	}
	?>

	<div class="link-entry <?php echo esc_attr( $icon_class ); ?> clr">

		<a aria-label="<?php echo esc_attr( oceanwp_theme_strings( 'owp-string-link-post-format', false ) ); ?>" href="<?php echo esc_url( $link_format_url ); ?>" target="_<?php echo esc_attr( $link_format_target ); ?>"><?php oceanwp_icon( 'link' ); ?>

			<?php if ( 'blank' === $link_format_target ) { ?>
				<span class="screen-reader-text"><?php echo esc_html( oceanwp_theme_strings( 'owp-string-new-tab-alert', false ) ); ?></span>
			<?php } ?>

		</a>

	</div>

</div>
