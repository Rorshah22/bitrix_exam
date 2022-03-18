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
		"LINK_TEMPLATE_DETAILED_PREVIEWS" => "#SITE_DIR#/products/#SECTION_ID#/#ID#/",
		"CODE_PROPERTY_ITEM" => "FIRMA",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_GROUPS" => "Y",
		"TEMPLATE" => "catalog_exam/#SECTION_ID#/#ELEMENT_CODE#"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>