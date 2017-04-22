<?php

namespace NeoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="hello")
     */
    public function indexAction()
    {
        return new JsonResponse(array('hello' => 'world!'));
    }

    /**
     * @Route("/neo/hazardous", name="hazardous")
     */
    public function hazardousAction()
    {
        $feed = $this->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('NeoBundle:Feed')
            ->field('is_hazardous')->equals(true)
            ->hydrate(false)
            ->getQuery()
            ->toArray();
        return new JsonResponse($feed);
    }

    /**
     * @Route("/neo/fastest", name="fastest")
     */
    public function fastestAction()
    {
        $feed = $this->get('doctrine_mongodb')
            ->getManager()
            ->createQueryBuilder('NeoBundle:Feed')
            ->sort('speed', 'DESC')
            ->limit(1)
            ->hydrate(false)
            ->getQuery()
            ->toArray();
        return new JsonResponse($feed);
    }

}
