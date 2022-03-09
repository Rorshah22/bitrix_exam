<?php

if (!empty($arParams["ID_INFO_BLOCK_CANONICAL"])) {

  $arSelect = ["ID", "IBLOCK_ID", "NAME", "PROPERTY_NEWS"];

  $arFilter = ["IBLOCK_ID" => $arParams["ID_INFO_BLOCK_CANONICAL"], "PROPERTY_NEWS" => $arResult["ID"], "ACTIVE" => "Y"];

  $res = CIBlockElement::GetList([], $arFilter, false, false, $arSelect);

  while ($ob = $res->GetNextElement()) {
    $arFields = $ob->GetFields();
    $arResult["CANONICAL_NAME"] = $arFields["NAME"];
    $this->__component->setResultCacheKeys(["CANONICAL_NAME"]);
  }
}
