<?php
require_once PATH_VUE . "/PlayerView.php";
require_once PATH_MODELE."/PlayerDAO.php";


class PlayerControl {
    private $vue;
    private $playerDAO;

    public function __construct() {
        $this->vue = new PlayerView();
        $this->playerDAO = new PlayerDAO();
    }

    public function player() {
        $_SESSION['score'] = $this->getMyBestScore();
        $this->vue->affPlayer($this->getMyGames());
    }

    private function getMyGames() {
        return $this->playerDAO->getMyGames($_SESSION["session"]);
    }

    private function getMyBestScore() {
        return $this->playerDAO->getMyBestScore($_SESSION["session"]);
    }
}