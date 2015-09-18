<?php 

ini_set('display_errors',1);
ini_set('display_startup_errors',1);

include_once('Twitch.php');

$twitch = new Twitch();

$twitch->setClientId("r84i710q1xk50wmuuketk65fbego1j5");
$twitch->setApiVersion(3);

// $featured = $twitch->featured(6);
// $games = $twitch->games(6);
// $teams = $twitch->teams(6);


// var_dump($twitch->searchChannels());
// var_dump($twitch->searchStreams());
// var_dump($twitch->searchGames());


// var_dump($twitch->searchAll());


// var_dump($featured);
// var_dump($games);
// var_dump($teams);