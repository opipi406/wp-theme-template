<?php

/**
 * Contact Form 7 追加バリデーション
 * カタカナバリデーション
 * 
 * [text your-kana]
 *
 * @param mixed $result
 * @param mixed $tag
 */
// /*
function wpcf7_validate_kana($result, $tag)
{
  $tag = new WPCF7_Shortcode($tag);
  $name = $tag->name;
  $value = isset($_POST[$name]) ? trim(wp_unslash(strtr((string) $_POST[$name], "\n", " "))) : "";
  if ($name === "your-kana") {
    if (!preg_match("/^[ァ-ヾ]+$/u", $value)) {
      $result->invalidate($tag, "全角カタカナで入力してください。");
    }
  }
  return $result;
}
add_filter('wpcf7_validate_text',  'wpcf7_validate_kana', 11, 2);
add_filter('wpcf7_validate_text*', 'wpcf7_validate_kana', 11, 2);
// */