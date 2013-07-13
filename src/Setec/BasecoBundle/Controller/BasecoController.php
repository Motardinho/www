<?php

namespace Setec\BasecoBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class BasecoController extends Controller
{
    public function indexAction()
    {
        return $this->render('SetecBasecoBundle:Default:index.html.twig');
    }
}
