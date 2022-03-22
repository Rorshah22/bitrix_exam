<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Engine\Controller;
use Bitrix\Main\Loader;
use Bitrix\Scale\Action;

class ResponseReportController extends Controller
{

  private const REPORT_IBLOCK_ID = 8;

  public function configureActions()
  {

    return [
      'report' => [
        '-prefilters' => ['\Bitrix\Main\Engine\ActionFilter\Authentication']
      ]
    ];
  }

  public function reportAction(array $fields)
  {
    if (Loader::includeModule("iblock")) {

      $element = new CIBlockElement;

      global $USER;

      if ($USER->IsAuthorized()) {
        $user = "ID: " . CUser::GetID() .  "; Login: " . CUser::GetLogin() . "; Ф.И.О.: " . CUser::GetFullName();
      } else {
        $user = "Не авторизован";
      }

      $arProperty = [
        "USER" => $user,
        "NEWS" => $fields["id"]
      ];

      $arItem = [
        "IBLOCK_ID" => self::REPORT_IBLOCK_ID,
        "NAME" => 'Жалоба',
        "ACTIVE" => "Y",
        "DATE_ACTIVE_FROM" => ConvertTimeStamp(time(), 'FULL'),
        "PROPERTY_VALUES" => $arProperty
      ];

      if ($report = $element->Add($arItem)) {
        return $report;
      }
    }
  }
}
