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
    "TEMPLATE" => [
      "NAME" => Loc::getMessage("LINK_TEMPLATE_DETAILED_PREVIEWS"),
      "PARENT" => "BASE",
      "TYPE" => "STRING",
    ],
    "CODE_PROPERTY_ITEM" => [
      "NAME" => Loc::getMessage("CODE_PROPERTY_ITEM"),
      "PARENT" => "BASE",
      "TYPE" => "STRING",
    ],
    "CACHE_GROUPS" => array(
      "PARENT" => "CACHE_SETTINGS",
      "NAME" => Loc::getMessage("CP_BC_CACHE_GROUPS"),
      "TYPE" => "CHECKBOX",
      "DEFAULT" => "Y",
    ),
    "CACHE_TIME"  =>  ["DEFAULT" => 36000000],

  ),


);
