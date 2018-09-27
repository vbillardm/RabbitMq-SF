<?php
/**
 * Created by PhpStorm.
 * User: VBM
 * Date: 27/09/2018
 * Time: 09:45
 */

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Mapping\Annotations\ReferenceOne;

/**
 * @MongoDB\Document(repositoryClass="App\Repository\SessionRepository")
 */
class Session
{

    /**
     * @MongoDB\Id
     */
    private $id;

    /**
     * @MongoDB\Field(type="date")
     */
    protected $date;

    /** @ReferenceOne(targetDocument="TestingSite", name="_id") */
    protected $testingSites;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     */
    public function setDate($date): void
    {
        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getTestingSites()
    {
        return $this->testingSites;
    }

    /**
     * @param mixed $testingSites
     */
    public function setTestingSites($testingSites): void
    {
        $this->testingSites = $testingSites;
    }


}