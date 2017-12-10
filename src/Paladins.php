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

    private $link;

    public function __construct($devId, $authKey, $format = Paladins::JSON, $lang = Paladins::ENGLISH, $host = "localhost", $user = "root", $password = "root", $database = "PaladinsAPI") {

        date_default_timezone_set('UTC');

        $this->link = mysqli_connect($host, $user, $password, $database);
        mysqli_query($this->link, "SET names UTF8");
        $query = "SHOW TABLES LIKE 'sessions'";
        $res = mysqli_query($this->link, $query);
        if ($res->num_rows != 1) {
            $query = "CREATE TABLE sessions
                        (
                          `id`      INT AUTO_INCREMENT
                            PRIMARY KEY,
                          sessionid  VARCHAR(32)                         NOT NULL,
                        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL
                        );";
            $result = mysqli_query($this->link, $query);
            if (!$result) echo "MySQL Error!";
        }

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
        // implement loading from session out of mysql database
        $query = "SELECT * FROM sessions WHERE created_at > date_sub(now(), interval 14 minute)";
        $result = mysqli_query($this->link, $query);
        if ($result) {
            if ($result->num_rows == 1) {
                while($row = $result->fetch_object()) {
                    $this->session_id = $row->sessionid;
                }
            } else if ($result->num_rows == 0) {
                $session = $this->req("createsession" . $this->format . "/" . $this->devId . "/" . $this->getSignature("createsession") . "/" . $this->getTimestamp());
                $query = "INSERT INTO sessions (sessionid) VALUES ('" . $session['session_id'] . "');";
                $res = mysqli_query($this->link, $query);
                if ($res) {
                    $this->session_id = $session['session_id'];
                } else {
                    echo "Error saving the session key." . mysqli_error($this->link);
                }
            }
        } else {
            echo "Error:" . mysqli_error($this->link);
        }
    }
    public function testSession() {
        return $this->req("testsession" . $this->format . "/" . $this->devId . "/" . $this->getSignature("testsession") . "/" . $this->session_id . "/" . $this->getTimestamp());
    }

    public function getServerStatus() {
        return $this->req("gethirezserverstatus" . $this->format . "/" . $this->devId . "/" . $this->getSignature("gethirezserverstatus") . "/" . $this->session_id . "/" . $this->getTimestamp())[0];
    }
    public function getDataUsed() {
        return $this->req("getdataused" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getdataused") . "/" . $this->session_id . "/" . $this->getTimestamp());
    }
    private function req($url) {
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
    public function getChampionSkins($id) {
        return $this->req("getchampionskins" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getchampionskins") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $id . "/" . $this->lang);
    }
    public function getChampion($name) {
        $champions = $this->req("getchampions" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getchampions") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $this->lang);
        foreach($champions as $champion => $value) {
            if ($value['Name'] == $name) {
                return $value;
            }
        }
        return "No Champion with that name found!";
    }
    public function getPlayer($player) {
        return $this->req("getplayer" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getplayer") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $player)[0];
    }
    public function getPlayerLoadouts($playerId) {
        return $this->req("getplayerloadouts" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getplayerloadouts") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $playerId . "/" . $this->lang);
    }
    public function getPlayerStatus($player) {
        return $this->req("getplayerstatus" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getplayerstatus") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $player)[0];
    }
    public function getFriends($player) {
        return $this->req("getfriends" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getfriends") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $player);
    }
    public function getGodRanks($player) {
        return $this->req("getgodranks" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getgodranks") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $player);
    }
    public function getChampionRanks($player) {
        return $this->req("getchampionranks" . $this->format . "/" . $this->devId . "/" . $this->getSignature("getchampionranks") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/" . $player);
    }
    public function getItems() {
        return $this->req("getitems". $this->format . "/" . $this->devId . "/" . $this->getSignature("getitems") . "/" . $this->session_id . "/" . $this->getTimestamp() . "/"  . $this->lang);
    }
    public function getTimestamp() {
        return gmdate('YmdHis');
    }
    public function getSessionID() {
        return $this->session_id;
    }
}
