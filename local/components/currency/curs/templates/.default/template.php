<?
if (!defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED !== true) die();
?>
<table border="1">
  <tr>
    <th>№</th>
    <th>буквенный код валюты</th>
    <th>курс за 1 единицу валюты</th>
    <th>дата обновления курса</th>
  </tr>
  <? foreach ($arResult["CURRENT_CURS"] as $key => $item) : ?>

    <tr class="table-curs">

      <td><?= $key + 1 ?></td>
      <td><?= $item["CURRENCY"] ?></td>
      <td><?= $item["RATE"] ?></td>
      <td><?= new \Bitrix\Main\Type\DateTime($item["DATE"]) ?></td>
    </tr>
  <? endforeach; ?>
</table>
<br>
<button id="reload-data">Обновить данные</button>