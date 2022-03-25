<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
	<nav class="header__nav navigation">
					<ul class="header__menu menu menu_width_full">

<?foreach($arResult as $arItem):
	if($arItem["DEPTH_LEVEL"] === 1) :?>
		<li class="menu__item"><a href="<?=$arItem["LINK"]?>" class="menu__name"><?=$arItem["TEXT"]?></a>
		<ul class="dropdown-menu">
		<li class="dropdown-menu__content">
		<div class="dropdown-menu__img">
										<img src="<?= SITE_TEMPLATE_PATH ?>/assets/images/header-submenu-1.jpg" alt="девочка">
									</div>
									<div class="dropdown-menu__menu-col">
									<ul class="vertical-menu">
								
									<? foreach($arResult as $arItem2):	if($arItem2["DEPTH_LEVEL"] == 2 && $arItem["IS_PARENT"]==1 ) :?>
									
										<li class="vertical-menu__item"><span class="vertical-menu__name"><?=$arItem2["TEXT"]?></span></li>
									
		<?endif;?>
		<?endforeach;?>
	</ul>
	</div>
	</li>
	</ul>
	</li>
		
	<?endif;?>

<?endforeach;?>
</ul>
		</nav>
<?endif;?>

<?echo '<pre>';
print_r($arResult);
echo '</pre>';
