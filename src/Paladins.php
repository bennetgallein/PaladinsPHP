<?php
namespace Paladins;

class Paladins {

    private $devId;
    private $authKey;
    private $format;
    private $lang;

    public function __construct($devId, $authKey, $format, $lang) {
        $this->devId = $devId;
        $this->authKey = $authKey;
        $this->format = $format;
        $this->lang = $lang;
    }
}
