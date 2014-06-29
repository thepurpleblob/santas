<?php

namespace SRPS\SantaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SRPS\SantaBundle\Lib\adminlib;
use SRPS\SantaBundle\Entity\Traintime;

class AdminController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('SRPSSantaBundle:Default:index.html.twig', array('name' => $name));
    }
    
    public function timesAction() {
        
        // get doctrine
        $em = $this->getDoctrine()->getManager();
        $adminlib = new adminlib($em);
        
        // get list of train times
        $times = $em->getRepository('SRPSSantaBundle:Traintime')
            ->findAllOrderedByTime();
        
        return $this->render('SRPSSantaBundle:Admin:times.html.twig',
            array(
                'times' => $times,
            )
        );
    }
    
    public function edittimesAction($id, Request $request) {
        
        // Get doctrine
        $em = $this->getDoctrine()->getManager();
        
        // get or create time
        if ($id) {
            $time = $em->getRepository('SRPSSantaBundle:Traintime')->find($id);
        } else {
            $time = new Traintime();
        }
        
        // create form
        $form = $this->createFormBuilder($time)
            ->add('time', 'time')
            ->add('save', 'submit')
            ->add('cancel', 'submit')
            ->getForm();
        
        $form->handleRequest($request);

        if ($form->isValid()) {
            if ($form->get('save')->isClicked()) {
                $em->persist($time);
                $em->flush();
            }

            return $this->redirect($this->generateUrl('admin_times'));
        }
        
        return $this->render('SRPSSantaBundle:Admin:edittime.html.twig',
            array(
                'form' => $form->createView(),
                'id' => $id,
            )
        );       
    }
}

