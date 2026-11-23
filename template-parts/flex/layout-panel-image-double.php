<?php
/**
 * Partial: Panel Image Double
 * ACF fields: image_left, image_right.
 */

$image_left_id = get_sub_field('image_left');
$image_right_id = get_sub_field('image_right');
?>
<div class="panel-image-double">
  <?php if ($image_left_id) : ?>
    <div class="panel-image-double__media panel-image-double__media--left">
      <?php
      echo wp_get_attachment_image($image_left_id, 'large', false, [
        'class'    => 'panel-image-double__image',
        'loading'  => 'lazy',
        'decoding' => 'async',
      ]);
      ?>
    </div>
  <?php endif; ?>

  <?php if ($image_right_id) : ?>
    <div class="panel-image-double__media panel-image-double__media--right">
      <?php
      echo wp_get_attachment_image($image_right_id, 'large', false, [
        'class'    => 'panel-image-double__image',
        'loading'  => 'lazy',
        'decoding' => 'async',
      ]);
      ?>
    </div>
  <?php endif; ?>
</div>
