<?php

namespace Setec\IntranetBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SetecIntranetBundle:Default:index.html.twig');
    }
}
