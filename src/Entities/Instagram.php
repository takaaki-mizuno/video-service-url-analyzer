<?php
namespace TakaakiMizuno\VideoServiceUrlAnalyzer\Entities;

class Instagram extends Base
{
    public function getEmbeddedSrcUrl()
    {
        return 'http://www.instagram.com/p/'.$this->getId().'/';
    }

    public function getEmbeddedHtml($width = 560, $height = 315)
    {
        return $this->getInfo('html');
    }

    public function getUrl()
    {
        return 'https://www.instagram.com/p/'.$this->getId().'/';
    }

    public function getServiceName()
    {
        return 'Instagram';
    }

    protected function getOEmbedUrl()
    {
        return 'http://api.instagram.com/oembed?format=json&url='.htmlspecialchars($this->getUrl());
    }
}
