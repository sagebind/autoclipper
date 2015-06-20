<?php
namespace AutoClipper;

class Readability
{
    private $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function parseUrl($url)
    {
        $query = http_build_query([
            'token' => $this->token,
            'url' => $url,
        ]);
        $url = 'https://readability.com/api/content/v1/parser?'.$query;

        $response = json_decode(file_get_contents($url));
        return $response;
    }
}
