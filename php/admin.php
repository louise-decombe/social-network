<?php
session_start();

require "class/Cursus.php";

$cursus = new Cursus($db);

$formations = $cursus->getCursus();



?>