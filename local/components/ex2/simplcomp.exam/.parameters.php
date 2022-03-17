<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
$arComponentParameters = array(
	"PARAMETERS" => array(
		"NEWS_IBLOCK_ID" => array(
			"NAME" => GetMessage("NEWS_IBLOCK_ID"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
		),
		"AUTHOR" => array(
			"NAME" => GetMessage("AUTHOR"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
		),
		"TYPE_AUTHOR" => array(
			"NAME" => GetMessage("TYPE_AUTHOR"),
			"PARENT" => "BASE",
			"TYPE" => "STRING",
		),
		"CACHE_TIME"  =>  array("DEFAULT" => 36000000),
	),
);
