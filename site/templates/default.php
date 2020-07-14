<!doctype html>
<html>
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <title>Herbert.gd</title>

  <link rel="canonical" href="<?= $page->url() ?>" />

  <?= css([
    'assets/css/reset.css',
    'assets/css/swiper.css',
    'assets/css/global.css',
    '@auto'
  ]) ?>

  <?= js([
    'assets/js/morutilities.js',
    'assets/js/default.js'
  ]) ?>

  <meta name="description" content="<?php e( $page->description()->isNotEmpty(), $page->description()->html(), $site->description()->html() ) ?>">
  <meta name="keywords" content="<?= implode(', ', array_merge( $page->keywords()->split(), $site->keywords()->split() )) ?>">

  <?php
  $parent = $page->isHomePage() ? $site : $page;
  if( $image = $parent->content()->image()->toFile() ): ?>
    <meta property="og:image" content="<?= $image->thumb()->url(['width' => 1000]) ?>" />
  <?php elseif( $image = $parent->image() ): ?>
    <meta property="og:image" content="<?= $image->thumb()->url(['width' => 1000]) ?>" />
  <?php endif ?>

</head>
<!-- This website was made by Moritz Ebeling https://moritzebeling.com -->
<!-- If you want to contribute to this website, go to https://github.com/moritzebeling/herbert.gd -->
<body>

    <div id="frontend"></div>

    <?= js('media/plugins/herbert/frontend/bundle.js'); ?>
    <?php echo css('media/plugins/herbert/frontend/bundle.css'); ?>

</body>
</html>
