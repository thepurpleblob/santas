<?php

namespace SRPS\SantaBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use SRPS\SantaBundle\Lib\adminlib;
use SRPS\SantaBundle\Entity\Traintime;

class AdminController extends Controller
{
    public function indexAction()
    {
        return $this->render('SRPSSantaBundle:Default:index.html.twig');
    }
    
    /**
     * Display list of times
     * @return type
     */
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
    
    /**
     * Create/edit time instance
     * @param int $id Traintime id (0 for new)
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return type
     */
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
    
    /**
     * Handle traintime delete - ask for confirmation
     * @param int $id Traintime id
     * @return type
     */
    public function deletetimesAction($id) {
        return $this->render('SRPSSantaBundle:Admin:deletetime.html.twig',
            array(
                'id' => $id,
            ));
    }
    
    /**
     * Handle traintime delete - complete delete
     * @param int $id Traintime id
     * @return type
     * @throws type
     */
    public function confirmtimesAction($id) {
        
        // Get doctrine
        $em = $this->getDoctrine()->getManager();   
        
        $time = $em->getRepository('SRPSSantaBundle:Traintime')->find($id);
        if (!$time) {
            throw $this->createNotFoundException('Time does not exist, id='.$id);
        }
        $em->remove($time);
        $em->flush();
        
        // TODO - probably need to delete some limits and stuff here
        
        return $this->redirect($this->generateUrl('admin_times'));
    }
    
    public function datesAction() {
        
        // get doctrine
        $em = $this->getDoctrine()->getManager();
        
        // get list of train times
        $dates = $em->getRepository('SRPSSantaBundle:Traindate')
            ->findAllOrderedByDate();
        
        return $this->render('SRPSSantaBundle:Admin:dates.html.twig',
            array(
                'dates' => $dates,
            )
        );
    }
}

