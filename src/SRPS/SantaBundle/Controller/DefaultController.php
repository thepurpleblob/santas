<?php

namespace SRPS\SantaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SRPSSantaBundle:Default:index.html.twig', array('name' => $name));
    }
}
