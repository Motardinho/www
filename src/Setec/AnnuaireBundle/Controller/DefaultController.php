<?php

namespace Setec\AnnuaireBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Setec\SalarieBundle\Entity\Salarie;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $repository = $this->getDoctrine()
            ->getEntityManager()
            ->getRepository('SetecSalarieBundle:Salarie');

        $salaries = $repository->findAll();

        return $this->render('SetecAnnuaireBundle:Default:index.html.twig', array('salaries' => $salaries));
    }
}
