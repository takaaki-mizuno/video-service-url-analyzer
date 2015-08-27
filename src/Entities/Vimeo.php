<?php
namespace TakaakiMizuno\VideoServiceUrlAnalyzer\Entities;

class Vimeo extends Base
{

    /** @var  array */
    protected $info;

    function getEmbeddedHtml($width = 500, $height = 281)
    {
        return '<iframe src="https://player.vimeo.com/video/' . $this->getId() .
        '" width="' . intval($width) . '" height="'
        . intval($height) .
        '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
    }

    public function getUrl()
    {
        return 'https://vimeo.com/' . $this->getId();
    }

    public function getServiceName()
    {
        return 'Vimeo';
    }

    protected function getOEmbedUrl()
    {
        return 'https://vimeo.com/api/oembed.json?url=' . htmlspecialchars($this->getUrl());
    }

}
