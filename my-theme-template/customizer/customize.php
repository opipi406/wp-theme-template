<?php

/**
 * テーマカスタマイザー
 */
if (!class_exists('Sample_Customize')) {

  class Sample_Customize {

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
      $wp_customize->add_setting('twitter_link');
      $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'twitter_link', array(
        'label' => 'Twitterリンク',
        'section' => 'link_section',
        'settings' => 'twitter_link',
      )));

      /*----------------------------------------------------
        スライダー設定
      -----------------------------------------------------*/
      $wp_customize->add_panel('slider_panel', array(
        'title' => 'キャラクタースライダー設定',
        'priority' => 9010,
        'description' => 'キャラクター説明セクションのスライダー画像、キャラ名、説明文を設定します。スライダーは最大５枚まで設定できます。画像とキャラクター名の両方を設定した場合のみ有効になります。'
      ));

      // スライダー5枚分のセクションを追加するため1~5でループ
      for ($i = 1; $i <= 5; $i++) {
        $wp_customize->add_section("slider_section_$i", array(
          'title' => "スライダー ${i}枚目",
          'panel' => "slider_panel",
        ));
        $wp_customize->add_setting("slider_url_$i");
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "slider_url_$i", array(
          'label' => 'スライダー画像',
          'section' => "slider_section_$i",
          'settings' => "slider_url_$i",
        )));
        $wp_customize->add_setting("slider_name_$i");
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "slider_name_$i", array(
          'label' => 'キャラクター名',
          'section' => "slider_section_$i",
          'settings' => "slider_name_$i",
        )));
        $wp_customize->add_setting("slider_description_$i");
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "slider_description_$i", array(
          'label' => '説明文',
          'type'=>'textarea',
          'section' => "slider_section_$i",
          'settings' => "slider_description_$i",
        )));
      }
      $wp_customize->add_section("slider_common_section", array(
        'title' => "スライダー設定（共通）",
        'panel' => "slider_panel",
      ));
      $wp_customize->add_setting('chara_description_height', array('default' => 90));
      $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'chara_description_height', array(
        'label' => 'キャラクター説明文の縦幅[px]',
        'type' => 'number',
        'section' => 'slider_common_section',
        'settings' => 'chara_description_height',
      )));

    }
  }

  add_action('customize_register', array('Sample_Customize', 'register'));
}

/**
 * Twitterリンクの取得
 */
function get_twitter_url() {
  $url = esc_url(get_theme_mod('twitter_link'));
  return $url;
}

/**
 * スライダー情報の取得
 */
function get_slider_data() {
  $data = array();
  for ($i = 1; $i <= 5; $i++) {
    $url = esc_url(get_theme_mod("slider_url_$i"));
    $name = get_theme_mod("slider_name_$i");
    $description = get_theme_mod("slider_description_$i");
    if ($url != "" && $name != "") $data[] = array('url' => $url, 'name' => $name, 'description' => $description);
  } 
  return $data;
}