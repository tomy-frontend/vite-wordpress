<?php

// 開発中はtrue,本番ビルド時はfalseにする
define('IS_VITE_DEVELOPMENT', true);

define('VITE_SERVER', 'http://localhost:5173');

/**
 * Viteビルドアセットを読み込む関数
 */
function enqueue_vite_assets()
{
    if (IS_VITE_DEVELOPMENT) {
        // 開発環境設定
        wp_enqueue_script('vite-client', VITE_SERVER . '/@vite/client', array(), null, true);
        wp_enqueue_script('main-script', VITE_SERVER . '/src/js/main.js', array('vite-client'), null, true);
        wp_enqueue_style('main-style', VITE_SERVER . '/src/scss/style.scss', array(), null);

        add_filter('script_loader_tag', function ($tag, $handle, $src) {
            if (in_array($handle, ['vite-client', 'main-script'])) {
                return '<script type="module" src="' . esc_url($src) . '"></script>';
            }
            return $tag;
        }, 10, 3);
    } else {
        // 本番環境設定
        wp_enqueue_script('main-script', get_stylesheet_directory_uri() . '/dist/assets/main.js', array(), null, true);
        wp_enqueue_style('main-style', get_stylesheet_directory_uri() . '/dist/assets/style.css', array(), null);

        add_filter('script_loader_tag', function ($tag, $handle, $src) {
            if ($handle === 'main-script') {
                return '<script type="module" src="' . esc_url($src) . '"></script>';
            }
            return $tag;
        }, 10, 3);
    }
}
add_action('wp_enqueue_scripts', 'enqueue_vite_assets');
