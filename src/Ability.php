<?php
/**
 * Created by PhpStorm.
 * User: Bennet
 * Date: 12/10/2017
 * Time: 11:53 AM
 */

namespace Paladins;


class Ability {

    private $description;
    private $id;
    private $summary;
    private $URL;

    public function __construct($ability) {
        $this->description = $ability['Description'];
        $this->id = $ability['Id'];
        $this->summary = $ability['Summary'];
        $this->URL = $ability['URL'];
    }

    public function getDescription() {
        return $this->description;
    }
    public function getID() {
        return $this->id;
    }
    public function getSummary() {
        return $this->summary;
    }
    public function getIMG() {
        return $this->URL;
}

}