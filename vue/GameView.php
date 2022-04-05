<?php
require_once PATH_METIER . "/Grid.php";

class GameView {

    function displayGame($grid) {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <style>
            <?php
            include 'css/main.css';
            include 'css/game.css';
            ?>
            </style>
            <title>2048 Game</title>
        </head>
        <body>
        <div class="body">
            <div class="form">
                <fieldset id="log">
                    <div class="top">
                        <p><?php echo "Game ".$_SESSION['id']." by ".$_SESSION['session']; ?></p>
                        <h3 id="title">2048</h3>
                        <p><?php echo  "Score: ".$_SESSION['score']; ?></p>
                    </div>
                    <div class="center">
                        <div class="gameGrid">
                            <?php
                            echo $grid;
                            ?>
                        </div>
                    </div>
                    <form class="bottom" action="game.php" method="post">
                        <div class="moves">
                            <a href="game.php?move=<?php echo "up"; ?>" class="fas fa-angle-up">↑</a>
                            <a href="game.php?move=<?php echo "down"; ?>" class="fas fa-angle-down">↓</a>
                            <a href="game.php?move=<?php echo "right"; ?>" class="fas fa-angle-right">→</a>
                            <a href="game.php?move=<?php echo "left"; ?>" class="fas fa-angle-left">←</a>
                        </div>
                        <div class="bott">
                            <input type="submit" name="stop" value="Quitter"/>
                        </div>
                    </form>
                </fieldset>
            </div>
        </div>
        </body>
        </html>
        <?php
    }

    function gameOver() {
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <style>
                <?php include 'css/main.css'; ?>
            </style>
            <title>Game Over</title>
        </head>
        <body>
        <div class="body">
            <div class="form">
                <fieldset id="log">
                    <h3>Game is Over</h3>
                    <form action="game.php" method="post">
                        <div class="infos">
                            <p>La partie est finie</p>
                            <?php
                            if ($_SESSION['won'] == 1) echo "<p class=error><strong>Vous avez gagné</strong></p>";
                            else echo "<p class=error><strong>Vous avez perdu</strong></p>";
                            ?>
                        </div>
                        <div class="sub">
                            <input type="submit" name="over_understood" value="D'accord"/>
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