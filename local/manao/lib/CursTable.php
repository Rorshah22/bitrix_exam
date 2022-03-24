<?

namespace Manao\Curs;

use Bitrix\Main\Entity;


class CursTable extends Entity\DataManager
{

  public static function getTableName()
  {
    return "hr_rates";
  }

  public static function getMap()
  {
    return [
      new Entity\IntegerField("ID", [
        "primary" => true,
        "autocomplete" => true,
      ]),
      new Entity\StringField("CURRENCY"),
      new Entity\StringField("RATE"),
      new Entity\DatetimeField("DATE"),

    ];
  }
}
