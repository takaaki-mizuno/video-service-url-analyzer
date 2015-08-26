<?php
namespace TakaakiMizuno\VideoServiceUrlAnalyzer\Entities;

abstract class Base
{

    /** @var string */
    protected $id;

    /** @var  array */
    protected $info;

    public function __construct($id)
    {
        $this->id = $id;
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
     * @param  int $width
     * @param  int $height
     * @return string
     */
    abstract public function getEmbeddedHtml($width, $height);

    abstract public function getServiceName();

    abstract public function getThumbnailUrl();

    abstract public function getTitle();

    abstract protected function getInfo($key);

}
