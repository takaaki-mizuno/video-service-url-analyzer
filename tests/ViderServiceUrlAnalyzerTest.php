<?php

namespace TakaakiMizuno\VideoServiceUrlAnalyzer\Tests;

use TakaakiMizuno\VideoServiceUrlAnalyzer\VideoServiceUrlAnalyzer;

class VideoServiceUrlAnalyzerTest extends Base
{

    public function testYouTube()
    {
        $urls = [
            'https://www.youtube.com/watch?v=8UVNT4wvIGY',
            'https://youtu.be/8UVNT4wvIGY',
            'https://www.youtube.com/embed/8UVNT4wvIGY',
        ];

        $analyzer = new VideoServiceUrlAnalyzer();

        foreach( $urls as $url ) {
            $video = $analyzer->analyze($url);

            $this->assertInstanceOf('TakaakiMizuno\VideoServiceUrlAnalyzer\Entities\YouTube', $video, "$url is not detected");
            $this->assertEquals('YouTube', $video->getServiceName());
            $this->assertEquals('8UVNT4wvIGY', $video->getId());
            $this->assertEquals('https://youtu.be/8UVNT4wvIGY', $video->getUrl());

            $this->assertNotEmpty($video->getTitle());
            $this->assertNotEmpty($video->getThumbnailUrl());

        }
    }

    public function testVimeo()
    {
        $urls = [
            'https://vimeo.com/137221490',
            'https://vimeo.com/channels/staffpicks/137221490',
            'https://player.vimeo.com/video/137221490',
        ];

        $analyzer = new VideoServiceUrlAnalyzer();

        foreach( $urls as $url ) {
            $video = $analyzer->analyze($url);

            $this->assertInstanceOf('TakaakiMizuno\VideoServiceUrlAnalyzer\Entities\Vimeo', $video, "$url is not detected");
            $this->assertEquals('Vimeo', $video->getServiceName());
            $this->assertEquals('137221490', $video->getId());
            $this->assertEquals('https://vimeo.com/137221490', $video->getUrl());

            $this->assertNotEmpty($video->getTitle());
            $this->assertNotEmpty($video->getThumbnailUrl());

        }
    }

}