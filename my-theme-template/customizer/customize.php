<?php

/**
 * テーマカスタマイザー
 */
if (!class_exists('My_Customize')) {

  class My_Customize
  {

    /**
     * Register customizer options.
     * 
     * @param WP_Customize_Manager $wp_customize テーマカスタマイザーオブジェクト
     */
    public static function register($wp_customize)
    {

      /*----------------------------------------------------
        リンク設定
      -----------------------------------------------------*/
      $wp_customize->add_section('link_section', array(
        'title' => 'リンク設定',
        'priority' => 9000,
        'description' => ''
      ));

      $wp_customize->add_setting(
        'facebook_link',
        array('sanitize_callback' => 'esc_url_raw')
      );
      $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'facebook_link', array(
        'label' => 'Facebookリンク',
        'section' => 'link_section',
        'settings' => 'facebook_link',
      )));

      $wp_customize->add_setting(
        'twitter_link',
        array('sanitize_callback' => 'esc_url_raw')
      );
      $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'twitter_link', array(
        'label' => 'Twitterリンク',
        'section' => 'link_section',
        'settings' => 'twitter_link',
      )));

      $wp_customize->add_setting(
        'youtube_link',
        array('sanitize_callback' => 'esc_url_raw')
      );
      $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'youtube_link', array(
        'label' => 'Youtubeリンク',
        'section' => 'link_section',
        'settings' => 'youtube_link',
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

      $wp_customize->add_setting(
        'MANKAI_production_link',
        array('sanitize_callback' => 'esc_url_raw')
      );
      $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'MANKAI_production_link', array(
        'label' => 'MANKAI production 外部リンク',
        'section' => 'link_section',
        'settings' => 'MANKAI_production_link',
      )));

      /*----------------------------------------------------
        TOPスライダー設定
      -----------------------------------------------------*/
      $wp_customize->add_panel('slider_panel', array(
        'title' => 'TOPスライダー設定',
        'priority' => 9010,
        'description' => 'トップページのスライダー画像を設定します。画像サイズは 1440x800(PC)、375x700(スマホ) 推奨です。最大10枚まで設定できます（１〜１０枚分全て設定しなくても動作します）'
      ));

      for ($i = 1; $i <= 10; $i++) {
        $wp_customize->add_section("slider_section_$i", array(
          'title' => "スライダー ${i}枚目",
          'panel' => "slider_panel",
        ));
        $wp_customize->add_setting("slider_src_pc_$i");
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "slider_src_pc_$i", array(
          'label' => 'スライダー画像（PC用）',
          'section' => "slider_section_$i",
          'settings' => "slider_src_pc_$i",
        )));
        $wp_customize->add_setting("slider_src_sp_$i");
        $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, "slider_src_sp_$i", array(
          'label' => 'スライダー画像（スマホ用）',
          'section' => "slider_section_$i",
          'settings' => "slider_src_sp_$i",
        )));
        $wp_customize->add_setting("slider_alt_$i");
        $wp_customize->add_control(new WP_Customize_Control($wp_customize, "slider_alt_$i", array(
          'label' => '代替テキスト（省略可）',
          'section' => "slider_section_$i",
          'settings' => "slider_alt_$i",
        )));
      }

      /*----------------------------------------------------
        Youtube埋め込み設定
      -----------------------------------------------------*/
      $wp_customize->add_section('youtube_section', array(
        'title' => 'Youtube埋め込み設定',
        'priority' => 9500,
        'description' => ''
      ));

      $wp_customize->add_setting(
        'youtube_html',
      );
      $wp_customize->add_control(new WP_Customize_Control($wp_customize, 'youtube_html', array(
        'label' => '埋め込みURL',
        'section' => 'youtube_section',
        'settings' => 'youtube_html',
      )));
    }
  }

  add_action('customize_register', array('My_Customize', 'register'));
}

/**
 * Facebookリンクの取得
 */
function get_facebook_url()
{
  $url = esc_url(get_theme_mod('facebook_link'));
  return $url ? $url : '#';
}
/**
 * Twitterリンクの取得
 */
function get_twitter_url()
{
  $url = esc_url(get_theme_mod('twitter_link'));
  return $url ? $url : '#';
}
/**
 * Youtubeリンクの取得
 */
function get_youtube_url()
{
  $url = esc_url(get_theme_mod('youtube_link'));
  return $url ? $url : '#';
}
/**
 * インスタグラムリンクの取得
 */
function get_instagram_url()
{
  $url = esc_url(get_theme_mod('instagram_link'));
  return $url ? $url : '#';
}


/**
 * MANKAI production外部リンクの取得
 */
function get_MANKAI_production_url()
{
  $url = esc_url(get_theme_mod('MANKAI_production_link'));
  return $url ? $url : '#';
}


/**
 * スライダー情報の取得
 */
function get_slider_data()
{
  $data = [];
  for ($i = 1; $i <= 10; $i++) {
    $src_pc = esc_url(get_theme_mod("slider_src_pc_$i"));
    $src_sp = esc_url(get_theme_mod("slider_src_sp_$i"));
    $alt = get_theme_mod("slider_alt_$i");
    if ($src_pc != "" && $src_sp != "") {
      $data[] = [
        'src_pc' => $src_pc,
        'src_sp' => $src_sp,
        'alt' => $alt,
      ];
    }
  }
  return $data;
}


/**
 * Youtube埋め込みHTMLの取得
 */
function get_youtube_link()
{
  $youtube_html = get_theme_mod('youtube_html');
  return $youtube_html ? $youtube_html : '';
}
