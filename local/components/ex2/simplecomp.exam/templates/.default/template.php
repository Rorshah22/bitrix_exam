<?php if (!defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Localization\Loc;
?>
<p><b><?= Loc::getMessage("SIMPLECOMP_EXAM2_CAT_TITLE") ?></b></p>
<ul>

  <? foreach ($arResult["SECTIONS"] as $key => $result) : ?>


    <li>
      <b><?= $result["CLASSIFIER"]["NAME"] ?></b>
      <ul>

        <? foreach ($result["ITEM"] as $item) : ?>
          <li>
            <?= $item["NAME"] ?> -
            <?= $item["PROPERTY_PRICE_VALUE"] ?> -
            <?= $item["PROPERTY_MATERIAL_VALUE"] ?> -
            <?= $item["PROPERTY_ARTNUMBER_VALUE"] ?> -
            (<?= $item["DETAIL_PAGE_URL"] ?>)
          </li>

        <? endforeach; ?>
      </ul>
    </li>


  <? endforeach; ?>
</ul>