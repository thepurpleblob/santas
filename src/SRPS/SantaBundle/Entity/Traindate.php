<?php

namespace SRPS\SantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="SRPS\SantaBundle\Entity\TraindateRepository")
 * @ORM\Table(name="traindate")
 */
class Traindate {
    
     /**
      * @ORM\Column(type="integer")
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO")
      */
    protected $id;
    
    /**
     * @ORM\Column(type="time")
     */
    protected $date;
    
    /**
     * @ORM\Column(type="boolean")
     * @var type 
     */
    protected $visible;
    
    public function __construct() {
        $this->id = 0;
        $this->date = new \DateTime();
        $this->visible = false;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getDate() {
        return $this->date;
    }
    
    public function setTime($date) {
        $this->date = $date;
    }
}