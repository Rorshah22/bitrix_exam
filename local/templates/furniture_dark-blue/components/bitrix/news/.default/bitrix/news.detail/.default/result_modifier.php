<?php

if (!empty($arParams["ID_INFO_BLOCK_CANONICAL"])) {

  $arSelect = ["ID", "IBLOCK_ID", "NAME", "PROPERTY_NEW"];

  $arFilter = ["IBLOCK_ID" => $arParams["ID_INFO_BLOCK_CANONICAL"], "PROPERTY_NEW" => $arResult["ID"], "ACTIVE" => "Y"];

  $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

  if ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arResult["CANONICAL_NAME"] = $arFields["NAME"];
    $this->__component->setResultCacheKeys(["CANONICAL_NAME"]);
  }
}
