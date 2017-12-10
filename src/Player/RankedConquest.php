<?php
/**
 * Created by PhpStorm.
 * User: Bennet
 * Date: 12/10/2017
 * Time: 3:32 PM
 */

namespace Paladins\Player;

/**
 * Class RankedConquest
 * @package Paladins\Player
 * @author Bennet Gallein
 */
class RankedConquest {

    /**
     * @var int
     */
    private $leaves;
    /**
     * @var int
     */
    private $losses;
    /**
     * @var string
     */
    private $name;
    /**
     * @var int
     */
    private $points;
    /**
     * @var int
     */
    private $prevRank;
    /**
     * @var string
     */
    private $rank;
    /**
     * @var string
     */
    private $rank_stat_conquest;
    /**
     * @var string
     */
    private $rank_stat_duel;
    /**
     * @var string
     */
    private $rank_stat_joust;
    /**
     * @var int
     */
    private $season;
    /**
     * @var int
     */
    private $tier;
    /**
     * @var int
     */
    private $trend;
    /**
     * @var int
     */
    private $wins;
    /**
     * @var int
     */
    private $playerid;

    /**
     * RankedConquest constructor.
     * @param $data
     */
    public function __construct($data) {
        $this->leaves = $data['Leaves'];
        $this->losses = $data['Losses'];
        $this->name = $data['Name'];
        $this->points = $data['Points'];
        $this->prevRank = $data['PrevRank'];
        $this->rank = $data['Rank'];
        $this->rank_stat_conquest = $data['Rank_Stat_Conquest'];
        $this->rank_stat_duel = $data['Rank_Stat_Duel'];
        $this->rank_stat_joust = $data['Rank_Stat_Joust'];
        $this->season = $data['Season'];
        $this->tier = $data['Tier'];
        $this->trend = $data['Trend'];
        $this->wins = $data['Wins'];
        $this->playerid = $data['player_id'];
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
    public function getName() {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getPoints() {
        return $this->points;
    }

    /**
     * @return mixed
     */
    public function getPrevRank() {
        return $this->prevRank;
    }

    /**
     * @return mixed
     */
    public function getRank() {
        return $this->rank;
    }

    /**
     * @return mixed
     */
    public function getRankStatConquest() {
        return $this->rank_stat_conquest;
    }

    /**
     * @return mixed
     */
    public function getRankStatDuel() {
        return $this->rank_stat_duel;
    }

    /**
     * @return mixed
     */
    public function getRankStatJoust() {
        return $this->rank_stat_joust;
    }

    /**
     * @return mixed
     */
    public function getSeason() {
        return $this->season;
    }

    /**
     * @return mixed
     */
    public function getTier() {
        return $this->tier;
    }

    /**
     * @return mixed
     */
    public function getTrend() {
        return $this->trend;
    }

    /**
     * @return mixed
     */
    public function getWins() {
        return $this->wins;
    }

    /**
     * @return mixed
     */
    public function getPlayerid() {
        return $this->playerid;
    }
}