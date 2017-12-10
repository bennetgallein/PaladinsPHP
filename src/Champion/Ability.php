<?php
/**
 * Created by PhpStorm.
 * User: Bennet
 * Date: 12/10/2017
 * Time: 11:53 AM
 */

namespace Paladins\Champion;


/**
 * Class Ability
 * @package Paladins\Champion
 * @author Bennet Gallein
 */
class Ability {

    /** @var string $description Should contain the abilitys description */
    private $description;
    /** @var int $id Should contain the abilitys ID.  */
    private $id;
    /** @var string $summary Should contain the abilitys summary. */
    private $summary;
    /** @var string $URL Should contain the abilitys image url*/
    private $URL;

    /**
     * Ability constructor.
     * @param $ability array
     */
    public function __construct($ability) {
        $this->description = $ability['Description'];
        $this->id = $ability['Id'];
        $this->summary = $ability['Summary'];
        $this->URL = $ability['URL'];
    }

    /**
     * @return mixed|string
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * @return int|mixed
     */
    public function getID() {
        return $this->id;
    }

    /**
     * @return mixed|string
     */
    public function getSummary() {
        return $this->summary;
    }

    /**
     * @return mixed|string
     */
    public function getIMG() {
        return $this->URL;
}

}