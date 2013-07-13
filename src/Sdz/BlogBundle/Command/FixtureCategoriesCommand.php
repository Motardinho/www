<?php

namespace Sdz\BlogBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Sdz\BlogBundle\Entity\Categorie;

class FixtureCategoriesCommand extends ContainerAwareCommand
{
	protected function Configure()
	{
		$this->setName('sdz_blog:fixture:categories');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$em = $this->getContainer()->get('doctrine.orm.entity_manager');

		$noms = array('Symfony2', 'Doctrine2', 'Tutoriel', 'Evenement');

		foreach($noms as $i => $nom)
		{
			$output->writeln('Création de la catégorie : '.$nom);

			$liste_categories[$i] = new Categorie();
			$liste_categories[$i]->setNom($nom);

			$em->persist($liste_categories[$i]);
		}

		$output->writeln('Enregistrements des catégories...');

		$em->flush();

		return 0;
	}
}