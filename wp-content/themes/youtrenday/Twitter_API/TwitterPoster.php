<?php

# Define constants

define('TWITTER_USERNAME', 'JMeza112');
define('CONSUMER_KEY', '3CdAq4jzK5OqRm6giOhI7fPRW');
define('CONSUMER_SECRET', '6Q23LhRC5IdbjDpVA1U7nKL0ynzPPN43EBbmrAdZzlBt5srQHR');
define('ACCESS_TOKEN', '1271305995164151811-XMcjmSnu8dzI12RtTh3Bx4zOyYh5qk');
define('ACCESS_TOKEN_SECRET', 'tP6yorNZeIb1MNjAltrH7f4ARun4LvXpsfMKcVDRJOwds');
define('TWEET_LENGTH', 140);

class TwitterPoster {

    private static $library = 'TwitterOAuth';
    private static $twitter = NULL;
    private static $DBH = NULL;

    /**
     * connect: Create an object of the Twitter PHP API either TwitterOAuth
     * or twitter-api-php
     * @access private
     */
    private static function connect() {

        if(self::$library == 'TwitterOAuth') {

            include('TwitterOAuth.php');

            # Create the connection
            self::$twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);

            # Migrate over to SSL/TLS
            self::$twitter->ssl_verifypeer = true;

        } else {

            include('TwitterAPIExchange.php');

            self::$twitter = new TwitterAPIExchange(array(
                'oauth_access_token' => ACCESS_TOKEN,
                'oauth_access_token_secret' => ACCESS_TOKEN_SECRET,
                'consumer_key' => CONSUMER_KEY,
                'consumer_secret' => CONSUMER_SECRET
            ));

        }

    }

    /**
     * setDatabase: Pass in a PDO connection, if you've already got one
     * @param $database PDO
     */
    public static function setDatabase($database) {
        self::$DBH = $database;
    }

    /**
     * tweet: Post a new status to Twitter
     * @param $message string
     * @access public
     */
    public static function tweet($message = '') {

        if(empty($message)) {
            return;
        }

        # Load the Twitter object
        if(is_null(self::$twitter)) {
            self::connect();
        }

        if(self::$library == 'TwitterOAuth') {
            $response = $twitter->post('statuses/update', array('status' => $message));
        } else {
            $url = 'https://api.twitter.com/1.1/statuses/update.json';
            $requestMethod = 'POST';
            $postData = array('status' => $message);
            $response = $twitter->buildOauth($url, $requestMethod)->setPostfields($postData)->performRequest();
        }

        return $response['id'];

     }

     /**
      * randomTweet: Send a random tweet from your database connection
      * @access public
      */
     public function randomTweet() {
 
        $twitter = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET, ACCESS_TOKEN, ACCESS_TOKEN_SECRET);
        // echo '<pre>PostData = ';
		// print_r($twitter);
		// echo '</pre>'; 
        $response = $twitter->post('statuses/update', array('status' => 'http://localhost/mackenzie_borys/music/demo-music-1111/'));
        var_dump(  $response['id']);
            // $status = 'SoundCloud demo' - 'http://localhost/mackenzie_borys/music/soundcloud-demo/';

            // # Post it now
            // tweet($status);

      //  }

     }

 }

?>
