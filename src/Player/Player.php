<?php
/**
 * Created by PhpStorm.
 * User: Bennet
 * Date: 12/10/2017
 * Time: 3:25 PM
 */

namespace Paladins\Player;

/**
 * Class Player
 * @package Paladins\Player
 * @author Bennet Gallein
 */
class Player {

    /**
     * @var string
     */
    private $created_date;
    /**
     * @var int
     */
    private $id;
    /**
     * @var string
     */
    private $last_login;
    /**
     * @var int
     */
    private $leaves;
    /**
     * @var int
     */
    private $losses;
    /**
     * @var int
     */
    private $materylevel;
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $personal_status;
    /**
     * @var RankedConquest
     */
    private $ranked;
    /**
     * @var string
     */
    private $region;
    /**
     * @var int
     */
    private $teamid;
    /**
     * @var string
     */
    private $teamname;
    /**
     * @var string
     */
    private $tier_conquest;
    /**
     * @var int
     */
    private $total_worshippers;
    /**
     * @var int
     */
    private $wins;

    /**
     * Player constructor.
     * @param $player
     */
    public function __construct($player) {

        $this->created_date = $player['Created_Datetime'];
        $this->id = $player['Id'];
        $this->last_login = $player['Last_Login_Datetime'];
        $this->leaves = $player['Leaves'];
        $this->losses = $player['Losses'];
        $this->materylevel = $player['MateryLevel'];
        $this->name = $player['Name'];
        $this->personal_status = $player['Personal_Status_Message'];
        $this->ranked = new RankedConquest($player['RankedConquest']);
        $this->region = $player['Region'];
        $this->teamid = $player['TeamId'];
        $this->teamname = $player['Team_Name'];
        $this->tier_conquest = $player['Tier_Conquest'];
        $this->total_worshippers = $player['Total_Worshippers'];
        $this->wins = $player['Wins'];

    }

    /**
     * @return mixed
     */
    public function getCreatedDate() {
        return $this->created_date;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getLastLogin() {
        return $this->last_login;
    }

    /**
     * @return mixed
     */
    public function getLeaves() {
        return $this->leaves;
    }

    /**
     * @return mixed
     */
    public function getLosses() {
        return $this->losses;
    }

    /**
     * @return mixed
     */
    public function getMaterylevel() {
        return $this->materylevel;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPersonalStatus() {
        return $this->personal_status;
    }

    /**
     * @return RankedConquest
     */
    public function getRanked() {
        return $this->ranked;
    }

    /**
     * @return mixed
     */
    public function getRegion() {
        return $this->region;
    }

    /**
     * @return mixed
     */
    public function getTeamid() {
        return $this->teamid;
    }

    /**
     * @return mixed
     */
    public function getTeamname() {
        return $this->teamname;
    }

    /**
     * @return mixed
     */
    public function getTierConquest() {
        return $this->tier_conquest;
    }

    /**
     * @return mixed
     */
    public function getTotalWorshippers() {
        return $this->total_worshippers;
    }

    /**
     * @return mixed
     */
    public function getWins() {
        return $this->wins;
    }

}