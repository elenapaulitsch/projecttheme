<?php
/**
 * Partial: Card Grid Image
 * ACF fields: headline, cards (repeater: image, title, text, link).
 */

$headline = get_sub_field('headline');
$cards = get_sub_field('cards') ?: [];
?>
<div class="card-grid-image">
  <?php if ($headline) : ?>
    <h2 class="card-grid-image__headline"><?php echo esc_html($headline); ?></h2>
  <?php endif; ?>

  <?php if (!empty($cards)) : ?>
    <div class="card-grid-image__grid">
      <?php foreach ($cards as $card) : ?>
        <?php
        $image_id = $card['image'] ?? 0;
        $title = $card['title'] ?? '';
        $text = $card['text'] ?? '';
        $link = $card['link'] ?? [];
        $link_url = is_array($link) ? ($link['url'] ?? '') : '';
        $link_title = is_array($link) ? ($link['title'] ?? '') : '';
        $link_target = is_array($link) ? ($link['target'] ?? '_self') : '_self';
        ?>
        <article class="card-grid-image__card">
          <?php if ($image_id) : ?>
            <div class="card-grid-image__media">
              <?php
              echo wp_get_attachment_image($image_id, 'medium_large', false, [
                'class'    => 'card-grid-image__image',
                'loading'  => 'lazy',
                'decoding' => 'async',
              ]);
              ?>
            </div>
          <?php endif; ?>

          <?php if ($title || $text || $link_url) : ?>
            <div class="card-grid-image__body">
              <?php if ($title) : ?>
                <h3 class="card-grid-image__title"><?php echo esc_html($title); ?></h3>
              <?php endif; ?>

              <?php if ($text) : ?>
                <div class="card-grid-image__text rte"><?php echo wp_kses_post($text); ?></div>
              <?php endif; ?>

              <?php if ($link_url) : ?>
                <a class="card-grid-image__link"
                   href="<?php echo esc_url($link_url); ?>"
                   target="<?php echo esc_attr($link_target); ?>"
                   <?php echo $link_target === '_blank' ? 'rel="noopener noreferrer"' : ''; ?>>
                  <?php echo esc_html($link_title ?: __('Mehr erfahren', 'projecttheme')); ?>
                </a>
              <?php endif; ?>
            </div>
          <?php endif; ?>
        </article>
      <?php endforeach; ?>
    </div>
  <?php endif; ?>
</div>
