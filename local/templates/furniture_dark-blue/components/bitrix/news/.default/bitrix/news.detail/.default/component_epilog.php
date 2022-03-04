<?php

if (isset($arResult["CANONICAL_NAME"])) {

  $APPLICATION->SetPageProperty("canonical",  $arResult["CANONICAL_NAME"]);
}
