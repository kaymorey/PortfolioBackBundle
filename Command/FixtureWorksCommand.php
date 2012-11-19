<?php

namespace Kaymorey\PortfolioBackBundle\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand; 

use Kaymorey\PortfolioBackBundle\Entity\Work;

class FixtureWorksCommand extends ContainerAwareCommand
{
	protected function configure()
	{
		$this->setName('kaymorey:fixture:works');
	}
	protected function execute(InputInterface $input, OutputInterface $output)
	{
		$em = $this->getContainer()->get('doctrine.orm.entity_manager');

		$titles = array('CWB', 'La Poste', 'Mosayc');

		foreach($titles as $i => $title) {
			$output->writeln('Creation du projet : '.$title);

			$liste_projets[$i] = new Work(); 
			$liste_projets[$i]->setTitle($title);

			$em->persist($liste_projets[$i]); 
		}

			$output->writeln('Enregistrement des projets...');
			$em->flush();

			return 0; 
	}
}