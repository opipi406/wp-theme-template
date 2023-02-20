<?php
$fv_items = [
  ['src_pc' => get_img_dir() . '/fv01.jpg', 'src_sp' => get_img_dir() . '/fv01.jpg', 'alt' => 'ファーストビュー1'],
  ['src_pc' => get_img_dir() . '/fv02.jpg', 'src_sp' => get_img_dir() . '/fv02.jpg', 'alt' => 'ファーストビュー2'],
  ['src_pc' => get_img_dir() . '/fv03.jpg', 'src_sp' => get_img_dir() . '/fv03.jpg', 'alt' => 'ファーストビュー3'],
];
?>

<div class="fv">
  <div class="fv-slider">
    <ul class="fv-slider__dot-wrap">
      <?php for ($i = 0; $i < count($fv_items); $i++) :
        $current = $i === 0 ? ' current' : '';
      ?>
        <li class="fv-slider__dot<?php echo $current; ?>"></li>
      <?php endfor; ?>
    </ul>
    <!-- <div class="fv-slider__btn-wrap">
      <div class="fv-slider__btn fv-slider__btn--prev"></div>
      <div class="fv-slider__btn fv-slider__btn--next"></div>
    </div> -->
    <?php foreach ($fv_items as $i => $item) :
      $hide = $i === 0 ? '' : ' hide';
    ?>
      <picture>
        <source media="(min-width: 560px)" srcset="<?php echo $item['src_pc'] ?>">
        <source media="(max-width: 559px)" srcset="<?php echo $item['src_sp'] ?>">
        <img class="fv-img fv-img-<?php echo str_pad($i + 1, 2, '0', STR_PAD_LEFT) . $hide; ?>" src="<?php echo $item['src_pc'] ?>" alt="<?php echo $item['alt']; ?>">
      </picture>
    <?php endforeach; ?>
  </div>
</div>