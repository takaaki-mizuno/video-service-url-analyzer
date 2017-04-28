<?php
namespace TakaakiMizuno\VideoServiceUrlAnalyzer\Entities;

class YouTube extends Base
{
    public function getEmbeddedSrcUrl()
    {
        return 'https://www.youtube.com/embed/'.$this->id;
    }

    public function getEmbeddedHtml($width = 560, $height = 315)
    {
        return '<iframe width="'.intval($width).'" height="'
        .intval($height).'" src="'.$this->getEmbeddedSrcUrl().'" frameborder="0" allowfullscreen></iframe>';
    }

    public function getUrl()
    {
        return 'https://youtu.be/'.$this->getId();
    }

    public function getServiceName()
    {
        return 'YouTube';
    }

    protected function getOEmbedUrl()
    {
        return 'http://www.youtube.com/oembed?format=json&url='.htmlspecialchars($this->getUrl());
    }

    protected function getInfo($key, $default = null)
    {
        if (empty($this->info)) {
            parent::getInfo($key, $default);

            $content = file_get_contents('http://youtube.com/get_video_info?video_id='.$this->getId());
            parse_str($content, $info);
            $this->info['duration'] = isset($info['length_seconds']) ? $info['length_seconds'] : 0;
            if (isset($info['iurlmaxres'])) {
                $this->info['thumbnailUrl'] = $info['iurlmaxres'];
            }
        }

        return $this->info[$key];
    }
}
