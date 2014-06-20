<?php

$clientLibraryPath = 'wp-content/plugins/zend-gdata-interfaces';
$oldPath = set_include_path(get_include_path() . PATH_SEPARATOR . $clientLibraryPath);

require_once 'Zend/Loader.php';

Zend_Loader::loadClass('Zend_Gdata_AuthSub');
Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');
Zend_Loader::loadClass('Zend_Gdata_Docs');
//Zend_Loader::loadClass('Zend_Http_Client');
//Zend_Loader::loadClass('Zend_Gdata');
//Zend_Loader::loadClass('Zend_Gdata_ClientLogin');
Zend_Loader::loadClass('Zend_Gdata_Spreadsheets');

  $u = "mailinglist.code2040@gmail.com";
  $e = "code2040_rocks";
  $key = '0AiYOZ4BOkWzLdGFQNDZMUmpGU21PTzVQbURlSV9hc1E';

  $service = Zend_Gdata_Spreadsheets::AUTH_SERVICE_NAME;
  $client = Zend_Gdata_ClientLogin::getHttpClient($u, $e, $service);
  $spreadSheetService = new Zend_Gdata_Spreadsheets($client);

  // if not setting worksheet, `"Sheet1" is assumed
  // $ss->useWorksheet("worksheetName");

  $row = array
    (
     "email" => $_POST['email']
  );
  $ret = $spreadSheetService->insertRow($row, $key);
?>
