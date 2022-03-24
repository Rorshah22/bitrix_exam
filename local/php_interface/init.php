<?

use Bitrix\Main\Loader;

// define("LOG_FILENAME", $_SERVER["DOCUMENT_ROOT"] . "/log.txt");

Loader::registerNamespace(
  "Manao\\Curs",
  Loader::getDocumentRoot() . "/local/manao/lib/"
);

function testAgent()
{
  CBitrixComponent::includeComponentClass('currency:curs');
  Curs::getCursAction();
  return "testAgent();";
}
