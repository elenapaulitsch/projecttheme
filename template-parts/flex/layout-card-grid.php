<?php
/**
 * Partial: Card Grid
 */

$headline = get_sub_field('headline');
$cards = get_sub_field('cards') ?: [];
?>
<div class="card-grid">
  <?php if ($headline) : ?>
    <h2 class="card-grid__headline"><?php echo esc_html($headline); ?></h2>
  <?php endif; ?>

  <?php if (!empty($cards)) : ?>
    <div class="card-grid__grid">
      <?php foreach ($cards as $card) : ?>
        <?php
        $image_id = $card['image'] ?? 0;
        $title = $card['title'] ?? '';
        $text = $card['text'] ?? '';
        $bold_text = $card['bold_text'] ?? '';
        $link = $card['link'] ?? [];
        $link_url = is_array($link) ? ($link['url'] ?? '') : '';
        $link_title = is_array($link) ? ($link['title'] ?? '') : '';
        $link_target = is_array($link) ? ($link['target'] ?? '_self') : '_self';
        ?>
        <article class="card-grid__card">
          <?php if ($image_id) : ?>
            <div class="card-grid__media">
              <?php
              echo wp_get_attachment_image($image_id, 'medium_large', false, [
                'class'    => 'card-grid__image',
                'loading'  => 'lazy',
                'decoding' => 'async',
              ]);
              ?>
            </div>
          <?php endif; ?>

          <?php if ($title || $text || $bold_text || $link_url) : ?>
            <div class="card-grid__body">
              <?php if ($title) : ?>
                <h3 class="card-grid__title"><?php echo esc_html($title); ?></h3>
              <?php endif; ?>

              <?php if ($text) : ?>
                <div class="card-grid__text rte"><?php echo wp_kses_post($text); ?></div>
              <?php endif; ?>

              <?php if ($bold_text) : ?>
                <div class="card-grid__bold-text rte"><?php echo wp_kses_post($bold_text); ?></div>
              <?php endif; ?>

              <?php if ($link_url) : ?>
                <a class="card-grid__link"
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
