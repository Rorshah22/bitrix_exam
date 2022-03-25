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
      <td style="text-align: end"><?= $item["CURRENCY"] ?></td>
      <td style="text-align: end"><?= $item["RATE"] ?></td>
      <td style="text-align: end"><?= $item["DATE"]->format("d.m.Y") ?></td>
    </tr>

  <? endforeach; ?>
</table>
<br>
<button id="reload-data">Обновить данные</button>