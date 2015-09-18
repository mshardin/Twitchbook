<?php

error_reporting(E_ALL ^ E_NOTICE);

include_once('../Twitch.php');

$twitch = new Twitch();

$twitch->setClientId("r84i710q1xk50wmuuketk65fbego1j5");
$twitch->setApiVersion(3);

$query = "";
$limit = 10;

echo json_encode($twitch->searchAll());