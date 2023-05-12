<?php

namespace App\Services;

use Abraham\TwitterOAuth\TwitterOAuth;

class TwitterService
{
    protected $twitter;

    public function __construct()
    {
        $options = config('services.twitter');

        $this->twitter = new TwitterOAuth($options['consumer_key'], $options['consumer_secret'], $options['access_token'], $options['access_token_secret']);

        $this->twitter->setApiVersion('2');
    }

    public function postTweet($post)
    {
        $title = $post->title;
        $url = url('/section/' . $post->categories->first()->slug . '/' . $post->slug);

        $tweet = $title . "\n" . $url;


        $this->twitter->post("tweets", [
            "text" => $tweet,
        ], true);
    }
}
