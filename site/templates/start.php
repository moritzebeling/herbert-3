<?php snippet('header') ?>

<main>

  <?php snippet('channel/header',[
    'channel' => $site
  ]); ?>

  <?php snippet('posts/api'); ?>

</main>

<?php snippet('footer');
