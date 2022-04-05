<?php
/**
 * @author Virgile & Walid
 * @version 1.0
 */

require "config/config.php";
require PATH_CONTROLEUR."/MainControl.php";

$main = new MainControl();
$main->reqLog();
?>