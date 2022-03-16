<?php
if (!defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED !== true) die();


use Bitrix\Main\Loader;

class SimpleComp extends CBitrixComponent
{

  public function onPrepareComponentParams($arParams)
  {

    return $arParams;
  }

  public function executeComponent()
  {
    global $USER;
    global $APPLICATION;

    if (!Loader::includeModule("iblock")) {
      ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
      return;
    }


    if ($this->startResultCache(false, $USER->GetGroups())) {


      $this->includeComponentTemplate();
    } else {
      $this->abortResultCache();
    }
    $APPLICATION->SetTitle(GetMessage("COUNT_SECTIONS", ["#CNT#" => '']));
  }
}
