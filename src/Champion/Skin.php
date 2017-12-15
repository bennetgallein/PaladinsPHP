<?php
/**
 * Created by PhpStorm.
 * User: Master
 * Date: 11.12.2017
 * Time: 16:55
 */

namespace Paladins\Champion;


class Skin {

    /**
     * @var int
     */
    private $championid;
    /**
     * @var string
     */
    private $championname;
    /**
     * @var int
     */
    private $skinid1;
    /**
     * @var int
     */
    private $skinid2;
    /**
     * Skin constructor.
     * @param $data
     */
    public function __construct($data) {
        $this->championid = $data['champion_id'];
        $this->championname = $data['champion_name'];
        $this->skinid1 = $data['skin_id1'];
        $this->skinid2 = $data['skin_id2'];
        $this->skinname = $data['skin_name'];
    }
    /**
     * @return mixed
     */
    public function getChampionid() {
        return $this->championid;
    }

    /**
     * @return mixed
     */
    public function getChampionname() {
        return $this->championname;
    }

    /**
     * @return mixed
     */
    public function getSkinid1() {
        return $this->skinid1;
    }
        /**
     * @return mixed
     */
    public function getSkinname() {
        return $this->skinname;
    }

}