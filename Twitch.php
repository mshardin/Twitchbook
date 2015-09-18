<?php 
/**
 * Author: Matthew Harding
 * 
 * Twitch API Wrapper
 *
 */

class Twitch {

	private $apiVersion;
	private $clientId;
	
	const TWITCH_BASE_URL = 'https://twitch.tv';
	const API_URL 		  = 'https://api.twitch.tv/kraken';
	const METHOD_GET 	  = 'GET';

	const DEF_USER 		  = 'ms5000watts';
	const DEF_TEAM 		  = 'The Cool Kids Table';
	const DEF_GAME 		  = 'Destiny';
	const DEF_SEARCH 	  = 'Destiny';
	const DEF_VIDEO 	  = 'c4312576';
	const DEF_TYPE 		  = 'suggest';


	function __construct($apiVersion=3, $clientId=null) {
		$this->setApiVersion($apiVersion);
		$this->setClientId($clientId);
	}

	public function api($url) {
		$headers[] =  'Accept: ' . 'application/vnd.twitchtv'.($this->apiVersion > 0 ? '.v' . $this->apiVersion : null).'+json';
		$headers[] = 'Client-ID: ' . $this->clientId;
		 
		$url .= '/channels/syndicate';

		$data = $this->get_url_contents($url, $headers);					
		
		return json_decode($data);
	}

	public function raw($url=self::API_URL) {
		return $this->api($url);
	}

	public function setApiVersion($version=3) {
		return $this->apiVersion = intval($version) <= 3 && intval($version) >= 1 ? intval($version) : 3;
	}

	public function setClientId($id=null) {
		return $this->clientId = $id;
	} 


	// SEARCH
	 
	public function searchChannels($q=self::DEF_GAME, $limit=10, $offset=0) {
		return $this->api(self::API_URL . '/search/channels?q=' . $q . '&limit=' . $limit . '&offset=' . $offset);
	}

	public function searchStreams($q=self::DEF_GAME, $limit=10, $offset=0, $hls=false) {
		return $this->api(self::API_URL . '/search/streams?q=' . $q . '&limit=' . $limit . '&offset=' . $offset . '&hls' . $hls);
	}

	public function searchGames($q=self::DEF_GAME, $type=self::DEF_TYPE, $live=false) {
		return $this->api(self::API_URL . '/search/games?q=' . $q . '&type=' . $type . '&live=' . $live);
	}

	public function searchAll($q=self::DEF_GAME, $type=self::DEF_TYPE, $limit=10, $offset=0, $live=false, $hls=false) {
		$channels 	= $this->searchChannels($q, $limit, $offset);
		$streams 	= $this->searchStreams($q, $limit, $offset, $hls);
		$games 		= $this->searchGames($q, $type, $live);

		return [ 
			"channels" => $channels, 
			"streams" => $streams, 
			"games" => $games
		];
	}


	// FEATURED

	public function featured($limit=25, $offset=null) 
	{
		return $this->api(self::API_URL . '/streams/featured?limit='.$limit.'&offset='.$offset);
	}

	// GAMES

	public function games($limit=25, $offset=null) {
		return $this->api(self::API_URL . '/games/top?limit='.$limit.'&offset='.$offset);
	}

	// TEAMS

	public function teams($limit=25, $offset=null)
	{
		return $this->api(self::API_URL . '/teams?limit='.$limit.'&offset='.$offset);
	}

	public function getChatEmoticons() 
	{
		return $this->api(self::API_URL . '/chat/emoticons');
	}

	// Curl REST API with headers

	protected function get_url_contents($url, $headers) {
	    $crl = curl_init();
	    $timeout = 5;
	    curl_setopt ($crl, CURLOPT_URL, $url);
	    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
	    curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
	    curl_setopt ($crl, CURLOPT_HTTPHEADER, $headers);
	    $ret = curl_exec($crl);
	    curl_close($crl);
	    return $ret;
	}
}