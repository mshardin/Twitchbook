<?php

$twitch_base_url = "https://twitch.tv";

function get_url_contents($url) {
    $crl = curl_init();
    $timeout = 5;
    curl_setopt ($crl, CURLOPT_URL, $url);
    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}

function post_url_contents($url, $fields) {

    foreach($fields as $key=>$value) { $fields_string .= $key.'='.urlencode($value).'&'; }
    rtrim($fields_string, '&');

    $crl = curl_init();
    $timeout = 5;

    curl_setopt($crl, CURLOPT_URL, $url);
    curl_setopt($crl,CURLOPT_POST, count($fields));
    curl_setopt($crl,CURLOPT_POSTFIELDS, $fields_string);

    curl_setopt ($crl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt ($crl, CURLOPT_CONNECTTIMEOUT, $timeout);
    $ret = curl_exec($crl);
    curl_close($crl);
    return $ret;
}

function br() {
	return "<br>";
}

function hr() {
	return "<hr>";
}