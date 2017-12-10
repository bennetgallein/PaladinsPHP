<?php
/**
 * Created by PhpStorm.
 * User: Bennet
 * Date: 12/10/2017
 * Time: 11:39 AM
 */

namespace Paladins;


class Champion {

    private $name;
    private $ability1;
    private $ability2;
    private $ability3;
    private $ability4;
    private $ability5;

    private $champion_card_url;
    private $champion_icon_url;

    private $id;
    private $health;
    private $pantheon;
    private $cons;
    private $pros;
    private $role;
    private $speed;
    private $title;
    private $latestChampion;


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
    public function getID() {
        return $this->id;
    }
    public function getName() {
        return $this->name;
    }
    public function getAllAbilitys() {
        return array($this->ability1, $this->ability2, $this->ability3, $this->ability4, $this->ability5);
    }
    public function getAbility1() {
        return $this->ability1;
    }

    public function getAbility2() {
        return $this->ability2;
    }

    public function getAbility3() {
        return $this->ability3;
    }

    public function getAbility4() {
        return $this->ability4;
    }

    public function getAbility5() {
        return $this->ability5;
    }

    public function getChampionCardUrl() {
        return $this->champion_card_url;
    }

    public function getChampionIconUrl() {
        return $this->champion_icon_url;
    }

    public function getHealth() {
        return $this->health;
    }

    public function getPantheon() {
        return $this->pantheon;
    }

    public function getCons() {
        return $this->cons;
    }

    public function getPros() {
        return $this->pros;
    }

    public function getRole() {
        return $this->role;
    }

    public function getSpeed() {
        return $this->speed;
    }

    public function getTitle() {
        return $this->title;
    }

    public function isLatestChampion() {
        return $this->latestChampion;
    }
}