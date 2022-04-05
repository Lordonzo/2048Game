<?php
/**
 * @author Virgile & Walid
 * @version 1.0
 */

require_once PATH_METIER . "/Game.php";
require_once "BDException.php";
require_once "SqliteConnexion.php";

/**
 * Class PlayerDAO
 */
class PlayerDAO {
    private $connexion;

    /**
     * PlayerDAO constructor.
     */
    public function __construct() {
        $this->connexion = SqliteConnexion::getInstance()->getConnexion();
    }


    /**
     * @param $pseudo
     * @param $password
     * @throws SQLException
     * function which add a player in the database
     */
    public function addPlayer($pseudo, $password) {
        try{
            if (!$this->exists($pseudo)) {
                $pwd = password_hash($password, PASSWORD_BCRYPT);
                $this->connexion->prepare("insert into JOUEURS values (?,?);")->execute([$pseudo, $pwd]);
            }
        }
        catch(PDOException $e){
            throw new SQLException("problème requête SQL sur l'AJOUT dans la table joueurs");
        }
    }

    /**
     * @param $pseudo
     * @return bool
     * @throws SQLException
     * function which search in the database if the player in parameter exist (true) or not (false).
     */
    public function exists($pseudo) : bool {
        try{
            $statement = $this->connexion->prepare("select pseudo from joueurs where pseudo=?;");
            $statement->bindParam(1, $pseudo);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            if ($result==null) return false;
            else return true;
        }
        catch(PDOException $e){
            throw new SQLException("problème requête SQL sur la table joueurs");
        }
    }

    /**
     * @param $pseudo
     * @param $password
     * @return bool
     * @throws SQLException
     * function which search in the database if the password and the player in parameters are related (true) or not (false).
     */
    public function verify($pseudo, $password): bool {
        try{
            $statement = $this->connexion->prepare("select password from joueurs where pseudo=?;");
            $statement->bindParam(1, $pseudo);
            $statement->execute();
            $result = $statement->fetch(PDO::FETCH_ASSOC);
            return password_verify($password, $result["password"]);
        }
        catch(PDOException $e){
            throw new SQLException("problème requête SQL sur la table joueurs");
        }
    }

    /**
     * @param $pseudo
     * @return array
     * @throws SQLException
     * function which return an array with all the games of the player in parameter.
     */
    public function getMyGames($pseudo) {
        try{
            $statement = $this->connexion->prepare("select * from PARTIES where pseudo=?;");
            $statement->bindParam(1, $pseudo);
            $statement->execute();
            $games = $statement->fetchAll(PDO::FETCH_CLASS, 'Game');
            return($games);
        }
        catch(PDOException $e){
            throw new SQLException("problème requête SQL sur la table parties");
        }
    }

    /**
     * @param $pseudo
     * @return mixed
     * @throws SQLException
     * function which return the best score of the player in parameter.
     */
    public function getMyBestScore($pseudo) {
        try{
            $statement = $this->connexion->prepare("select MAX(score) as max from PARTIES where pseudo=?;");
            $statement->bindParam(1, $pseudo);
            $statement->execute();
            $games = $statement->fetch(PDO::FETCH_ASSOC);
            return $games["max"];
        }
        catch(PDOException $e){
            throw new SQLException("problème requête SQL sur la table parties");
        }
    }
}