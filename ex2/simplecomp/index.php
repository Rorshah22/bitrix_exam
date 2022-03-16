<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент");
?><?$APPLICATION->IncludeComponent(
	"ex2:simplecomp.exam", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"CATALOG_IBLOCK_ID" => "2",
		"CLASSIFIER_IBLOCK_ID" => "7",
		"LINK_TEMPLATE_DETAILED_PREVIEWS" => "",
		"CODE_PROPERTY_ITEM" => "FIRMA",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>