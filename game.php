<?php
require "config/config.php";
require PATH_CONTROLEUR."/MainControl.php";

$main = new MainControl();
$main->reqPlay();
?>