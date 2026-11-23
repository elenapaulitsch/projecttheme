<?php
/**
 * Partial: Hero Basic Bild
 * ACF fields: title, image.
 */

$title = get_sub_field('title');
$image_id = get_sub_field('image');
?>
<div class="hero-basic-bild">
  <?php if ($image_id) : ?>
    <?php
    echo wp_get_attachment_image($image_id, 'full', false, [
      'class'    => 'hero-basic-bild__image',
      'loading'  => 'eager',
      'fetchpriority' => 'high',
      'decoding' => 'async',
    ]);
    ?>
  <?php endif; ?>

  <?php if ($title) : ?>
    <h1 class="hero-basic-bild__title"><?php echo esc_html($title); ?></h1>
  <?php endif; ?>
</div>
