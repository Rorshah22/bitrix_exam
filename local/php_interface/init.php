<?php

use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", array("CountView", "ShowCounter"));

class CountView
{

  const IBLOCK_ID_PRODUCT = 2;
  const MAX_COUNT = 2;

  function ShowCounter(&$arFields)
  {

    if ($arFields["IBLOCK_ID"] === self::IBLOCK_ID_PRODUCT) {

      if ($arFields["ACTIVE"] === 'N') {

        $arSelect = ["ID", "IBLOCK_ID", "NAME",  "SHOW_COUNTER"];
        $arFilter = ["IBLOCK_ID" => self::IBLOCK_ID_PRODUCT, "ID" => $arFields["ID"]];
        $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);
        $itemCounter = $res->Fetch();

        if ($itemCounter["SHOW_COUNTER"] > self::MAX_COUNT) {

          global $APPLICATION;

          $errorTExt = GetMessage('DEACTIVATION_ERROR', ["#COUNT#" => $itemCounter["SHOW_COUNTER"]]);
          $APPLICATION->throwException($errorTExt);
          return false;
        }
      }
    }
  }
}
