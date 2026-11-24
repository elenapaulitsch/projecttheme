<?php
/**
 * Rendert die ACF Flexible-Content-Felder aus `page_modules`
 * Erwartet pro Layout ein Partial unter: /template-parts/flex/layout-*.php
 */

if (!function_exists('have_rows') || !have_rows('page_modules')) {
  return;
}

$anchor_by_heading = [
  'wer-ist-samsa' => 'wer-ist-samsa',
  'unsere-highlights' => 'unsere-highlights',
  'unsere-weinguter' => 'unsere-weingueter',
  'unsere-weingueter' => 'unsere-weingueter',
  'herkunft-unserer-weine' => 'herkunft-unserer-weine',
  'standorte' => 'standorte',
  'kontakt' => 'kontakte',
  'kontakte' => 'kontakte',
];
$assigned_section_anchors = [];

while (have_rows('page_modules')) : the_row();

  // Section-Optionen 
  $opts = [
    'name'       => get_row_layout(),
    'container'  => get_sub_field('container') ?: 'container-lg',
    'padding_y'  => get_sub_field('padding_y') ?: 'py-5',
    'bg'         => get_sub_field('background') ?: 'none',
    'id'         => get_sub_field('id-anchor') ?: '',
    'show_on'    => get_sub_field('show-on') ?: 'everywhere',
  ];

  if (!$opts['id']) {
    foreach (['title', 'headline', 'titel'] as $field_name) {
      $heading = get_sub_field($field_name);
      if (is_string($heading) && trim(wp_strip_all_tags($heading)) !== '') {
        $heading_slug = sanitize_title(wp_strip_all_tags($heading));
        if (isset($anchor_by_heading[$heading_slug]) && !isset($assigned_section_anchors[$anchor_by_heading[$heading_slug]])) {
          $opts['id'] = $anchor_by_heading[$heading_slug];
        }
        break;
      }
    }
  }

  if (!$opts['id'] && 'google_map' === $opts['name'] && !isset($assigned_section_anchors['standorte'])) {
    $opts['id'] = 'standorte';
  }

  if (!$opts['id'] && 'hero_basic' === $opts['name'] && !isset($assigned_section_anchors['hero-basic'])) {
    $opts['id'] = 'hero-basic';
  }

  if ($opts['id']) {
    $assigned_section_anchors[$opts['id']] = true;
  }

  if (in_array($opts['name'], ['hero_basic_bild', 'panel_image_double'], true)) {
    $opts['container'] = 'none';
  }

  // Öffne Section-Hülle nur, wenn Helper existieren – sonst simple Wrapper
  if (function_exists('section_open')) {
    section_open($opts);
  } else {
    $name = $opts['name'];
    $id   = $opts['id'] ? ' id="'.esc_attr($opts['id']).'"' : '';
    $cont = $opts['container'];
    $py   = $opts['padding_y'];
    echo '<section'.$id.' class="'.$name.' '.$py.'">';
    if ($cont !== 'none') echo '<div class="'.$cont.'">';
  }

  switch (get_row_layout()) {
    case 'intro':
      get_template_part('template-parts/flex/layout', 'intro'); break;

    case 'hero_basic':
      get_template_part('template-parts/flex/layout', 'hero-basic'); break;

    case 'hero_basic_bild':
      get_template_part('template-parts/flex/layout', 'hero-basic-bild'); break;

    case 'card_grid_image':
      get_template_part('template-parts/flex/layout', 'card-grid-image'); break;

    case 'card_grid':
      get_template_part('template-parts/flex/layout', 'card-grid'); break;

    case 'panel_image_content':
      get_template_part('template-parts/flex/layout', 'panel-image-content'); break;

    case 'panel_image_content_reverse':
      get_template_part('template-parts/flex/layout', 'panel-image-content-reverse'); break;

    case 'panel_image_double':
      get_template_part('template-parts/flex/layout', 'panel-image-double'); break;

    case 'panel_content':
      get_template_part('template-parts/flex/layout', 'panel-content'); break;

    case 'text_1col':
      get_template_part('template-parts/flex/layout', 'text-1col'); break;

    case 'text_2col':
      get_template_part('template-parts/flex/layout', 'text-2col'); break;

    case 'text_3col':
      get_template_part('template-parts/flex/layout', 'text-3col'); break;

    case 'text_4col':
      get_template_part('template-parts/flex/layout', 'text-4col'); break;

    case 'text_left_image_right':
      get_template_part('template-parts/flex/layout', 'text-left-image-right'); break;

    case 'image_left_text_right':
      get_template_part('template-parts/flex/layout', 'image-left-text-right'); break;

    case 'image_slider':
      get_template_part('template-parts/flex/layout', 'image-slider'); break;

    case 'bildboxen':
      get_template_part('template-parts/flex/layout', 'bildboxen'); break;

    case 'galerie':
      get_template_part('template-parts/flex/layout', 'galerie'); break;

    case 'tabs':
      get_template_part('template-parts/flex/layout', 'tabs'); break;

    case 'akkordeon':
      get_template_part('template-parts/flex/layout', 'akkordeon'); break;

    case 'breaker':
      get_template_part('template-parts/flex/layout', 'breaker'); break;

    case 'code_editor':
      get_template_part('template-parts/flex/layout', 'code-editor'); break;

    case 'google_map':
      get_template_part('template-parts/flex/layout', 'google-map'); break;

    case 'project_highlight':
      get_template_part('template-parts/flex/layout', 'project-highlight'); break;
    
    case 'first_try':
      get_template_part('template-parts/flex/layout', 'first-try'); break;
    
    case 'second_try':
      get_template_part('template-parts/flex/layout', 'second-try'); break;
  }

  if (function_exists('section_close')) {
    section_close($opts);
  } else {
    if ($opts['container'] !== 'none') echo '</div>';
    echo '</section>';
  }

endwhile;