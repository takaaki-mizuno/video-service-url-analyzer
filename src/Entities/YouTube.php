<?php
namespace TakaakiMizuno\VideoServiceUrlAnalyzer\Entities;

class YouTube extends Base
{

    function getEmbeddedHtml($width = 560, $height = 315)
    {
        return '<iframe width="' . intval($width) . '" height="'
        . intval($height) . '" src="https://www.youtube.com/embed/'
        . $this->id . '" frameborder="0" allowfullscreen></iframe>';
    }

    public function getUrl()
    {
        return 'https://youtu.be/' . $this->getId();
    }

    public function getServiceName()
    {
        return 'YouTube';
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
            $content = file_get_contents('http://youtube.com/get_video_info?video_id=' . $this->getId());
            parse_str($content, $info);
            $this->info = [
                'title'        => isset($info['title']) ? $info['title'] : '',
                'thumbnailUrl' => isset($info['thumbnail_url']) ? $info['thumbnail_url'] : '',
                'authorName'   => isset($info['author']) ? $info['author'] : '',
            ];
        }

        return $this->info['title'];
    }

}
