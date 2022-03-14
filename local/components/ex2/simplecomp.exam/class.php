<?php

if (!defined("B_PROLOG_INCLUDED") && B_PROLOG_INCLUDED !== true) die();

class SimpleComp extends CBitrixComponent
{

  public function onPrepareComponentParams($arParams)
  {
    $result = [];
    var_dump($arParams);
    return $result;
  }


  public function executeComponent()
  {
    $this->includeComponentTemplate();
  }
}
