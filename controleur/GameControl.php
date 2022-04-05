<?php
/**
 * @author Virgile & Walid
 * @version 1.0
 */

require_once PATH_VUE."/GameView.php";
require_once PATH_MODELE."/GameDAO.php";
require_once PATH_METIER . "/Grid.php";

/**
 * Class GameControl
 */
class GameControl {
    private $gameVue;
    private $gameDAO;
    private $grid;

    public function __construct() {
        $this->grid = null;
        $this->gameVue = new GameView();
        $this->gameDAO = new GameDAO();
        $_SESSION['cacheGame'] = null;
    }

    /**
     * @throws SQLException
     * function which display the game or the end of the game.
     */
    private function affichageGame() {
        if (!$this->isGameOver()) $this->gameVue->displayGame($this->getGrid());
        else {
            $this->destroyGame($this->isGameOver());
            $this->gameVue->gameOver();
        }
    }

    /**
     * @throws SQLException
     * function which set up a game and call the display function.
     */
    public function playTheGame() {
        if ($_SESSION['cacheGame'] == null) {
            $this->addNewGame();
            $this->grid = new Grid();
            $this->grid->startGame();
            $_SESSION['cacheGame'] = $this->grid;
            $_SESSION['id'] = $this->gameDAO->getCurrent($_SESSION['session']);
            $_SESSION['score'] = $this->gameDAO->getScore($_SESSION['id']);
            $_SESSION['won'] = $this->getWon();
        }
        else if (isset($_GET["move"])) {
            $this->grid = $_SESSION['cacheGame'];
            $this->move();
            $this->gameDAO->updateGame($_SESSION['id'], $_SESSION['session'], $_SESSION['won'], $_SESSION['score']);
            $_SESSION['id'] = $this->gameDAO->getCurrent($_SESSION['session']);
            $_SESSION['score'] = $this->gameDAO->getScore($_SESSION['id']);
            $_SESSION['won'] = $this->getWon();
        }
        $this->affichageGame();
    }

    /**
     * @throws SQLException
     * function which add a new game to the database.
     */
    public function addNewGame() {
        $this->gameDAO->addNewGame($_SESSION['session']);
    }

    /**
     * @param $stop
     * @throws SQLException
     * function which update the database and close the session if the game is over or if we stop the game.
     */
    public function destroyGame($stop) {
        if ($stop) {
            $this->gameDAO->updateGame($_SESSION['id'], $_SESSION['session'], $_SESSION['won'], $_SESSION['score']);
            $this->grid = null;
            $_SESSION['cacheGame'] = null;
        }
    }

    /**
     * @return bool
     * function which return a boolean if the game is over (true) or not (false).
     */
    public function isGameOver() {
        if (!$this->grid->hasEqualNext()) {
            for ($i=0; $i<4; $i++) {
                for ($j=0; $j<4; $j++) if ($this->grid->get($i, $j) == 0) return false;
            }
            return true;
        }
        return false;
    }

    /**
     * @return int
     * fuction which return an int if we get a case with 2048 or plus (1) or not (0).
     */
    private function getWon() {
        for ($i=0; $i<4; $i++) {
            for ($j=0; $j<4; $j++) if ($this->grid->get($i, $j) >= 2048) return 1;
        }
        return 0;
    }

    /**
     * function which is going to call another function depending on the button which get pressed.
     */
    private function move() {
        if ($_GET["move"] == "up") $this->grid->moveUp();
        elseif ($_GET["move"] == "down") $this->grid->moveDown();
        elseif ($_GET["move"] == "right") $this->grid->moveRight();
        elseif ($_GET["move"] == "left") $this->grid->moveLeft();
    }

    /**
     * @return string
     * function which return the HTML of the grid.
     */
    private function getGrid() {
        $grid = "";
        for ($i=0; $i<4; $i++) {
            for ($j=0; $j<4; $j++) $grid .= "<div class=\"v".$_SESSION['cacheGame']->get($i, $j)." case\">".$_SESSION['cacheGame']->get($i, $j)."</div>";
        }
        return $grid;
    }
}