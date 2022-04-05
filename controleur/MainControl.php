<?php
/**
 * @author Virgile & Walid
 * @version 1.0
 */

require_once PATH_CONTROLEUR."/LoginControl.php";
require_once PATH_CONTROLEUR."/GameControl.php";
require_once PATH_CONTROLEUR."/PlayerControl.php";

class MainControl {
    private $ctrlLogin;
    private $ctrlGame;
    private $ctrlPlayer;

    /**
     * MainControl constructor.
     */
    public function __construct() {
        $this->ctrlLogin = new LoginControl();
        $this->ctrlGame = new GameControl();
        $this->ctrlPlayer = new PlayerControl();
    }

    /**
     * function to use other controllers to log in or to register.
     */
    public function reqLog() {
        if (isset($_POST["inscr"]) and $_POST["password"]!=null and $_POST["pseudo"]) $this->ctrlLogin->addUser($_POST["pseudo"], $_POST["password"]);
        if (isset($_POST["goinscr"])) $this->ctrlLogin->goInscr();
        elseif (!isset($_POST["login"]) or isset($_POST["understood"])) $this->ctrlLogin->login();
        else {
            if ($this->ctrlLogin->exists($_POST["pseudo"]) && $this->ctrlLogin->verify($_POST["pseudo"], $_POST["password"])) {
                session_start();
                $_SESSION['session'] = $_POST["pseudo"];
                $this->ctrlPlayer->player();
            }
            else $this->ctrlLogin->notLogged();
        }
    }

    /**
     * function to use other controllers to play.
     */
    public function reqPlay() {
        session_start();
        if (isset($_POST["play"])) {
            $this->ctrlGame->playTheGame();
        }
        else if (isset($_GET["move"])) {
            $this->ctrlGame->playTheGame();
        }
        else if (isset($_POST["stop"])) {
            $this->ctrlGame->destroyGame(isset($_POST["stop"]));
            $this->ctrlPlayer->player();
        }
        else if (isset($_POST["quit"])) {
            session_write_close();
            $this->ctrlLogin->login();
        }
        else if (isset($_POST["over_understood"])) {
            $this->ctrlPlayer->player();
        }
    }
}