<?php
session_start();

//Include Google client library 
include_once 'src/Google_Client.php';
include_once 'src/contrib/Google_Oauth2Service.php';

/*
 * Configuration and setup Google API
 */
$clientId = '632251722562-ns2cmj03otclnac8tiu5ajgad8plnp6q.apps.googleusercontent.com'; //Google client ID
$clientSecret = 'C0QOrnJ8QZgeccf4pjh855Vu'; //Google client secret
$redirectURL = 'http://www.nabugi.com/Nabu2'; //Callback URL

//Call Google API
$gClient = new Google_Client();
$gClient->setApplicationName('nabu');
$gClient->setClientId($clientId);
$gClient->setClientSecret($clientSecret);
$gClient->setRedirectUri($redirectURL);

$google_oauthV2 = new Google_Oauth2Service($gClient);
?>
