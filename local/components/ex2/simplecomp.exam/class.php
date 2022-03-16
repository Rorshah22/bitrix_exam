<?php
if (!defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED !== true) die();


use Bitrix\Main\Loader;

class SimpleComp extends CBitrixComponent
{

  public function onPrepareComponentParams($arParams)
  {
    $result = [
      "PRODUCTS_IBLOCK_ID" => $arParams["PRODUCTS_IBLOCK_ID"] !== '' ? trim($arParams["PRODUCTS_IBLOCK_ID"]) : 0,
      "NEWS_IBLOCK_ID" => $arParams["NEWS_IBLOCK_ID"] !== "" ? trim($arParams["NEWS_IBLOCK_ID"]) : 0,
      "CODE_USER_PROPERTY" => $arParams["CODE_USER_PROPERTY"],
    ];
    return $result;
  }

  private  function  getSectionProduct()
  {

    if (CModule::IncludeModule('iblock')) {

      $arFilter = [
        "IBLOCK_ID" => $this->arParams["PRODUCTS_IBLOCK_ID"],
        "ACTIVE" => "Y"
      ];
      $section = CIBlockSection::GetList(
        [],
        $arFilter,
        false,
        ["UF_NEWS_LINK"]
      );
      while ($arSection = $section->Fetch()) {
        $arResult[]  = [
          "ID" => $arSection["ID"],
          "NAME" => $arSection["NAME"],
          "UF_NEWS_LINK" => $arSection["UF_NEWS_LINK"]
        ];
      }
    }
    return $arResult;
  }

  private function getElementsProduct()
  {
    if (CModule::IncludeModule('iblock')) {

      $arFilter = [
        "IBLOCK_ID" => $this->arParams["PRODUCTS_IBLOCK_ID"],
        "ACTIVE" => "Y"
      ];
      $arSelect = ["ID", "IBLOCK_ID", "IBLOCK_SECTION_ID", "NAME", "PROPERTY_MATERIAL", "PROPERTY_ARTNUMBER", "PROPERTY_PRICE"];
      $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
      while ($ar = $res->Fetch()) {
        $arResult[] = $ar;
      }
    }
    return $arResult;
  }

  private function getElementsNews()
  {

    if (CModule::IncludeModule('iblock')) {
      $arFilter = [
        "IBLOCK_ID" => $this->arParams["NEWS_IBLOCK_ID"],
        "ACTIVE" => "Y"
      ];
      $arSelect = ["ID", "IBLOCK_ID", "NAME", "ACTIVE_FROM"];

      $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

      while ($ar = $res->Fetch()) {
        $arResult[] = $ar;
      }
    }

    return $arResult;
  }

  private function resultFormation()
  {
    $sectionsProduct = $this->getSectionProduct();
    $elementsProduct  = $this->getElementsProduct();
    $elementsNews  = $this->getElementsNews();

    //записываем количество элементов в arResult
    $this->arResult["COUNT"] = count($elementsProduct);


    //запись элементов в соответствующие разделы
    foreach ($elementsProduct as  $element) {

      foreach ($sectionsProduct as $key => $section) {
        if ($section["ID"] == $element["IBLOCK_SECTION_ID"]) {

          $sectionsProduct[$key]['ITEM'][] =  $element;
        }
      }
    }
    //запись в массив соответствующих новостей и разделов 
    $newsList = [];
    foreach ($elementsNews as $news) {

      foreach ($sectionsProduct as $section) {

        if (in_array($news["ID"], $section["UF_NEWS_LINK"])) {
          $arSection[] = [
            "ID" => $section["ID"],
            "NAME_SECTION" => $section["NAME"]
          ];
          $arItem[] = $section["ITEM"];
          $newsList[$news["ID"]] = [
            "ID" => $news["ID"],
            "NAME" => $news["NAME"],
            "ACTIVE_FROM" => $news["ACTIVE_FROM"],
            "SECTION" => $arSection, "ITEM" => $arItem
          ];
        }
      }
      unset($arItem);
      unset($arSection);
    }

    return $newsList;
  }

  public function executeComponent()
  {
    if (!Loader::includeModule("iblock")) {
      ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
      return;
    }

    if ($this->startResultCache()) {

      $this->arResult["NEWS"] = $this->resultFormation();
      $countItems = $this->arResult["COUNT"];

      global $APPLICATION;
      $APPLICATION->SetTitle(GetMessage("COUNT", ["#CNT#" => $countItems]));

      $this->includeComponentTemplate();
    } else {
      $this->abortResultCache();
    }
  }
}
