<?php

namespace Setec\AffelecBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Setec\AffelecBundle\Entity\Fichier;
use JMS\SecurityExtraBundle\Annotation\Secure;

class DefaultController extends Controller
{
    /**
     * @Secure(roles="ROLE_ADMIN")
     */
    public function depotAction()
    {
        $fichier = new Fichier();

        $formBuilder = $this->createFormBuilder($fichier);

        $formBuilder
            ->add("date_ajout", "date")
            ->add("nom", "text")
            ->add("description", "textarea");

        $form = $formBuilder->getForm();

        return $this->render('SetecAffelecBundle:Default:depot.html.twig', array("form" => $form->createView()));
    }

    /**
     * @Secure(roles="ROLE_AUTEUR")
     */
    public function rechercheAction()
    {
    	return $this->render('SetecAffelecBundle:Default:recherche.html.twig');
    }

    /**
     * @Secure(roles="ROLE_ADMIN")
     */
    public function adminAction()
    {
    	return $this->render('SetecAffelecBundle:Default:admin.html.twig');
    }
}
