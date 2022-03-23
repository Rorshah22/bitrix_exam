<?

use Bitrix\Main\Application;

$request = Application::getInstance()->getContext()->getRequest();
$id = $request->getQuery('ID');

if (isset($id) && intval($id) !== 0) {
  require($_SERVER["DOCUMENT_ROOT"] . "/local/components/custom/news.detail/ajax.php");

  settype($id, 'integer');
  $arGet = ['id' => $id];

  $response = new ResponseReportController();
  $result = $response->reportAction($arGet);

  echo "<span id='response-text-get' data-res=" . $result . "></span>";
}
