<?php
namespace Paladins;


/**
 * Class Paladins
 * @package Paladins
 * @author Bennet Gallein
 */
class Paladins {

    const ENGLISH = 1;
    const GERMAN = 2;
    const FRENCH = 3;
    const SPANISH = 7;
    const SPANISHLA = 9;
    const PORTUGUESE = 10;
    const RUSSIAN = 11;
    const POLISH = 12;
    const TURKISH = 13;


    const JSON = 'Json';
    const XML = 'xml';

    /**
     * @var int $session_id
     */
    private $session_id;

    /**
     * @var int $devId
     */
    private $devId;
    /**
     * @var string $authKey
     */
    private $authKey;
    /**
     * @var string $format
     */
    private $format;
    /**
     * @var int $lang
     */
    private $lang;

    /**
     * @var string $baseURL
     */
    private $baseURL = 'http://api.paladins.com/paladinsapi.svc';


    /**
     * Paladins constructor.
     * @param $devId
     * @param $authKey
     * @param string $format
     * @param int $lang
     */
    public function __construct($devId, $authKey, $format = Paladins::JSON, $lang = Paladins::ENGLISH) {

        date_default_timezone_set('UTC');

        $this->devId = $devId;
        $this->authKey = $authKey;
        $this->format = $format;
        $this->lang = $lang;
    }

    /**
     * @return mixed
     */
    public function ping() {
        return $this->req("ping" . $this->format);
    }

    /**
     * connection function
     */
    public function connect() {
        // implement loading from session out of mysql database
        if (!apcu_exists("paladins_session_string")) {
            $session = $this->req("createsession" . $this->format . "/" . $this->devId . "/" . $this->getSignature("createsession") . "/" . $this->getTimestamp());
            apcu_store("paladins_session_string", $session['session_id'], 900); // 900 seconds = 60 * 15 ^= 15 mins.
            $this->session_id = $session['session_id'];
        } else {
            $this->session_id = apcu_fetch("paladins_session_string");
        }
    }

    /**
     * @return mixed
     */
    public function testSession() {
        return $this->req("testsession" . $this->format . "/" . $this->devId . "/" . $this->getSignature("testsession") . "/" . $this->session_id . "/" . $this->getTimestamp());
    }

    /**
     * @return mixed
     */
    public function getServerStatus() {
        return $this->req("gethirezserverstatus" . $this->format . "/" . $this->devId . "/" . $this->getSignature("gethirezserverstatus") . "/" . $this->session_id . "/" . $this->getTimestamp())[0];
    }

    /**
     * @return mixed
     */
    public function getDataUsed() {
        return $this->req("getdataused" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getdataused") . "/" . $this->session_id . "/" . $this->getTimestamp());
    }

    /**
     * @return mixed
     */
    private function req($url) {

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

    /**
     * @return mixed
     */
    public function getSignature($reqType) {
        return md5($this->devId . $reqType . $this->authKey . $this->getTimestamp());
    }

    /**
     * @return mixed
     */
    public function getChampions() {
        return $this->req("getchampions" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getchampions") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $this->lang);
    }

    /**
     * @return mixed
     */
    public function getChampionSkins($id) {
        return $this->req("getchampionskins" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getchampionskins") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $id . "/" . $this->lang);
    }

    /**
     * @return mixed
     */
    public function getChampion($name) {
        $champions = $this->req("getchampions" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getchampions") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $this->lang);
        foreach($champions as $champion => $value) {
            if ($value['Name'] == $name) {
                return $value;
            }
        }
        return "No Champion with that name found!";
    }

    /**
     * @return mixed
     */
    public function getPlayer($player) {
        return ($this->req("getplayer" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getplayer") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $player)[0]);
    }

    /**
     * @return mixed
     */
    public function getPlayerLoadouts($playerId) {
        return $this->req("getplayerloadouts" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getplayerloadouts") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $playerId . "/" . $this->lang);
    }

    /**
     * @return mixed
     */
    public function getPlayerStatus($player) {
        return $this->req("getplayerstatus" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getplayerstatus") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $player)[0];
    }
    /**
    * @return mixed
    */
    public function getTeamDetails($clanid) {
        return $this->req("getteamdetails" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getteamdetails") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $clanid);
    }
    /**
     * @return mixed
     */
    public function searchTeams($clanname) {
        return $this->req("searchteams" . $this->format . "/" . $this->devId . "/" . $this->getSignature("searchteams") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $clanname);
    }
    /**
     * @return mixed
     */
    public function getFriends($player) {
        return $this->req("getfriends" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getfriends") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $player);
    }

    /**
     * @return mixed
     */
    public function getGodRanks($player) {
        return $this->req("getgodranks" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getgodranks") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $player);
    }

    /**
     * @return mixed
     */
    public function getChampionRanks($player) {
        return $this->req("getchampionranks" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getchampionranks") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $player);
    }

    /**
     * @return mixed
     */
    public function getItems() {
        return $this->req("getitems". $this->format . "/" . $this->devId . "/" . $this->getSignature("getitems") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/"  . $this->lang);
    }

    /**
     * @return mixed
     */
    public function getTimestamp() {
        return gmdate('YmdHis');
    }

    /**
     * @return mixed
     */
    public function getSessionID() {
        return $this->session_id;
    }
}
