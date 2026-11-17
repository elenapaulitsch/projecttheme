<?php
/**
 * Partial: Hero Basic
 * ACF fields: title, background_image.
 */

$title  = get_sub_field('title');
$image  = get_sub_field('background_image');

$image_url = $image ? wp_get_attachment_image_url($image, 'full') : '';
?>
<div class="hero-basic"<?php if ($image_url) : ?> style="background-image: linear-gradient(rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.2)), url('<?php echo esc_url($image_url); ?>')"<?php endif; ?>>
  <?php if ($title) : ?>
    <h1 class="hero-basic__title"><?php echo esc_html($title); ?></h1>
  <?php endif; ?>
</div>
