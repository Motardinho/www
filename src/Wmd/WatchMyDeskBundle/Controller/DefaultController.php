<?php

namespace Wmd\WatchMyDeskBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Wmd\WatchMyDeskBundle\Entity\Desk;
use Wmd\WatchMyDeskBundle\Entity\DeskComment;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return array('name' => 'Djo');
    }
    
    /** 
    * @Route("/test/{deskId}", name="test")
    * @Template()
    */
    public function testAction($deskId)
    {
        $id = 1;
        
        $desk = $this->getDoctrine()
        ->getRepository('WmdWatchMyDeskBundle:Desk')
        ->find($id);
        
        return array('desk' => $desk);
    }
}
