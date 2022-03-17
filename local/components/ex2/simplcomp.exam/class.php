<?
if (!defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Loader;


class SimpleComp extends CBitrixComponent
{

  public function onPrepareComponentParams($arParams)
  {
    return [
      "NEWS_IBLOCK_ID" => !empty($arParams["NEWS_IBLOCK_ID"]) ? intval(trim($arParams["NEWS_IBLOCK_ID"])) : 0,
      "AUTHOR" => $arParams["AUTHOR"],
      "TYPE_AUTHOR" => $arParams["TYPE_AUTHOR"],
    ];
  }

  private function getListAuthor()
  {
    $arParams["SELECT"] = [$this->arParams["TYPE_AUTHOR"]];
    $order = ['sort' => "asc"];
    $tmp = 'sort';
    $userList = CUser::GetList($order, $tmp, [], $arParams);

    while ($arr = $userList->Fetch()) {

      $result[] = ["ID" => $arr["ID"], "LOGIN" => $arr["LOGIN"], "UF_AUTHOR_TYPE" => $arr["UF_AUTHOR_TYPE"]];
    }

    return $result;
  }

  private function getListNews()
  {
    // echo "<pre>";

    $arSelect = ["ID", "IBLOCK_ID", "NAME", "DATE_ACTIVE_FROM", "PROPERTY_" . $this->arParams["AUTHOR"]];
    $arFilter = ["IBLOCK_ID" => $this->arParams["NEWS_IBLOCK_ID"], "ACTIVE" => "Y"];

    $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

    while ($arr = $res->Fetch()) {
      $result[] = $arr;
      // print_r($arr);
    }
    return $result;
  }

  private function getCurrentUser()
  {

    if (CUser::IsAuthorized(CUser::GetID())) {

      $order = [];
      $tmp = 'sort';
      $user = CUser::GetList($order, $tmp, ["ID" => CUser::GetID()]);
      if ($res = $user->Fetch()) {
        return ["ID" => $res["ID"], "LOGIN" => $res["LOGIN"], "UF_AUTHOR_TYPE" => $res["UF_AUTHOR_TYPE"]];
      }
    }
  }

  public function resultFormation()
  {
    $listAuthor =   $this->getListAuthor();
    $listNews = $this->getListNews();
    $currentUser = $this->getCurrentUser();

    foreach ($listAuthor as $key => $author) {
      foreach ($listNews as $news) {

        if (intval($author["ID"]) === intval($news["PROPERTY_AUTHOR_VALUE"]) && $currentUser["UF_AUTHOR_TYPE"] == $author["UF_AUTHOR_TYPE"]) {
          $result[$key]["AUTHOR"] = $author;
          $result[$key]["NEWS"][] = $news;
        }
      }
    }
    return $result;
  }

  public function executeComponent()
  {
    global $USER,
      $APPLICATION;

    if (!Loader::includeModule('iblock')) {
      ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
      return;
    }

    if ($this->startResultCache()) {
      $count = 0;
      $this->arResult["LIST_NEWS"] = $this->resultFormation();
      $this->includeComponentTemplate();
    } else {
      $this->abortResultCache();
    }

    $APPLICATION->SetTitle(GetMessage("AMOUNTOFNEWS", ["#COUNT#" => $count]));
  }
}
