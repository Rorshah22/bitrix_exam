<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Простой компонент");
?><?$APPLICATION->IncludeComponent(
	"ex2:simplcomp.exam", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default",
		"NEWS_IBLOCK_ID" => "1",
		"AUTHOR" => "AUTHOR",
		"TYPE_AUTHOR" => "UF_AUTHOR_TYPE",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>