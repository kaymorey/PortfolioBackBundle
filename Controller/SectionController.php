<?php

namespace Kaymorey\PortfolioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class SectionController extends Controller
{
	/**
     * @Route("/test", name="portfolio_test")
     */
    public function testAction()
    {
        return $this->render('KaymoreyPortfolioBundle::test.html.twig');
    }
}
