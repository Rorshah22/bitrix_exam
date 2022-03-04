<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if (isset($arResult["DATE_NEWS"])) {
  $APPLICATION->setPageProperty("specialdate", $arResult["DATE_NEWS"]);
}
