<?php
namespace TakaakiMizuno\VideoServiceUrlAnalyzer\Entities;

abstract class Base
{
    /** @var string */
    protected $id;

    /** @var array */
    protected $info;

    public function __construct($id)
    {
        $this->id   = $id;
        $this->info = null;
    }

    /**
     * @return string
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    abstract public function getUrl();

    /**
     * @param int $width
     * @param int $height
     *
     * @return string
     */
    abstract public function getEmbeddedHtml($width, $height);

    /**
     * @return string
     */
    abstract public function getEmbeddedSrcUrl();

    abstract public function getServiceName();

    public function getTitle($default = null)
    {
        return $this->getInfo('title', $default);
    }

    public function getAuthorName($default = null)
    {
        return $this->getInfo('authorName', $default);
    }

    public function getWidth($default = 0)
    {
        return $this->getInfo('width', $default);
    }

    public function getHeight($default = 0)
    {
        return $this->getInfo('height', $default);
    }

    public function getDuration($default = 0)
    {
        return $this->getInfo('height', $default);
    }

    public function getThumbnailUrl($default = null)
    {
        return $this->getInfo('thumbnailUrl', $default);
    }

    public function getThumbnailWidth($default = 0)
    {
        return $this->getInfo('thumbnailWidth', $default);
    }

    public function getThumbnailHeight($default = 0)
    {
        return $this->getInfo('thumbnailHeight', $default);
    }

    /**
     * @return string
     */
    abstract protected function getOEmbedUrl();

    /**
     * @param string $key
     * @param mixed  $default
     *
     * @return mixed
     */
    protected function getInfo($key, $default = null)
    {
        if (empty($this->info)) {
            $content = @file_get_contents($this->getOEmbedUrl());
            if( !$content ) {
                $this->info = [];
                return $default;
            }
            $info       = json_decode($content, true);
            $this->info = [
                'title'           => isset($info['title']) ? $info['title'] : '',
                'thumbnailUrl'    => isset($info['iurlmaxres']) ? $info['iurlmaxres'] :
                    isset($info['iurlhq']) ? $info['iurlhq'] :
                        isset($info['thumbnail_url']) ? $info['thumbnail_url'] : '',
                'authorName'      => isset($info['author']) ? $info['author'] : '',
                'duration'        => isset($info['length_seconds']) ? $info['length_seconds'] : 0,
                'width'           => isset($info['width']) ? $info['width'] : 0,
                'height'          => isset($info['height']) ? $info['height'] : 0,
                'thumbnailWidth'  => isset($info['thumbnail_width']) ? $info['thumbnail_width'] :
                    isset($info['width']) ? $info['width'] : 0,
                'thumbnailHeight' => isset($info['thumbnail_height']) ? $info['thumbnail_height'] :
                    isset($info['height']) ? $info['height'] : 0,
                'html'            => isset($info['html']) ? $info['html'] : '',
            ];
        }

        return isset($this->info[$key]) ? $this->info[$key] : $default;
    }
}
