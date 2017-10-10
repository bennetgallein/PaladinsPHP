<?php
namespace Paladins;

class Paladins {

    // language codes
    const ENGLISH = 1;
    const GERMAN = 2;
    const FRENCH = 3;
    const SPANISH = 7;
    const SPANISHLA = 9;
    const PORTUGUESE = 10;
    const RUSSIAN = 11;
    const POLISH = 12;
    const TURKISH = 13;

    // Response Formats
    const JSON = 'Json';
    const XML = 'xml';

    private $timestamp;
    private $session_id;

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
        $session =  $this->req("createsession" . $this->format . "/" . $this->devId . "/" . $this->getSignature("createsession") . "/" . $this->getTimestamp());
        // WIP
        if ($session['ret_msg'] === "Approved") {
            $this->session_id = $session['session_id'];
            $this->timestamp = $session['timestamp'];
        } else {
            return "Failed to get a session ID.";
        }
    }
    public function req($url) {
        if (isset($this->timestamp)) {
            if (strtotime($this->timestamp) < strtotime("-15 minutes")) {
                $this->connect();
            }
        }
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
    public function getChampions() {
        return $this->req("getchampions" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getchampions") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $this->lang);
    }
    public function getChampion($name) {
        $champions = $this->req("getchampions" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getchampions") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $this->lang);
        foreach($champions as $champion => $value) {
            if ($value['Name'] === $name) {
                return $value;
            }
        }
        return "No Champion with that name found!";
    }
    public function getTimestamp() {
        //$date = new \DateTime();
        return gmdate('YmdHis');
    }
}
