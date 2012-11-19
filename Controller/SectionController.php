<?php

namespace Kaymorey\PortfolioBackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class SectionController extends Controller
{
    /**
     * @Route("/", name="portfolioback_index")
     * 
     */
    public function indexAction()
    {
        return $this->render('KaymoreyPortfolioBackBundle::index.html.twig');
    }
     /**
     * @Route("/categories", name="portfolioback_categories")
     */
    public function categoriesAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('KaymoreyPortfolioBackBundle:Category');
        $categories = $repository->findAll();
        return $this->render('KaymoreyPortfolioBackBundle:List:categories.html.twig', 
            array("categories" => $categories)
        );
    }
     /**
     * @Route("/projets", name="portfolioback_projets")
     */
    public function projetsAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('KaymoreyPortfolioBackBundle:Work');
        $works = $repository->findAll();
        return $this->render('KaymoreyPortfolioBackBundle:List:projets.html.twig', 
            array("projets" => $works)
        );
    }
     /**
     * @Route("/projets/add", name="portfolioback_projets_add")
     */
     public function addProjetsAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('KaymoreyPortfolioBackBundle:Category');
        $categories = $repository->findAll();
        return $this->render('KaymoreyPortfolioBackBundle:Add:projets.html.twig',
            array("categories" => $categories)
        );
    }
}
