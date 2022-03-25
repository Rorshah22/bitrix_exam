<?

namespace Manao\Curs;

use Manao\Curs\CursTable,
  Bitrix\Main\Type\DateTime;

class CurrentCurs
{

  private int $countItems;

  public function getCursOnURl()
  {
    $ch = curl_init('https://www.nbrb.by/api/exrates/rates?periodicity=0');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HEADER, false);
    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result, true);
    return $result;
  }

  public function addCursInTable()
  {
    $res = $this->getCursOnURl();

    $this->countItems = count($res);

    if ($dateTime = CursTable::getList(['order' => ['ID' => 'DESC'], "select" => ["DATE"]],)->fetch()) {
      $dateTime = $dateTime["DATE"]->getTimestamp();
    }


    foreach ($res as $value) {

      if ($dateTime === strtotime($value["Date"])) {

        break;
      }

      if ($value['Cur_Scale'] !== 1) {
        $value["Cur_OfficialRate"] = $value["Cur_OfficialRate"] / $value['Cur_Scale'];
      }

      CursTable::add([
        "CURRENCY" => $value["Cur_Abbreviation"],
        "RATE" => $value["Cur_OfficialRate"],
        "DATE" => new DateTime($value["Date"], "Y-m-d H:i:s")
      ]);
    }
  }

  public function getCurs()
  {
    $this->addCursInTable();
    return CursTable::getList(['order' => ['ID' => 'DESC'], "select" => ["*"], 'limit' => $this->countItems])->fetchAll();
  }
}
