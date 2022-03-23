<?

use Bitrix\Main\Application;
// use Bitrix\Main\Engine\CurrentUser;

$request = Application::getInstance()->getContext()->getRequest();
$id = $request->getQuery('ID');
settype($id, 'integer');

if (isset($id) && $id !== 0) {

  $arGet = ['id' => $id];

  CBitrixComponent::includeComponentClass('custom:news.detail');
  $result = ResponseReportController::reportAction($arGet);

  echo "<span id='response-text-get' data-res=" . $result . "></span>";
}
