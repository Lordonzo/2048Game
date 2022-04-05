<?php
/**
 * @author Virgile & Walid
 * @version 1.0
 */

require_once PATH_METIER . "/Grid.php";

class Game {
    private $id;
    private $pseudo;
    private $gagne;
    private $score;

    /**
     * @return string
     * function which return "Oui" or "Non" if the game is won or not.
     */
    private function changeGagne() {
        if ($this->gagne == 1) return "Oui";
        else return "Non";
    }

    /**
     * @return string
     * toString function of the class Game.
     */
    public function __toString() {
        return "ID: ".$this->id." | Gagnée: ".$this->changeGagne()." | Score: ".$this->score;
    }
}