<?php
namespace TakaakiMizuno\VideoServiceUrlAnalyzer\Analyzers;

use TakaakiMizuno\VideoServiceUrlAnalyzer\Entities\YouTube as YouTubeEntity;

class YouTube extends Base
{

    static protected $domains = [
        'www.youtube.com',
        'youtu.be',
    ];

    public function analyze($url)
    {
        if (!$this->check($url)) {
            return null;
        }
        $parsedUrlElements = parse_url($url);
        $id = null;
        if (!isset($parsedUrlElements['host'])) {
            return null;
        }
        switch (strtolower($parsedUrlElements['host'])) {
            case 'www.youtube.com':
                if (isset($parsedUrlElements['path'])) {
                    $path = explode('/', substr($parsedUrlElements['path'], 1));
                    if (strtolower($path[0]) == 'embed' && count($path) == 2) {
                        $id = $path[1];
                        break;
                    }
                    if (isset($parsedUrlElements['query'])) {
                        parse_str($parsedUrlElements['query'], $queryParams);
                        if (!array_key_exists('v', $queryParams)) {
                            return null;
                        }
                        $id = $queryParams['v'];
                    }
                }
                break;
            case 'youtu.be':
                $id = explode('/', substr($parsedUrlElements['path'], 1))[0];
                break;
        }
        if (empty($id)) {
            return null;
        }
        $video = new YouTubeEntity($id);

        return $video;
    }

    public function check($url)
    {
        $parsedUrlElements = parse_url($url);
        if (in_array(strtolower($parsedUrlElements['host']), static::$domains)) {
            return true;
        }

        return false;
    }

}
