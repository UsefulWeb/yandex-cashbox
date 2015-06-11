<?php 
namespace usefulweb\YandexCashbox;

use \DOMDocument;

class YandexCashbox
{
  const DEMO_URL = 'https://demomoney.yandex.ru/eshop.xml';
  const URL = 'https://money.yandex.ru/eshop.xml';

  const CODE_SUCCESS = 0;
  const CODE_AUTH_ERROR = 1;
  const CODE_TRANSFER_ERROR = 100;
  const CODE_RESPONSE_ERROR = 200;

  const PAYMENT_TYPE_YANDEX_MONEY = 'PC';
  const PAYMENT_TYPE_CARD = 'AC';
  const PAYMENT_TYPE_TERMINAL = 'GP';
  const PAYMENT_TYPE_PHONE = 'MC';
  const PAYMENT_TYPE_WEBMONEY = 'WM';
  const PAYMENT_TYPE_SBERBANK = 'SB';
  const PAYMENT_TYPE_MPOS = 'MP';
  const PAYMENT_TYPE_MASTERPASS = 'MA';

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

  function returnAviso($code, $performedDatetime=null) {
    $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><paymentAvisoResponse />', LIBXML_NOERROR|LIBXML_ERR_NONE|LIBXML_ERR_FATAL);
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

    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->appendChild($dom->importNode(dom_import_simplexml($xml), true));
    $dom->formatOutput = true;

    return $xml->saveXML();
  }

  function returnCheckOrderResponse($code, $performedDatetime=null, $message=null) {
    $xml = new \SimpleXMLElement('<?xml version="1.0" encoding="UTF-8" ?><checkOrderResponse />', LIBXML_NOERROR|LIBXML_ERR_NONE|LIBXML_ERR_FATAL);
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
    $xml->addAttribute('message', $message);
    $xml->addAttribute('shopId', $this->_shop_id);

    $dom = new DOMDocument('1.0', 'UTF-8');
    $dom->appendChild($dom->importNode(dom_import_simplexml($xml), true));
    $dom->formatOutput = true;

    return $xml->saveXML();
  }

}
?>