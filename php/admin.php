<?php
session_start();
//require 'class/Config.php';
require "class/Cursus.php";

$cursus = new Cursus($db);

$formations = $cursus->getCursus();



?>