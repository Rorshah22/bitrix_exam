<?php

use Bitrix\Main\EventManager;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$eventManager = EventManager::getInstance();
$eventManager->addEventHandler('main', 'OnBeforeEventAdd', ['EditMail', 'sendMail']);

class EditMail
{
  public function sendMail(&$event, &$lid, &$arFields)
  {

    global $USER;

    if ($USER->IsAuthorized()) {
      $arFields['AUTHOR'] = GetMessage('AUTHOR_AUTH', ["#ID#" => $USER->GetID(), "#LOGIN#" => $USER->GetLogin(), "#NAME#" => $USER->GetFirstName(), "#AUTHOR_NAME#" => $arFields['AUTHOR']]);
    } else {
      $arFields['AUTHOR'] = GetMessage("AUTHOR_NOT_AUTH", ["#AUTHOR_NAME#" => $arFields['AUTHOR']]);
    }

    CEventLog::Add(array(
      "SEVERITY" => "INFO",
      "AUDIT_TYPE_ID" => "MAIL",
      "MODULE_ID" => "main",
      "ITEM_ID" => 'Send message',
      "DESCRIPTION" => "Замена данных в отсылаемом письме – " . $arFields['AUTHOR'],
    ));
  }
}
