<?php
/**
 * Partial: Hero Basic
 * ACF fields: kicker, title, text, background_image, cta.
 */

$kicker = get_sub_field('kicker');
$title  = get_sub_field('title');
$text   = get_sub_field('text');
$image  = get_sub_field('background_image');
$cta    = get_sub_field('cta');

$image_url = $image ? wp_get_attachment_image_url($image, 'full') : '';
$cta_url = is_array($cta) && !empty($cta['url']) ? $cta['url'] : '';
$cta_title = is_array($cta) && !empty($cta['title']) ? $cta['title'] : '';
$cta_target = is_array($cta) && !empty($cta['target']) ? $cta['target'] : '_self';
$cta_rel = $cta_target === '_blank' ? 'noopener noreferrer' : '';
?>
<div class="hero-basic<?php echo $image_url ? ' hero-basic--has-image' : ''; ?>"<?php if ($image_url) : ?> style="background-image: linear-gradient(90deg, rgba(0, 0, 0, 0.48), rgba(0, 0, 0, 0.08)), url('<?php echo esc_url($image_url); ?>')"<?php endif; ?>>
  <div class="hero-basic__content">
    <?php if ($kicker) : ?>
      <p class="hero-basic__kicker"><?php echo esc_html($kicker); ?></p>
    <?php endif; ?>

    <?php if ($title) : ?>
      <h1 class="hero-basic__title"><?php echo esc_html($title); ?></h1>
    <?php endif; ?>

    <?php if ($text) : ?>
      <div class="hero-basic__text rte"><?php echo wp_kses_post($text); ?></div>
    <?php endif; ?>

    <?php if ($cta_url) : ?>
      <a class="btn btn-primary hero-basic__cta"
         href="<?php echo esc_url($cta_url); ?>"
         target="<?php echo esc_attr($cta_target); ?>"
         rel="<?php echo esc_attr($cta_rel); ?>">
        <?php echo esc_html($cta_title ?: __('Mehr erfahren', 'projecttheme')); ?>
      </a>
    <?php endif; ?>
  </div>
</div>
