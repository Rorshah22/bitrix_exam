<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>
<p><b><?= GetMessage("SIMPLECOMP_EXAM2_CAT_TITLE") ?></b></p>

<ul>
  <? foreach ($arResult["LIST_NEWS"] as $result) : ?>

    <li>
      [<?= $result["AUTHOR"]["ID"]; ?>] -
      <?= $result["AUTHOR"]["LOGIN"]; ?>
      <ul>
        <? foreach ($result["NEWS"] as $news) : ?>
          <li> - <?= $news["NAME"] ?> - <?= $news["DATE_ACTIVE_FROM"] ?> </li>
    </li>

  <? endforeach; ?>

</ul>
</li>

<? endforeach; ?>
</ul>