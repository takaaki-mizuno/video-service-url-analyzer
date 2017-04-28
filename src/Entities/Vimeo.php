<?php
namespace TakaakiMizuno\VideoServiceUrlAnalyzer\Entities;

class Vimeo extends Base
{
    /** @var array */
    protected $info;

    public function getEmbeddedSrcUrl()
    {
        return 'https://player.vimeo.com/video/'.$this->getId();
    }

    public function getEmbeddedHtml($width = 500, $height = 281)
    {
        return '<iframe src="'.$this->getEmbeddedSrcUrl().
        '" width="'.intval($width).'" height="'
        .intval($height).
        '" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>';
    }

    public function getUrl()
    {
        return 'https://vimeo.com/'.$this->getId();
    }

    public function getServiceName()
    {
        return 'Vimeo';
    }

    protected function getOEmbedUrl()
    {
        return 'https://vimeo.com/api/oembed.json?url='.htmlspecialchars($this->getUrl());
    }
}
