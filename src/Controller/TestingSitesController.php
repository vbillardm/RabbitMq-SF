<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TestingSitesController extends controller
{

    /**
     * @Rest\Get("/testingsSites")
     */
    public function getTestingSitesWithSessionsCount()
    {
        $dm = $this->get('doctrine_mongodb')->getManager();
        $testingsSites = $dm->getRepository("TestingSites")->findAllTestingsSitesWithSessions();


    }
}