<?php

/**
 * スタイルカスタマイザー
 */
if (!class_exists('My_StyleCustomize')) {

  class My_StyleCustomize {

    /**
     * Register customizer options.
     * 
     * @param WP_Customize_Manager $wp_customize テーマカスタマイザーオブジェクト
     */
    public static function register($wp_customize) {

      /*----------------------------------------------------
        背景色設定
      -----------------------------------------------------*/

      // --------------------------------------------------
      $wp_customize->add_section('bgcolor_section', array(
        'title' => '背景色設定',
        'priority' => 8000,
        'description' => '背景色の設定'
      ));

      // --------------------------------------------------
      $wp_customize->add_setting(
        'main_bgcolor',
        array(
          'default' => '#f5f5f5',
          'sanitize_callback' => 'sanitize_hex_color',
        )
      );
      $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'main_bgcolor', array(
        'label' => 'メイン背景色',
        'section' => 'bgcolor_section',
        'settings' => 'main_bgcolor',
      )));

      // --------------------------------------------------
      $wp_customize->add_setting(
        'header_bgcolor',
        array(
          'default' => '#ffffff',
          'sanitize_callback' => 'sanitize_hex_color',
        )
      );
      $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'header_bgcolor', array(
        'label' => 'ヘッダー背景色',
        'section' => 'bgcolor_section',
        'settings' => 'header_bgcolor',
      )));

      // --------------------------------------------------
      $wp_customize->add_setting(
        'footer_bgcolor',
        array(
          'default' => '#ffffff',
          'sanitize_callback' => 'sanitize_hex_color',
        )
      );
      $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'footer_bgcolor', array(
        'label' => 'フッター背景色',
        'section' => 'bgcolor_section',
        'settings' => 'footer_bgcolor',
      )));

      // --------------------------------------------------
      $wp_customize->add_setting(
        'burger_bgcolor',
        array(
          'default' => '#2b2b2b',
          'sanitize_callback' => 'sanitize_hex_color',
        )
      );
      $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'burger_bgcolor', array(
        'label' => 'ハンバーガーメニュー背景色',
        'section' => 'bgcolor_section',
        'settings' => 'burger_bgcolor',
      )));
    }
  }

  add_action('customize_register', array('My_StyleCustomize', 'register'));
}
