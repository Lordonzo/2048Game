<?php
/**
 * @author Virgile & Walid
 * @version 1.0
 */

require_once "BDException.php";
require_once "SqliteConnexion.php";

/**
 * Class GameDAO
 */
class GameDAO {
    private $connexion;

    /**
     * GameDAO constructor.
     * function which connect to the database.
     */
    public function __construct() {
        $this->connexion = SqliteConnexion::getInstance()->getConnexion();
    }

    /**
     * @param $pseudo
     * @throws SQLException
     * function which add in the database a new game with the name of the player.
     */
    public function addNewGame($pseudo) {
        try{
            $statement = $this->connexion->prepare("insert into PARTIES values (?,?,0,0);");
            $statement->bindValue(1, $this->getNbGames()+1);
            $statement->bindParam(2, $pseudo);
            $statement->execute();
        }
        catch(PDOException $e){
            throw new SQLException("problème requête SQL sur l'AJOUT dans la table parties");
        }
    }

    /**
     * @param $id
     * @param $pseudo
     * @param $won
     * @param $score
     * @throws SQLException
     * function which update the id, the pseudo, the number of wins and the score in the database.
     */
    public function updateGame($id, $pseudo, $won, $score) {
        try{
            $this->connexion->prepare("update PARTIES set gagne=?, score=? where pseudo=? and id=?;")->execute([$won, $score, $pseudo, $id]);
        }
        catch(PDOException $e){
            throw new SQLException("problème requête SQL sur l'UPDATE dans la table parties");
        }
    }

    /**
     * @param $pseudo
     * @return mixed
     * @throws SQLException
     * function which get in the database the current game of the player in parameter.
     */
    public function getCurrent($pseudo) {
        try {
            $statement = $this->connexion->prepare("select MAX(id) as last from parties where pseudo=?;");
            $statement->bindParam(1, $pseudo);
            $statement->execute();
            $games = $statement->fetch(PDO::FETCH_ASSOC);
            return $games["last"];
        }
        catch (PDOException $e) {
            throw new SQLException("problème requête SQL sur la table parties");
        }
    }

    /**
     * @param $id
     * @return mixed
     * @throws SQLException
     * function which get in the database the number of wins of the player in parameter via its id.
     */
    public function getWon($id) {
        try {
            $statement = $this->connexion->prepare("select gagne from parties where id=?;");
            $statement->bindParam(1, $id);
            $statement->execute();
            $games = $statement->fetch(PDO::FETCH_ASSOC);
            return $games["gagne"];
        }
        catch (PDOException $e) {
            throw new SQLException("problème requête SQL sur la table parties");
        }
    }

    /**
     * @param $id
     * @return mixed
     * @throws SQLException
     * function which get in the database the score of the player in parameter via its id.
     */
    public function getScore($id) {
        try {
            $statement = $this->connexion->prepare("select score from PARTIES where id=?;");
            $statement->bindParam(1, $id);
            $statement->execute();
            $games = $statement->fetch(PDO::FETCH_ASSOC);
            return $games["score"];
        }
        catch (PDOException $e) {
            throw new SQLException("problème requête SQL sur la table parties");
        }
    }

    /**
     * @return mixed
     * @throws SQLException
     * function which get in the database the number of games created.
     */
    public function getNbGames() {
        try {
            $statement = $this->connexion->prepare("select MAX(id) as max from parties;");
            $statement->execute();
            $games = $statement->fetch(PDO::FETCH_ASSOC);
            return $games["max"];
        }
        catch (PDOException $e) {
            throw new SQLException("problème requête SQL sur la table parties");
        }
    }
}