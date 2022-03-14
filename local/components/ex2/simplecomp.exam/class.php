<?php
if (!defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;

class SimpleComp extends CBitrixComponent
{

  public function onPrepareComponentParams($arParams)
  {
    echo '<pre>';
    var_dump($arParams);
    $result = [
      "PRODUCTS_IBLOCK_ID" => trim($arParams["PRODUCTS_IBLOCK_ID"]),
      "NEWS_IBLOCK_ID" => trim($arParams["NEWS_IBLOCK_ID"]),
      "CODE_USER_PROPERTY" => $arParams["CODE_USER_PROPERTY"],
    ];
    return $result;
  }


  public function executeComponent()
  {
    if (!Loader::includeModule("iblock")) {
      ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
      return;
    }

    global $APPLICATION;
    $APPLICATION->SetTitle("В каталоге товаров представлено товаров: $[Количество]");
    $this->arResult['d'] = ["fsd" => 'fsdf'];
    $this->includeComponentTemplate();
  }
}
