<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
  <script src="https://kit.fontawesome.com/eb87b40bdc.js" crossorigin="anonymous"></script>
  <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/gsap.min.js?ver=3.11.3' id='gsap-js-js'></script>
  <script type='text/javascript' src='https://cdnjs.cloudflare.com/ajax/libs/gsap/3.11.3/ScrollTrigger.min.js?ver=3.11.3' id='scrolltrigger-js-js'></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/masonry/4.2.2/masonry.pkgd.min.js"></script>

  <title><?php bloginfo('name'); ?></title>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="transition">
  <div class='main-tool-bar'>
    <div class="logotitle">
      <a href="<?php echo esc_url(home_url('/')); ?>">
        <?php bloginfo('name'); ?>
      </a>
    </div>

    <div class="menu-toggle btn" onclick="toggleMenu()">Menu</div>

    <nav class="menu-wrapper transition noselect">
      <?php wp_nav_menu(['theme_location' => 'primary']); ?>
    </nav>
  </div>
</header>

<div class="scrollable-area"></div>

<div class="container_main">
