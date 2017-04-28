<?php
namespace TakaakiMizuno\VideoServiceUrlAnalyzer\Analyzers;

use TakaakiMizuno\VideoServiceUrlAnalyzer\Entities\Instagram as InstagramEntity;

class Instagram extends Base
{
    protected static $domains = [
        'instagram.com',
        'www.instagram.com',
    ];

    public function analyze($url)
    {
        if (!$this->check($url)) {
            return null;
        }
        $parsedUrlElements = parse_url($url);
        $elements          = explode('/', substr(strtolower($parsedUrlElements['path']), 1));

        $id = $elements[count($elements) - 2];

        if (empty($id)) {
            return null;
        }
        $video = new InstagramEntity($id);

        return $video;
    }
}
