<?php

namespace SRPS\SantaBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="SRPS\SantaBundle\Entity\TraintimeRepository")
 * @ORM\Table(name="traintime")
 */
class Traintime {
    
     /**
      * @ORM\Column(type="integer")
      * @ORM\Id
      * @ORM\GeneratedValue(strategy="AUTO")
      */
    protected $id;
    
    /**
     * @ORM\Column(type="time")
     */
    protected $time;
    
    /**
     * @ORM\Column(type="boolean")
     * @var type 
     */
    protected $visible;
    
    public function __construct() {
        $this->id = 0;
        $this->time = new \DateTime('12:00');
        $this->visible = false;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getTime() {
        return $this->time;
    }
    
    public function setTime($time) {
        $this->time = $time;
    }
}