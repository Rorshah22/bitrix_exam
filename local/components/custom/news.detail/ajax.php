<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

use Bitrix\Main\Engine\Controller;


class ResponseReportController extends Controller
{



  public function reportAction($name)
  {
    return $name;
  }
}
