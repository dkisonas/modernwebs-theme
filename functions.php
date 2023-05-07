<?php

// Enqueue block styles and scripts
function mytheme_enqueue_block_assets() {
  $blocks_path = get_template_directory() . '/src/blocks';

  $blocks = scandir($blocks_path);

  foreach ($blocks as $block) {
    if ('.' !== $block && '..' !== $block) {
      $block_path = $blocks_path . '/' . $block . '/build';

      // Enqueue block JavaScript file
      if (file_exists($block_path . '/index.js')) {
        wp_enqueue_script(
          'mytheme-' . $block . '-block',
          get_template_directory_uri() . '/src/blocks/' . $block . '/build/index.js',
          array('wp-blocks', 'wp-element', 'wp-editor', 'wp-components', 'wp-i18n'),
          filemtime($block_path . '/index.js'),
          true
        );
      }

      // Enqueue block CSS file
      if (file_exists($block_path . '/style.css')) {
        wp_enqueue_style(
          'mytheme-' . $block . '-block-style',
          get_template_directory_uri() . '/src/blocks/' . $block . '/build/style.css',
          array(),
          filemtime($block_path . '/style.css')
        );
      }
    }
  }
}
add_action('enqueue_block_editor_assets', 'mytheme_enqueue_block_assets');
add_action('wp_enqueue_scripts', 'mytheme_enqueue_block_assets');
