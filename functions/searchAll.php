<?php

error_reporting(E_ALL ^ E_NOTICE);

include_once('../Twitch.php');

$twitch = new Twitch();

$twitch->setClientId("r84i710q1xk50wmuuketk65fbego1j5");
$twitch->setApiVersion(3);

// $query = isset($_POST['query']) && !empty($_POST['query']) ? urlencode($_POST['query']) : '';

// Get query from search.php

if (isset($_POST['query']) && !empty($_POST['query'])) { 
	$query = urlencode($_POST['query']); // prepare for api
	echo json_encode($twitch->searchAll($query)); // encode api object to json
} else {
	echo json_encode($twitch->searchAll()); // encode api object to json
}