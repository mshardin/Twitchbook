# Twitchbook
Twitch Wrapper + Interface

Install:

  include Twitch.php into your document


Usage:
  
  Create a new twitch instance
  ```php
  $twitch = new Twitch();
  ```
  
  Set your twitch client id
  ```php
  $twitch->setClientId("AAAAAAAAABBBBBBBCCC");
  ```
	
  Set which twitch version to use
  ```php
  $twitch->setApiVersion(3);
  ```
  
  Call the api manually
  ```php
  $twitch->raw($url);
  ```
  
  Methods for API: 
  
	  Search Channels
```php
$channels = $twitch->searchChannels();
```
	  
	  Search Streams
	  ```php
	  $streams = $twitch->searchStream();
	  ```
	  
	  Search Games 
	  ```php
	  $games = $twitch->searchGames();
	  ```
	  
	  Get Featured 
	  ```php
	  $featured = $twitch->featured();
	  ```
	  
	  Get Games 
	  ```php
	  $games = $twitch->games();
	  ```
	  
	  Get Teams
	  ```php
	  $teams = $twitch->team();
	  ````
