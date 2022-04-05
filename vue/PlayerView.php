<?php

class PlayerView {
    function affPlayer($games) {
        ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="utf-8">
            <style>
                <?php include 'css/main.css'; ?>
                <?php include 'css/player.css'; ?>
            </style>
            <title>2048 Game</title>
        </head>
        <body>
        <div class="body">
            <div class="form">
                <fieldset id="log">
                    <div class="infos">
                        <div>Votre pseudo: <?php echo $_SESSION['session']; ?></div><div>Votre meilleur score: <?php echo $_SESSION['score']; ?></div>
                    </div>
                    <div class="games">
                        <fieldset id="game">
                            <legend>My Games</legend>
                        <?php foreach ($games as $game) echo "<p>".$game."</p>"; ?>
                        </fieldset>
                    </div>
                    <form action="game.php" method="post">
                        <div class="sub">
                            <input class="player" type="submit" name="play" value="Jouer"/>
                            <input class="player" type="submit" name="quit" value="Se déconnecter"/>
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