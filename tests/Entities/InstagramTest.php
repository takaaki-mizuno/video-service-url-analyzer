<?php

namespace TakaakiMizuno\VideoServiceUrlAnalyzer\Tests\Entities;

use TakaakiMizuno\VideoServiceUrlAnalyzer\Tests\Base;
use TakaakiMizuno\VideoServiceUrlAnalyzer\Entities\Instagram;

class InstagramTest extends Base
{

    public function testInstagram()
    {
        $entity = new Instagram('BTcPZXhBHmu');
        $this->assertEquals('Instagram', $entity->getServiceName());
        $this->assertEquals('BTcPZXhBHmu', $entity->getId());
        $this->assertEquals('https://www.instagram.com/p/BTcPZXhBHmu/', $entity->getUrl());

        $html = $entity->getEmbeddedHtml();
        $this->assertEquals(1, preg_match('/script/', $html));
    }
}