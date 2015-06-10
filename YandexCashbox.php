<?php 
namespace usefulweb;

use \DOMDocument;

class YandexCashbox
{
  const URL = 'https://demomoney.yandex.ru/eshop.xml';
  const DEMO_URL = 'https://money.yandex.ru/eshop.xml';

  const AVISO_CODE_SUCCESS = 0;
  const AVISO_CODE_AUTH_ERR = 1;
  const AVISO_CODE_TRANSFER_ERR = 100;
  const AVISO_CODE_RESPONSE_ERR = 200;

  private $_shop_id;
  private $_scid;

  function setShopId(integer $shop_id) {
    $this->_shop_id = $shop_id;

    return $this;
  }

  function setScid(integer $scid) {
    $this->_scid = $scid;

    return $this;
  }

  function returnAviso(integer $code, $performedDatetime=null) {
    $xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><paymentAvisoResponse />', LIBXML_NOERROR|LIBXML_ERR_NONE|LIBXML_ERR_FATAL);

    $invoiceId = null;

    if ($performedDatetime == null) {
      $performedDatetime = date('c');
    }
    
    if (isset($_POST['invoiceId'])) {
      $invoiceId = $_POST['invoiceId'];
    }

    $xml->addAttribute('performedDatetime', $performedDatetime);
    $xml->addAttribute('code', $code);
    $xml->addAttribute('invoiceId', $invoiceId);
    $xml->addAttribute('shopId', $this->_shop_id);

    return $dom->saveXML();
  }

}
?>