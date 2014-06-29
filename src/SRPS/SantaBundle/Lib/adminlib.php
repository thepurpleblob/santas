<?php

namespace SRPS\SantaBundle\Lib;

class adminlib {
    
    protected $em;
    
    public function __construct($em) {
        $this->em = $em;
    }
    
    public function getTrainTimes() {
        $times = $this->em->getRepository('SRPSSantaBundle:Traintime')->findBy(array(), array('time'=>'ASC'));
        echo "<pre>"; var_dump($times); die;
    }
}

