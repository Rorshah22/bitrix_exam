<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>
<p><b><?= Loc::getMessage("SIMPLECOMP_EXAM2_CAT_TITLE") ?></b></p>


<? foreach ($arResult["NEWS"] as $key => $res) : ?>
  <ul>
    <li><b> <?= $res["NAME"] ?> </b> - <?= $res["ACTIVE_FROM"] ?>
      (
      <? $i = '';
      foreach ($res["SECTION"] as $section) {
        echo  $i . $section["NAME_SECTION"];
        $i = ", ";
      }
      ?>
      )
      <ul>
        <? foreach ($res["ITEM"] as $arItem) :  ?>
          <? foreach ($arItem as $item) :  ?>
            <li>
              <?= $item["NAME"] ?> -
              <?= $item["PROPERTY_PRICE_VALUE"] ?> -
              <?= $item["PROPERTY_MATERIAL_VALUE"] ?> -
              <?= $item["PROPERTY_ARTNUMBER_VALUE"] ?>
            </li>
          <? endforeach; ?>
        <? endforeach; ?>

      </ul>
    </li>
  </ul>

<? endforeach; ?>
<!-- <? echo "<pre>";
      print_r($arResult); ?> -->