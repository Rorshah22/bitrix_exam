<?
if (isset($_GET["ID"]) && intval($_GET["ID"]) !== 0) {
  require($_SERVER["DOCUMENT_ROOT"] . "/local/components/custom/news.detail/ajax.php");

  settype($_GET["ID"], 'integer');

  $arGet = ['id' => $_GET["ID"]];

  $response = new ResponseReportController();
  $result = $response->reportAction($arGet);

  echo "<span id='response-text-get' data-res=" . $result . "></span>";
}
