<?php

use Bitrix\Main\EventManager;

$eventManager = EventManager::getInstance();
$eventManager->addEventHandler("main", "OnEpilog", ["NotFoundPage", "redirect404"]);

class NotFoundPage
{

  public function  redirect404()
  {

    if (defined('ERROR_404') && ERROR_404 === 'Y') {

      global $APPLICATION;
      $APPLICATION->RestartBuffer();

      include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH .   "/header.php");
      include($_SERVER["DOCUMENT_ROOT"] . "/404.php");
      include($_SERVER["DOCUMENT_ROOT"] . SITE_TEMPLATE_PATH .  "/footer.php");

      CEventLog::Add(array(
        "SEVERITY" => "INFO",
        "AUDIT_TYPE_ID" => "ERROR_404",
        "MODULE_ID" => "main",
        "ITEM_ID" => 'NotFoundPage',
        "DESCRIPTION" => $APPLICATION->GetCurPage(),
      ));
    }
  }
}
