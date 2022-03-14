<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

$arComponentParameters = array(
	"PARAMETERS" => array(
		"PRODUCTS_IBLOCK_ID" => [
			"NAME" => Loc::getMessage("SIMPLECOMP_EXAM2_CAT_IBLOCK_ID"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
		],
		"NEWS_IBLOCK_ID" => [
			"NAME" => Loc::getMessage("NEWS_IBLOCK_ID"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
		],
		"CODE_USER_PROPERTY" => [
			"NAME" => Loc::getMessage('CODE_USER_PROPERTY'),
			"PARENT" => "BASE",
			"TYPE" => 'STRING'
		],
		"CACHE_TIME"  =>  ["DEFAULT" => 36000000],

	),


);
