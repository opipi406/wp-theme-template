<?php

class Article
{
  public int $id;
  public string $title;
  public string $url;
  public string $created_at;
  public string $created_by;
  public string $updated_at;
  /**
   * @var WP_Term[]|false|WP_Error
   */
  public $category;
  // public int $cat_ID;
  /**
   * @var WP_Term[]|false|WP_Error
   */
  public $tags;
  public string $content;

  public function __construct(?string $taxonomy = null)
  {
    $this->id         = get_the_ID();
    $this->title      = esc_html(get_the_title());
    $this->url        = esc_url(get_permalink());
    $this->created_at = get_the_time('Y/m/d');
    $this->created_by = get_the_author();
    $this->updated_at = get_the_modified_date('Y/m/d');
    if ($taxonomy === null) {
      $this->category = get_the_category();
    } else {
      $this->category = get_the_terms(get_the_ID(), $taxonomy);
    }
    // $this->cat_ID = ($this->category[0]->category_parent === 0) ? $this->category[0]->category_parent : $this->category[0]->cat_ID;
    $this->tags       = get_the_tags();
    if ($this->tags === false) {
      $this->tags = [];
    }
    $this->content    = wp_trim_words(get_the_content(), 256);
  }

  public static function getQuery()
  {
    if (empty($_GET['category'])) {
      $category_query = null;
    } else {
      $category_query = $_GET['category'];
    }

    if (empty($_GET['tag'])) {
      $tag_query = null;
    } else {
      $tag_query = $_GET['tag'];
    }

    return [
      'category_query' => $category_query,
      'tag_query' => $tag_query,
    ];
  }
}
