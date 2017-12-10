<?php
/**
 * Created by PhpStorm.
 * User: Bennet
 * Date: 12/10/2017
 * Time: 11:39 AM
 */

namespace Paladins\Champion;


/**
 * Class Champion
 * @package Paladins\Champion
 * @author Bennet Gallein
 */
class Champion {

    /**
     * @var
     */
    private $name;
    /**
     * @var Ability
     */
    private $ability1;
    /**
     * @var Ability
     */
    private $ability2;
    /**
     * @var Ability
     */
    private $ability3;
    /**
     * @var Ability
     */
    private $ability4;
    /**
     * @var Ability
     */
    private $ability5;

    /**
     * @var
     */
    private $champion_card_url;
    /**
     * @var
     */
    private $champion_icon_url;

    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $health;
    /**
     * @var
     */
    private $pantheon;
    /**
     * @var
     */
    private $cons;
    /**
     * @var
     */
    private $pros;
    /**
     * @var
     */
    private $role;
    /**
     * @var
     */
    private $speed;
    /**
     * @var
     */
    private $title;
    /**
     * @var bool
     */
    private $latestChampion;


    /**
     * Champion constructor.
     * @param $champion
     */
    public function __construct($champion) {
        $this->id = $champion['id'];

        $this->name = $champion['Name'];
        $this->title = $champion['Title'];

        $this->ability1 = new Ability($champion['Ability_1']);
        $this->ability2 = new Ability($champion['Ability_2']);
        $this->ability3 = new Ability($champion['Ability_3']);
        $this->ability4 = new Ability($champion['Ability_4']);
        $this->ability5 = new Ability($champion['Ability_5']);

        $this->champion_card_url = $champion['ChampionCard_URL'];
        $this->champion_icon_url = $champion['ChampionIcon_URL'];

        $this->health = $champion['Health'];
        $this->pantheon = $champion['Pantheon'];

        $this->cons = $champion['Cons'];
        $this->pros = $champion['Pros'];

        $this->role = $champion['Roles'];
        $this->speed = $champion['Speed'];

        $this->latestChampion = ($champion['latestChampion'] == "n" ? false : true);
    }

    /**
     * @return mixed
     */
    public function getID() {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return array
     */
    public function getAllAbilitys() {
        return array($this->ability1, $this->ability2, $this->ability3, $this->ability4, $this->ability5);
    }

    /**
     * @return Ability
     */
    public function getAbility1() {
        return $this->ability1;
    }

    /**
     * @return Ability
     */
    public function getAbility2() {
        return $this->ability2;
    }

    /**
     * @return Ability
     */
    public function getAbility3() {
        return $this->ability3;
    }

    /**
     * @return Ability
     */
    public function getAbility4() {
        return $this->ability4;
    }

    /**
     * @return Ability
     */
    public function getAbility5() {
        return $this->ability5;
    }

    /**
     * @return mixed
     */
    public function getChampionCardUrl() {
        return $this->champion_card_url;
    }

    /**
     * @return mixed
     */
    public function getChampionIconUrl() {
        return $this->champion_icon_url;
    }

    /**
     * @return mixed
     */
    public function getHealth() {
        return $this->health;
    }

    /**
     * @return mixed
     */
    public function getPantheon() {
        return $this->pantheon;
    }

    /**
     * @return mixed
     */
    public function getCons() {
        return $this->cons;
    }

    /**
     * @return mixed
     */
    public function getPros() {
        return $this->pros;
    }

    /**
     * @return mixed
     */
    public function getRole() {
        return $this->role;
    }

    /**
     * @return mixed
     */
    public function getSpeed() {
        return $this->speed;
    }

    /**
     * @return mixed
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * @return bool
     */
    public function isLatestChampion() {
        return $this->latestChampion;
    }
}