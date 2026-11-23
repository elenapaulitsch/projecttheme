<?php
/**
 * Partial: Panel Content
 * ACF fields: kicker, headline, text, link.
 */

$kicker = get_sub_field('kicker');
$headline = get_sub_field('headline');
$text = get_sub_field('text');
$link = get_sub_field('link');

$link_url = is_array($link) ? ($link['url'] ?? '') : '';
$link_title = is_array($link) ? ($link['title'] ?? '') : '';
$link_target = is_array($link) ? ($link['target'] ?? '_self') : '_self';
?>
<div class="panel-content">
  <div class="panel-content__heading">
    <?php if ($kicker) : ?>
      <p class="panel-content__kicker"><?php echo esc_html($kicker); ?></p>
    <?php endif; ?>

    <?php if ($headline) : ?>
      <h2 class="panel-content__headline"><?php echo esc_html($headline); ?></h2>
    <?php endif; ?>
  </div>

  <?php if ($text || $link_url) : ?>
    <div class="panel-content__body">
      <?php if ($text) : ?>
        <div class="panel-content__text rte"><?php echo wp_kses_post($text); ?></div>
      <?php endif; ?>

      <?php if ($link_url) : ?>
        <a class="panel-content__link"
           href="<?php echo esc_url($link_url); ?>"
           target="<?php echo esc_attr($link_target); ?>"
           <?php echo $link_target === '_blank' ? 'rel="noopener noreferrer"' : ''; ?>>
          <?php echo esc_html($link_title ?: __('Mehr erfahren', 'projecttheme')); ?>
        </a>
      <?php endif; ?>
    </div>
  <?php endif; ?>
</div>
