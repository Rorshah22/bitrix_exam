<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

$arComponentParameters = array(
  "PARAMETERS" => array(
    "CATALOG_IBLOCK_ID" => [
      "NAME" => Loc::getMessage("CATALOG_IBLOCK_ID"),
      "PARENT" => "BASE",
      "TYPE" => "STRING",
    ],
    "CLASSIFIER_IBLOCK_ID" => [
      "NAME" => Loc::getMessage("CLASSIFIER_IBLOCK_ID"),
      "PARENT" => "BASE",
      "TYPE" => "STRING",
    ],
    "LINK_TEMPLATE_DETAILED_PREVIEWS" => [
      "NAME" => Loc::getMessage("LINK_TEMPLATE_DETAILED_PREVIEWS"),
      "PARENT" => "BASE",
      "TYPE" => "STRING",
    ],
    "CODE_PROPERTY_ITEM" => [
      "NAME" => Loc::getMessage("CODE_PROPERTY_ITEM"),
      "PARENT" => "BASE",
      "TYPE" => "STRING",
    ],
    "CACHE_TIME"  =>  ["DEFAULT" => 36000000],

  ),


);
