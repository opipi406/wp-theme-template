<?php

/**
 * テーマカスタマイザー
 */
if (!class_exists('Op_Customize')) {

  class Op_Customize {

    /**
     * Register customizer options.
     * 
     * @param WP_Customize_Manager $wp_customize テーマカスタマイザーオブジェクト
     */
    public static function register($wp_customize) {

      /*----------------------------------------------------
        リンク設定
      -----------------------------------------------------*/
      $wp_customize->add_section('link_section', array(
        'title' => 'リンク設定',
        'priority' => 9000,
        'description' => ''
      ));
      $wp_customize->add_setting(
        'online_store_link',
        array('sanitize_callback' => 'esc_url_raw')
      );
      $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'online_store_link', array(
        'label' => 'ONLINE STORE リンク',
        'section' => 'link_section',
        'settings' => 'online_store_link',
      )));
      $wp_customize->add_setting(
        'instagram_link',
        array('sanitize_callback' => 'esc_url_raw')
      );
      $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'instagram_link', array(
        'label' => 'Instagramリンク',
        'section' => 'link_section',
        'settings' => 'instagram_link',
      )));

      /*----------------------------------------------------
        アート作品画像設定
      -----------------------------------------------------*/
      $wp_customize->add_panel('art_panel', array(
        'title' => 'アート作品画像設定',
        'priority' => 9010,
        'description' => 'アート作品画像を設定します。'
      ));

      // 6枚分のセクションを追加するため1~6でループ
      for ($i = 1; $i <= 6; $i++) {
        $wp_customize->add_section("art_section_$i", array(
          'title' => "アート作品画像 ${i}枚目",
          'panel' => "art_panel",
        ));
        $wp_customize->add_setting(
          "art_url_$i",
          array('sanitize_callback' => 'esc_url_raw')
        );
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "art_url_$i", array(
          'label' => "作品画像",
          'section' => "art_section_$i",
          'settings' => "art_url_$i",
        )));
        $wp_customize->add_setting(
          "art_title_$i",
          array('sanitize_callback' => 'sanitize_text_field')
        );
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "art_title_$i", array(
          'label' => "作品名",
          'section' => "art_section_$i",
          'settings' => "art_title_$i",
        )));
        $wp_customize->add_setting(
          "art_description_$i",
          array('sanitize_callback' => 'sanitize_textarea_field')
        );
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "art_description_$i", array(
          'label' => "作品説明",
          'type' => 'textarea',
          'section' => "art_section_$i",
          'settings' => "art_description_$i",
        )));
      }

      /*----------------------------------------------------
        イラスト作品画像設定
      -----------------------------------------------------*/
      $wp_customize->add_panel('illust_panel', array(
        'title' => 'イラスト作品画像設定',
        'priority' => 9010,
        'description' => 'イラスト作品画像を設定します。'
      ));

      // 6枚分のセクションを追加するため1~6でループ
      for ($i = 1; $i <= 6; $i++) {
        $wp_customize->add_section("illust_section_$i", array(
          'title' => "イラスト作品画像 ${i}枚目",
          'panel' => "illust_panel",
        ));
        $wp_customize->add_setting("illust_url_$i");
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "illust_url_$i", array(
          'label' => "作品画像",
          'section' => "illust_section_$i",
          'settings' => "illust_url_$i",
        )));
        $wp_customize->add_setting("illust_title_$i");
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "illust_title_$i", array(
          'label' => "作品名",
          'section' => "illust_section_$i",
          'settings' => "illust_title_$i",
        )));
        $wp_customize->add_setting("illust_description_$i");
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "illust_description_$i", array(
          'label' => "作品説明",
          'type' => 'textarea',
          'section' => "illust_section_$i",
          'settings' => "illust_description_$i",
        )));

        /*----------------------------------------------------
          フォーム設定
        -----------------------------------------------------*/
        $wp_customize->add_section('form_section', array(
          'title' => 'フォーム設定',
          'priority' => 9020,
          'description' => 'オーダー受付のフォームの設定を行います。'
        ));
        $wp_customize->add_setting('cf7_shortcode');
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'cf7_shortcode', array(
          'label' => 'ContactForm7のショートコード',
          'section' => 'form_section',
          'settings' => 'cf7_shortcode',
        )));

      }
    }
  }

  add_action('customize_register', array('Op_Customize', 'register'));
}

/**
 * ONLINE STOREリンクの取得
 */
function get_online_store_url() {
  $url = esc_url(get_theme_mod('online_store_link'));
  return $url;
}

/**
 * インスタグラムリンクの取得
 */
function get_instagram_url() {
  $url = esc_url(get_theme_mod('instagram_link'));
  return $url;
}

/**
 * アート画像データの取得
 */
function get_art_data() {
  $data = array();
  for ($i = 1; $i <= 6; $i++) {
    $url = esc_url(get_theme_mod("art_url_$i"));
    $title = get_theme_mod("art_title_$i");
    $description = nl2br(get_theme_mod("art_description_$i"));
    if ($url != "" && $title != "") {
      $data[] = array(
        'url' => $url,
        'title' => $title,
        'description' => $description
      );
    }
  }
  return $data;
}

/**
 * イラスト画像データの取得
 */
function get_illust_data() {
  $data = array();
  for ($i = 1; $i <= 6; $i++) {
    $url = esc_url(get_theme_mod("illust_url_$i"));
    $title = get_theme_mod("illust_title_$i");
    $description = nl2br(get_theme_mod("illust_description_$i"));
    if ($url != "" && $title != "") {
      $data[] = array(
        'url' => $url,
        'title' => $title,
        'description' => $description
      );
    }
  }
  return $data;
}
