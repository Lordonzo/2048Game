<?php
/**
 * @author Virgile & Walid
 * @version 1.0
 */

require_once PATH_VUE."/Vue.php";
require_once PATH_MODELE."/PlayerDAO.php";

/**
 * Class LoginControl
 */
class LoginControl {
    private $vue;
    private $playerDAO;

    /**
     * LoginControl constructor.
     */
    public function __construct() {
        $this->vue = new Vue();
        $this->playerDAO = new PlayerDAO();
    }

    /**
     * function which call another function in charge of display the login page.
     */
    public function login() {
        $this->vue->affLogin();
    }

    /**
     * function which call another function in charge of display the not login page.
     */
    public function notLogged() {
        $this->vue->affNoLogin();
    }

    /**
     * function which use the DAO to add a user to the database
     */
    public function goInscr() {
        $this->vue->affInsc();
    }

    /**
     * @param $pseudo
     * @param $password
     * @throws SQLException
     */
    public function addUser($pseudo, $password) {
        $this->playerDAO->addPlayer($pseudo, $password);
    }

    /**
     * @param $pseudo
     * @return bool
     * @throws SQLException
     * function which return a boolean if a player exist in the database (true) or not (false).
     */
    public function exists($pseudo): bool {
        return $this->playerDAO->exists($pseudo);
    }

    /**
     * @param $pseudo
     * @param $password
     * @return bool
     * @throws SQLException
     * function which return a boolean if the pseudo is associate to the good password in the database (true) or not (false).
     */
    public function verify($pseudo, $password): bool {
        return $this->playerDAO->verify($pseudo, $password);
    }
}