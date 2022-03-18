<?php
if (!defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED !== true) die();


use Bitrix\Main\Loader;

class SimpleComp extends CBitrixComponent
{

  public function onPrepareComponentParams($arParams)
  {

    return [
      "CATALOG_IBLOCK_ID" => !empty($arParams["CATALOG_IBLOCK_ID"]) ?  intval(trim($arParams["CATALOG_IBLOCK_ID"])) : 0,
      "CLASSIFIER_IBLOCK_ID" => !empty($arParams["CLASSIFIER_IBLOCK_ID"]) ?  intval(trim($arParams["CLASSIFIER_IBLOCK_ID"]))  : 0,
      "TEMPLATE" => trim($arParams["TEMPLATE"]),
      "CODE_PROPERTY_ITEM" => trim($arParams["CODE_PROPERTY_ITEM"]),
      "CACHE_GROUPS" => !empty($arParams["CACHE_GROUPS"]) ? $arParams["CACHE_GROUPS"] : "Y",
      "CACHE_TIME" => !empty($arParams["CACHE_TIME"]) ? intval($arParams["CACHE_TIME"]) : 0,
    ];
  }

  private function getClassifier()
  {
    $arSelect = ["ID", "IBLOCK_ID", "NAME"];
    $arFilter = [
      "IBLOCK_ID" => $this->arParams["CLASSIFIER_IBLOCK_ID"],
      "CHECK_PERMISSIONS" => $this->arParams["CACHE_GROUPS"],
      "ACTIVE" => "Y"
    ];

    $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
    while ($arr = $res->Fetch()) {
      $result["CLASSIFIER"][] = $arr;
      $result["ID"][] = $arr["ID"];
    }
    return $result;
  }

  private function getElementCatalog()
  {
    $arSelect = ["ID", "IBLOCK_ID", "NAME", "PROPERTY_MATERIAL", "PROPERTY_ARTNUMBER", "PROPERTY_PRICE", "PROPERTY_" . $this->arParams["CODE_PROPERTY_ITEM"], "DETAIL_PAGE_URL"];
    $arFilter = [
      "IBLOCK_ID" => $this->arParams["CATALOG_IBLOCK_ID"],
      "CHECK_PERMISSIONS" => $this->arParams["CACHE_GROUPS"],
      "ACTIVE" => "Y"
    ];

    $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
    while ($arr = $res->GetNext()) {

      $result[] = $arr;
    }

    return $result;
  }

  private function resultFormation()
  {
    $classifiers = $this->getClassifier()["CLASSIFIER"];
    $elements = $this->getElementCatalog();

    foreach ($classifiers as $key => $classif) {

      foreach ($elements as $element) {
        if ($classif["ID"] == $element["PROPERTY_FIRMA_VALUE"]) {

          $result[$key]["CLASSIFIER"] = ["ID" => $classif["ID"], "NAME" => $classif["NAME"]];
          $result[$key]["ITEM"][] =  $element;
        }
      }
    }

    return $result;
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

      $this->arResult["COUNT"] = count($this->getClassifier());
      $counter =  $this->arResult["COUNT"];

      $this->arResult['SECTIONS'] = $this->resultFormation();

      $this->includeComponentTemplate();
    } else {
      $this->abortResultCache();
    }
    $APPLICATION->SetTitle(GetMessage("COUNT_SECTIONS", ["#CNT#" => "$counter"]));
  }
}
