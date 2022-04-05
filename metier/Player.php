<?php
/**
 * @author Virgile & Walid
 * @version 1.0
 */

require_once PATH_METIER . "/Game.php";

/**
 * Class Player
 */
class Player {
    private $pseudo;
    private $bestScore;

    /**
     * Player constructor.
     * @param $pseudo
     */
    public function __construct($pseudo) {
        $this->pseudo = $pseudo;
        $this->bestScore = 0;
    }

    /**
     * function which get the best score in the session and stock it in the bestScore variable.
     */
    public function setBestScore() {
        $this->bestScore = $_SESSION['score'];
    }
}