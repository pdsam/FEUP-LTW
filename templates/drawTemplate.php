<?php 
include_once(ROOT . 'templates/common/header.php');
include_once(ROOT . 'templates/common/footer.php');
include_once(ROOT . 'templates/common/loginForm.php');
include_once(ROOT . 'includes/session.php');

function renderPage($stylesheets = array(), $scripts = array(), $rendererFunc) {?>

<!DOCTYPE html>
<html>
  <head>
    <title>Villat</title>
    <meta charset="utf-8" />

    <link rel="stylesheet" href="../stylesheets/common.css">
    <link rel="stylesheet" href="../stylesheets/topbar.css">
    <link rel="stylesheet" href="../stylesheets/forms.css">

    <?php if (!isset($_SESSION['username'])) { ?>
      <link rel="stylesheet" href="../stylesheets/login.css">
      <script src="../javascript/login.js" defer></script>
    <?php } ?>

    <?php foreach($stylesheets as $stylesheet) { ?>
        <link rel="stylesheet" href="../stylesheets/<?=$stylesheet?>.css">
    <?php } ?>

    <?php foreach($scripts as $script) { ?>
        <script src="../javascript/<?=$script?>.js" defer></script>
		<?php } ?>
	</head>
	<body>
		<?php draw_header(); ?>

    <section class="main-content">
			<?php $rendererFunc(); ?>
		</section>
    
    <?php if (!isset($_SESSION)) {
		  draw_login_form();
    } ?>

		<?php draw_footer(); ?>
	</body>

<?php } ?>