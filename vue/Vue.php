<?php
/**
 * @author Virgile & Walid
 * @version 1.0
 */

class Vue {
    function affLogin() {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <style>
            <?php include 'css/main.css'; ?>
            </style>
            <title>Se Connecter</title>
        </head>
        <body>
        <div class="body">
            <div class="form">
                <fieldset id="log">
                    <h3>Se connecter</h3>
                    <form action="index.php" method="post">
                        <div class="infos">
                            <div class="pseudo">
                                <label for="pseudo">Pseudo:  </label>
                                <input type="text" name="pseudo" id="pseudo">
                            </div>
                            <div class="pass">
                                <label for="password">Mot de passe:  </label>
                                <input type="password" name="password" id="password">
                            </div>
                        </div>
                        <div class="sub">
                            <input class="player" type="submit" name="login" value="Se Connecter"/>
                            <input class="player" type="submit" name="goinscr" value="S'inscrire">
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
        </body>
        </html>
        <?php
    }

    function affNoLogin() {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                <?php include 'css/main.css'; ?>
            </style>
            <title>Error</title>
        </head>
        <body>
        <div class="body">
            <div class="form">
                <fieldset id="log">
                    <h3>Connection Error</h3>
                    <form action="index.php" method="post">
                        <div class="infos">
                            <p>Vous n'êtes pas connecté.</p>
                            <p class="error"><strong>Pseudo ou mot de passe incorrect</strong></p>
                        </div>
                        <div class="sub">
                            <input type="submit" name="understood" value="D'accord"/>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
        </body>
        </html>
        <?php
    }

    function affInsc() {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                <?php include 'css/main.css'; ?>
            </style>
            <title>Error</title>
        </head>
        <body>
        <div class="body">
            <div class="form">
                <fieldset id="log">
                    <h3>S'inscrire</h3>
                    <form action="index.php" method="post">
                        <div class="infos">
                            <div class="pseudo">
                                <label for="pseudo">Pseudo:  </label>
                                <input type="text" name="pseudo" id="pseudo">
                            </div>
                            <div class="pass">
                                <label for="password">Mot de passe:  </label>
                                <input type="password" name="password" id="password">
                            </div>
                        </div>
                        <div class="sub">
                            <input class="player" type="submit" name="inscr" value="S'inscrire"/>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
        </body>
        </html>
        <?php
    }
}
?>