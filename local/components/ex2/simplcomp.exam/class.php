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
      "CACHE_TIME" => !empty($arParams["CACHE_TIME"]) ? $arParams["CACHE_TIME"] : 36000000,
    ];
  }

  private function getListAuthor()
  {
    $arParams["SELECT"] = [$this->arParams["TYPE_AUTHOR"]];
    $order = ['sort' => "asc"];
    $tmp = 'sort';
    $userList = CUser::GetList($order, $tmp, [], $arParams);

    while ($arr = $userList->Fetch()) {

      $result["LIST_AUTHOR"][] = ["ID" => $arr["ID"], "LOGIN" => $arr["LOGIN"], "UF_AUTHOR_TYPE" => $arr["UF_AUTHOR_TYPE"]];
      $result['ID'][] = $arr["ID"];
    }

    return $result;
  }

  private function getListNews()
  {

    $arSelect = [
      "ID",
      "IBLOCK_ID",
      "NAME",
      "DATE_ACTIVE_FROM",
    ];
    $arFilter = [
      "IBLOCK_ID" => $this->arParams["NEWS_IBLOCK_ID"],
      "PROPERTY_" . $this->arParams["AUTHOR"] => $this->getListAuthor()["ID"],
      "ACTIVE" => "Y"
    ];

    //получим свойства из инфоблока новости
    $arProps = [];
    CIBlockElement::GetPropertyValuesArray($arProps, $this->arParams["NEWS_IBLOCK_ID"], [], ["CODE" => $this->arParams["AUTHOR"]]);

    $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

    //сформируюем массив со свойствами
    while ($arr = $res->Fetch()) {

      foreach ($arProps as $key => $prop) {

        if ($arr["ID"] == $key) {
          $result[] = ["ITEM" => $arr, "PROPERTY_" . $this->arParams["AUTHOR"] => $prop["AUTHOR"]["VALUE"]];
        }

        continue;
      }
    }

    return $result;
  }

  private function getCurrentUser()
  {
    global $USER;

    if ($USER->IsAuthorized(CUser::GetID())) {

      $order = [];
      $tmp = 'sort';
      $user =  CUser::GetList($order, $tmp, ["ID" => CUser::GetID()]);

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
    $i = 0;

    foreach ($listAuthor["LIST_AUTHOR"] as $key => $author) {

      foreach ($listNews as $news) {

        if (in_array($currentUser["ID"], $news["PROPERTY_AUTHOR"])) {
          continue;
        }

        if ($currentUser["UF_AUTHOR_TYPE"] == $author["UF_AUTHOR_TYPE"] && in_array($author["ID"], $news["PROPERTY_AUTHOR"])) {
          $result["NEWS"][$key]["AUTHOR"] = $author;
          $result["NEWS"][$key]["NEWS"][] = $news["ITEM"];
          $result["COUNT"] = $i++;
        }
      }
    }

    return $result;
  }

  public function executeComponent()
  {
    global $APPLICATION;

    if (!Loader::includeModule('iblock')) {
      ShowError(GetMessage("SIMPLECOMP_EXAM2_IBLOCK_MODULE_NONE"));
      return;
    }

    if ($this->startResultCache(false, CUser::GetID())) {
      $count = $this->resultFormation()["COUNT"];
      $this->arResult["LIST_NEWS"] = $this->resultFormation()["NEWS"];

      $this->includeComponentTemplate();
    } else {
      $this->abortResultCache();
    }

    $APPLICATION->SetTitle(GetMessage("AMOUNTOFNEWS", ["#COUNT#" => $count]));
  }
}
