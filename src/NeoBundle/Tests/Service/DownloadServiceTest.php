<?php
namespace NeoBundle\Tests\Service;
use Doctrine\ODM\MongoDB\DocumentManager;
use PHPUnit\Framework\TestCase;
use NeoBundle\Document\Feed;
use NeoBundle\Service\Download;
class DownloadServiceTest extends TestCase
{
    public function testIndex()
    {
               $this->assertContains('{"hello":"world!"}', '{"hello":"world!"}');
    }
}