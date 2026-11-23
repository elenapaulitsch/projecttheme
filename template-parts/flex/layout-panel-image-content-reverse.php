<?php
/**
 * Partial: Panel Image Content Reverse
 * ACF fields: headline, text, image.
 */

$headline = get_sub_field('headline');
$text = get_sub_field('text');
$image_id = get_sub_field('image');
?>
<div class="panel-image-content panel-image-content--reverse row g-0 align-items-stretch">
  <div class="panel-image-content__body col-12<?php echo $image_id ? ' col-md-6' : ''; ?>">
    <?php if ($headline) : ?>
      <h2 class="panel-image-content__headline"><?php echo esc_html($headline); ?></h2>
    <?php endif; ?>

    <?php if ($text) : ?>
      <div class="panel-image-content__text rte"><?php echo wp_kses_post($text); ?></div>
    <?php endif; ?>
  </div>

  <?php if ($image_id) : ?>
    <div class="panel-image-content__media col-12 col-md-6">
      <?php
      echo wp_get_attachment_image($image_id, 'large', false, [
        'class'    => 'panel-image-content__image',
        'loading'  => 'lazy',
        'decoding' => 'async',
      ]);
      ?>
    </div>
  <?php endif; ?>
</div>
