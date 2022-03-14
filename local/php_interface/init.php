<?php

use Bitrix\Main\EventManager;


$eventManager = EventManager::getInstance();
$eventManager->addEventHandler('main', 'OnProlog', ['MetaData', 'getSearchMeta']);

class MetaData
{
  const IBLOCK_ID_METATAG = 6;

  public function getSearchMeta()
  {

    global $APPLICATION;
    $section = $APPLICATION->GetCurDir();

    if (\Bitrix\Main\Loader::includeModule('iblock')) {

      $arSelect = ['IBLOCK_ID', 'ID',  'PROPERTY_UF_TITLE', 'PROPERTY_UF_DESCRIPTION'];
      $arFilter = ['IBLOCK_ID' => self::IBLOCK_ID_METATAG, 'NAME' => $section];

      $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

      if ($ar = $res->Fetch()) {

        $APPLICATION->SetPageProperty('title', $ar["PROPERTY_UF_TITLE_VALUE"]);
        $APPLICATION->SetPageProperty('description', $ar["PROPERTY_UF_DESCRIPTION_VALUE"]);
      }
    }
  }
}
