<?php
namespace Paladins;

class Paladins {

    private $devId;
    private $authKey;
    private $format;
    private $lang;

    private $baseURL = 'http://api.paladins.com/paladinsapi.svc';

    public function __construct($devId, $authKey, $format = "json", $lang = 1) {
        $this->devId = $devId;
        $this->authKey = $authKey;
        $this->format = $format;
        $this->lang = $lang;


    }
}
