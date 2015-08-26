<?php
namespace TakaakiMizuno\VideoServiceUrlAnalyzer;

class VideoServiceUrlAnalyzer
{

    static protected $analyzers = [
        '\TakaakiMizuno\VideoServiceUrlAnalyzer\Analyzers\Vimeo',
        '\TakaakiMizuno\VideoServiceUrlAnalyzer\Analyzers\YouTube',
    ];

    /**
     * @param  string                                                       $url
     * @param  \TakaakiMizuno\VideoServiceUrlAnalyzer\Analyzers\Base[]|null $analyzers
     * @return \TakaakiMizuno\VideoServiceUrlAnalyzer\Entities\Base|null
     */
    public function analyze($url, $analyzers = null)
    {
        $analyzers = empty($analyzers) ? static::$analyzers : $analyzers;
        foreach ($analyzers as $analyzer) {
            /** @var \TakaakiMizuno\VideoServiceUrlAnalyzer\Analyzers\Base $instance */
            $instance = new $analyzer();
            $video = $instance->analyze($url);
            if (!empty($video)) {
                return $video;
            }
        }

        return null;
    }

}
