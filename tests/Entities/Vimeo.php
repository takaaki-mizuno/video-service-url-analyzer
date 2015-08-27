<?php

namespace TakaakiMizuno\VideoServiceUrlAnalyzer\Tests\Entities;

use TakaakiMizuno\VideoServiceUrlAnalyzer\Tests\Base;
use TakaakiMizuno\VideoServiceUrlAnalyzer\Entities\Vimeo;

class VimeoTest extends Base
{

    public function testVimeo()
    {
        $entity = new Vimeo('137221490');
        $this->assertEquals('Vimeo', $entity->getServiceName());
        $this->assertEquals('137221490', $entity->getId());
        $this->assertEquals('https://vimeo.com/137221490', $entity->getUrl());
    }
}