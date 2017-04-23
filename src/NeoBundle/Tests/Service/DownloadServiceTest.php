<?php
namespace NeoBundle\Tests\Service;
use Doctrine\ODM\MongoDB\DocumentManager;
use PHPUnit\Framework\TestCase;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use NeoBundle\Service\Download;
use Symfony\Component\Config\Definition\Exception\Exception;

class DownloadServiceTest extends KernelTestCase
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

    public function testGetDataInDaysSuccess()
    {
            $config = ['api_key'=>'N7LkblDsc5aen05FJqBQ8wU4qSdmsftwJagVK7UD', 'api_url'=>'https://api.nasa.gov/neo/rest/v1/feed'];
            $obj = new Download($config,$this->dm );
            $result = $obj ->getDataInDays('2017-04-19','2017-04-19');
            $this->assertEquals(true,is_numeric($result));
    }

    public function testGetDataInDaysFailure()
    {
        $this->expectException(\GuzzleHttp\Exception\ClientException::class);
        try {
            $config = ['api_key'=>'N7LkblDsc5aen05FJqBQ8wU4qSdmsftwJagVK7UD', 'api_url'=>'https://api.nasa.gov/neo/rest/v1/feed'];
            $obj = new Download($config,$this->dm );
            $result = $obj ->getDataInDays('19-04-2017','19-04-2017');
        }catch (Exception $e) {

        }

    }
}