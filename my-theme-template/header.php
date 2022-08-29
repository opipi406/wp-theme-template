<!DOCTYPE html>
<html lang="ja">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title><?php wp_title(); ?></title>

	<!-- wp_head -->
	<?php wp_head(); ?>
	<!--  -->

	<style>
		/* DEBUG: */
		/* #wpadminbar {
			display: none;
		}
		html {
			margin-top: 0 !important;
		} */
	</style>

</head>

<body>

	<div class="wrap">
		<header>

			<div class="header customizer__header_bgcolor">
				<?php the_custom_logo(); ?>
				<nav class="header__nav">
					<?php wp_nav_menu(); ?>
				</nav>
				<button class="burger-menu">
					<div class="burger-menu__btn">
						<div class="burger-menu-line"></div>
					</div>
					<nav class="burger-menu__nav">
						<?php wp_nav_menu(); ?>
					</nav>
					<div class="burger-overlay"></div>
				</button>
			</div>

		</header>