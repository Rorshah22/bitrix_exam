<?php

if (!empty($arParams["ID_INFO_BLOCK_CANONICAL"])) {

  $arSelect = ["ID", "IBLOCK_ID", "NAME"];

  $arFilter = ["IBLOCK_ID" => $arParams["ID_INFO_BLOCK_CANONICAL"], "PROPERTY_NEWS" => $arResult["ID"], "ACTIVE" => "Y"];

  $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

  if ($ob = $res->Fetch()) {
    $arResult["CANONICAL_NAME"] = $ob["NAME"];
    $this->__component->setResultCacheKeys(["CANONICAL_NAME"]);
  }
}
