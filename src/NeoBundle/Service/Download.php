<?php
namespace NeoBundle\Service;
use GuzzleHttp\Client;
use NeoBundle\Document\Feed;

class Download
{
    private $api_url;
    private $api_key;
    private $dm;

    function __construct($config, $dm)
    {
        $this->api_url = $config['api_url'];
        $this->api_key = $config['api_key'];
        $this->dm      = $dm;
    }

    public function getDataInDays($start_date, $end_date)
    {
        $client = new Client();
        $result = $client->request('GET', $this->api_url, [
            'query' => ['api_key' => $this->api_key,'start_date'=>$start_date, 'end_date'=>$end_date]
        ]);
        // $limit = $result->getHeader('X-RateLimit-Remaining'); later use to warn the limit

        $response = $result->getBody();
        $responseArray = \json_decode($response,true);
        foreach ($responseArray['near_earth_objects'] as $date => $feeds) {
            foreach ($feeds as $feed) {
                $feedDocument = new Feed();
                $feedDocument->setDate(new \MongoDate(strtotime("$date 00:00:00")));
                $feedDocument->setReference($feed['neo_reference_id']);
                $feedDocument->setName($feed['name']);
                $feedDocument->setSpeed($feed['close_approach_data'][0]['relative_velocity']['kilometers_per_hour']);  // close_approach_data has only one sub element in array
                $feedDocument->setIsHazardous($feed['is_potentially_hazardous_asteroid']);
                $this->dm->persist($feedDocument);
                $this->dm->flush();
            }

        }
        return $responseArray['element_count'];

    }
}