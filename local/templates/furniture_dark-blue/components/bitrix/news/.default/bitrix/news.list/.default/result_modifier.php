<?php if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

$obj_component = $this->__component;

if ($arParams["SPECIALDATE"] === 'Y') {
  $arResult["DATE_NEWS"] = $arResult['ITEMS'][0]["ACTIVE_FROM"];
  $obj_component->setResultCacheKeys(['DATE_NEWS']);
}
