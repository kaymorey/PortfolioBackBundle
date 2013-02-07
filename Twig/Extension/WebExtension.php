<?php

namespace Kaymorey\PortfolioBackBundle\Twig\Extension;

use Kaymorey\PortfolioBackBundle\Entity\Work;

class WebExtension extends \Twig_Extension
{
	public function getFunctions() {
		 return array(
		 	'getDocs' => new \Twig_Function_Method($this, 'getDocs')
		 );
	}
	public function getDocs($work) {
		if ($work instanceof Work) 
			return $work->getDocsByWork($work);
		return null;
	}
	public function getName()
    {
        return 'portfolioweb_extension';
    }
}