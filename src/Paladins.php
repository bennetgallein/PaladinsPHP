<?php
namespace Paladins;

class Paladins {



    private $devId;
    private $authKey;
    private $format;
    private $lang;

    private $baseURL = 'http://api.paladins.com/paladinsapi.svc';

    public function __construct($devId, $authKey, $format = "json", $lang = 1) {

        date_default_timezone_set('UTC');

        $this->devId = $devId;
        $this->authKey = $authKey;
        $this->format = $format;
        $this->lang = $lang;
    }
    /* API METHODS */
    public function ping() {
        return $this->req("ping" . $this->format);
    }
    public function connect() {
        return $this->req("createsession" . $this->format . "/" . $this->devId . "/" . $this->getSignature("createsession") . "/" . $this->getTimestamp());
    }
    public function req($url) {
        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL => $this->baseURL . "/" . $url,
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_FOLLOWLOCATION => 1,
            CURLOPT_VERBOSE        => 1,
            CURLOPT_SSL_VERIFYPEER => 0
        ));
        $data = curl_exec($ch);
        curl_close($ch);
        $data = json_decode($data, true);
        return $data;
    }
    public function getSignature($reqType) {
        return md5($this->devId . $reqType . $this->authKey . $this->getTimestamp());
    }
    public function getTimestamp() {
        //$date = new \DateTime();
        return gmdate('YmdHis');
    }
}
