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
            <a href="<?= $item["DETAIL_PAGE_URL"] ?>">ссылка на детальный просмотр</a>
          </li>

        <? endforeach; ?>
      </ul>
    </li>


  <? endforeach; ?>
</ul>

<? $this->SetViewTarget("min_price"); ?>

<div style="color:red; margin: 34px 15px 35px 15px">Минимальная цена: <?= $arResult["PRICE"]["MIN"] ?></div>
<div style="color:red; margin: 34px 15px 35px 15px">Максимальная цена: <?= $arResult["PRICE"]["MAX"] ?></div>

<? $this->EndViewTarget(); ?>