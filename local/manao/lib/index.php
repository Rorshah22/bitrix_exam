<?
require($_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php");

use Bitrix\Main\Application;
use Bitrix\Main\Entity\Base;
use Manao\Curs\CurrentCurs;
//добавить таблицу
// if (!Application::getConnection()->isTableExists(Base::getInstance('Manao\Curs\CursTable')->getDBTableName())) {
//   Base::getInstance('Manao\Curs\CursTable')->createDBTable();
// }

//удалить таблицу
// Application::getConnection(Manao\Curs\CursTable::getConnectionName())->queryExecute('drop table if exists ' . Base::getInstance('Manao\Curs\CursTable')->getDBTableName());
$obj = new CurrentCurs;
$res = $obj->addCursInTable();
// foreach ($res as $key => $value) {
//   # code...
echo '<pre>';
print_r($res);
echo '</pre>';
// }
