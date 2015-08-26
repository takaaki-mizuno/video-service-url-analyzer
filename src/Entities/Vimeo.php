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

    public function getTitle()
    {
        return $this->getInfo('title');
    }

    public function getThumbnailUrl()
    {
        return $this->getInfo('thumbnailUrl');
    }

    protected function getInfo($key)
    {
        if (empty($this->info)) {
            $content = file_get_contents('https://vimeo.com/api/oembed.json?url=' . htmlspecialchars($this->getUrl()));

            $info = json_decode($content, true);
            $this->info = [
                'title'        => isset($info['title']) ? $info['title'] : '',
                'thumbnailUrl' => isset($info['thumbnail_url']) ? $info['thumbnail_url'] : '',
                'authorName'   => isset($info['author_name']) ? $info['author_name'] : '',
            ];
        }

        return $this->info['title'];
    }

}
