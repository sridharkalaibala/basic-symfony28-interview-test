<?php
namespace NeoBundle\Tests\Document;

use Doctrine\ODM\MongoDB\DocumentManager;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use NeoBundle\Service\Download;
use NeoBundle\Document\Feed;
use Symfony\Component\Config\Definition\Exception\Exception;

class FeedDocumentTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ODM\MongoDB\DocumentManager
     */
    private $dm;

    /**
     * {@inheritDoc}
     */
    protected function setUp()
    {
        self::bootKernel();

        $this->dm = static::$kernel->getContainer()
            ->get('doctrine_mongodb')
            ->getManager();
    }

    public function testInsert()
    {
        $feedDocument = new Feed();
        $feedDocument->setDate(new \MongoDate());
        $feedDocument->setReference('testrefrence');
        $feedDocument->setName('test name');
        $feedDocument->setSpeed(4545.4545);
        $feedDocument->setIsHazardous(true);
        $feed = $this->dm->persist($feedDocument);
        $this->dm->flush();
        $this->assertEquals(true, is_string($feedDocument->getId()));
        $this->assertEquals(true, is_object($feedDocument->getDate()));
        $this->assertEquals('testrefrence', $feedDocument->getReference());
        $this->assertEquals('test name', $feedDocument->getName());
        $this->assertEquals(4545.4545, $feedDocument->getSpeed());
        $this->assertEquals(true, $feedDocument->getIsHazardous());
    }

}