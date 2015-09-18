<?php

include_once('../Twitch.php');

$twitch = new Twitch();

$twitch->setClientId("r84i710q1xk50wmuuketk65fbego1j5");
$twitch->setApiVersion(3);

$query = urlencode($_POST['query']); // prepare for api

// Get query from search.php

if (!isset($query) && empty($query)) {
	echo json_encode($twitch->searchChannels()); // encode api object to json
} else {
	echo json_encode($twitch->searchChannels($query)); // encode api object to json
}
