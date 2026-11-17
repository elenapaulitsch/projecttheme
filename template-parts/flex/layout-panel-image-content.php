<?php
/**
 * Partial: Panel Image Content
 * ACF fields: image, headline, text, cta.
 */

$image_id = get_sub_field('image');
$headline = get_sub_field('headline');
$text = get_sub_field('text');
$cta = get_sub_field('cta');

$cta_url = is_array($cta) && !empty($cta['url']) ? $cta['url'] : '';
$cta_title = is_array($cta) && !empty($cta['title']) ? $cta['title'] : '';
$cta_target = is_array($cta) && !empty($cta['target']) ? $cta['target'] : '_self';
$cta_rel = $cta_target === '_blank' ? 'noopener noreferrer' : '';
?>
<div class="panel-image-content row g-0 align-items-stretch">
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

  <div class="panel-image-content__body col-12<?php echo $image_id ? ' col-md-6' : ''; ?>">
    <?php if ($headline) : ?>
      <h2 class="panel-image-content__headline"><?php echo esc_html($headline); ?></h2>
    <?php endif; ?>

    <?php if ($text) : ?>
      <div class="panel-image-content__text rte"><?php echo wp_kses_post($text); ?></div>
    <?php endif; ?>

    <?php if ($cta_url) : ?>
      <a class="btn btn-primary panel-image-content__cta"
         href="<?php echo esc_url($cta_url); ?>"
         target="<?php echo esc_attr($cta_target); ?>"
         rel="<?php echo esc_attr($cta_rel); ?>">
        <?php echo esc_html($cta_title ?: __('Mehr erfahren', 'projecttheme')); ?>
      </a>
    <?php endif; ?>
  </div>
</div>
