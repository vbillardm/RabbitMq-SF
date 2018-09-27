<?php
/**
 * Created by PhpStorm.
 * User: VBM
 * Date: 27/09/2018
 * Time: 09:56
 */

namespace App\Repository;

use App\Document\TestingSite;
use Doctrine\ODM\MongoDB\DocumentRepository;

class TestingSiteRepository extends DocumentRepository
{
    public function findAllTestingsSitesWithSessions()
    {
        $builder = $this->createAggregationBuilder(TestingSite::class);

    }

}