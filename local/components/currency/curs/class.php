<?
if (!defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED !== true) die();


use Bitrix\Main\Loader;
use Bitrix\Main\Engine\Contract\Controllerable;
use Bitrix\Scale\Action;
use Manao\Curs\CurrentCurs;

class Curs extends CBitrixComponent implements Controllerable
{

  public function configureActions()
  {
    return [];
  }

  public function getCursAction()
  {
    $obj = new CurrentCurs;
    $obj->addCursInTable();
    return array_reverse($obj->getCurs());
  }

  public function executeComponent()
  {
    $obj = new CurrentCurs;
    $res = array_reverse($obj->getCurs());
    if ($this->startResultCache()) {
      $this->arResult['CURRENT_CURS'] = $res;
      $this->includeComponentTemplate();
    }
  }
}
