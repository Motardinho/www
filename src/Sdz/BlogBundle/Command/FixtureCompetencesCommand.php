<?php

namespace Sdz\BlogBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Sdz\BlogBundle\Entity\Competence;

class FixtureCompetencesCommand extends ContainerAwareCommand
{
	protected function Configure()
	{
		$this->setName('sdz_blog:fixture:competences');
	}

	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$em = $this->getContainer()->get('doctrine.orm.entity_manager');

		$noms = array('Doctrine', 'Formulaire', 'Twig');

		foreach($noms as $i => $nom)
		{
			$output->writeln('Creation de la competence : '.$nom);

			$liste_competences[$i] = new Competence();
			$liste_competences[$i]->setNom($nom);

			$em->persist($liste_competences[$i]);
		}

		$output->writeln('Enregistrement des competences...');

		$em->flush();

		return 0;
	}
}