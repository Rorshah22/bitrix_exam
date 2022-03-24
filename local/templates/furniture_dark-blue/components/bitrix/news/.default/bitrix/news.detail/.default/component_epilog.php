<?

use Bitrix\Main\Application;
use Bitrix\Main\Engine\CurrentUser;

// use Bitrix\Main\Engine\CurrentUser;

$request = Application::getInstance()->getContext()->getRequest();
$id = $request->getQuery('ID');
settype($id, 'integer');

if (isset($id) && $id !== 0) {

  CBitrixComponent::includeComponentClass('custom:news.detail');

  $arGet = ['id' => $id];

  $result = ResponseReportController::reportAction($arGet, CurrentUser::get());

  echo "<span id='response-text-get' data-res=" . $result . "></span>";
}
