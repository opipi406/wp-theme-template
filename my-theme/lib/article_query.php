<?php

class ArticleQuery
{
  /** @var string|null */
  public $category_query;
  /** @var string|null */
  public $tag_query;
  /** @var WP_Term|null */
  public $tag;
  /** @var string|null */
  public $paged;

  public function __construct()
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

    if (empty($_GET['paged'])) {
      $paged = null;
    } else {
      $paged = $_GET['paged'];
    }

    $this->category_query = $category_query;
    $this->tag_query = $tag_query;
    $this->tag = null;
    if ($tag_query !== null) {
      $tag = get_tags(['slug' => $this->tag_query]);
      if (count($tag) > 0) {
        $this->tag = $tag[0];
      }
    }
    $this->paged = $paged;
  }

  public function buildQuery()
  {
    $query = [
      'category' => $this->category_query,
      'tag' => $this->tag_query,
      'paged' => $this->paged,
    ];

    return '?' . http_build_query($query);
  }
  public function hasQueryExceptPaged()
  {
    return $this->category_query !== null || $this->tag_query !== null;
  }

  /**
   * カテゴリーのアクティブクラスを返す
   *
   * @param string|null $slug
   * @return string
   */
  public function getActiveCategoryClass(string $slug = null): string
  {
    if ($this->category_query === $slug) {
      return ' -active';
    } else {
      return '';
    }
  }

  public function isTagPage(): bool
  {
    return $this->tag !== null;
  }
}
