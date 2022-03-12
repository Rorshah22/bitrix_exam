<?

use Bitrix\Main\EventManager;

$eventManager = EventManager::getInstance();
$eventManager->addEventHandler('main', 'OnBuildGlobalMenu', ['EditMenu', 'getNewMenu']);


class EditMenu
{
  public function getNewMenu(&$aGlobalMenu, &$aModuleMenu)
  {

    global $USER;
    if (!$USER->isAdmin() && CSite::InGroup(array(5))) {

      unset($aGlobalMenu['global_menu_desktop']);
      foreach ($aModuleMenu as $key => $value) {
        if ($value['items_id'] !== "menu_iblock_/news") {
          unset($aModuleMenu[$key]);
        }
      }
    }
  }
}
