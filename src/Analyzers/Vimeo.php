<?php
namespace TakaakiMizuno\VideoServiceUrlAnalyzer\Analyzers;

use TakaakiMizuno\VideoServiceUrlAnalyzer\Entities\Vimeo as VimeoEntity;

class Vimeo extends Base
{
    protected static $domains = [
        'vimeo.com',
        'player.vimeo.com',
    ];

    public function analyze($url)
    {
        if (!$this->check($url)) {
            return;
        }
        $parsedUrlElements = parse_url($url);
        $elements          = explode('/', substr(strtolower($parsedUrlElements['path']), 1));

        $id = $elements[count($elements) - 1];

        if (empty($id)) {
            return;
        }
        $video = new VimeoEntity($id);

        return $video;
    }
}
