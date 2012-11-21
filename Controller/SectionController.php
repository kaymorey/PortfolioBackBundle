<?php

namespace Kaymorey\PortfolioBackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Kaymorey\PortfolioBackBundle\Entity\Category;


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
     * @Route("/categories/{action}", name="portfolioback_categories", defaults={"action" = false})
     */
    public function categoriesAction($action)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('KaymoreyPortfolioBackBundle:Category');
        $categories = $repository->findAll();
        return $this->render('KaymoreyPortfolioBackBundle:List:categories.html.twig', array(
            "categories" => $categories,
            "action" => $action
        ));
    }
    /**
     * @Route("/categories/add", name="portfolioback_categories_add")
     */
    public function addCategoriesAction()
    {
        $category = new Category();

        $formBuilder = $this->createFormBuilder($category);

        $formBuilder->add('Titre', 'text');
        $form = $formBuilder->getForm();

        $request = $this->get('request');

        if( $request->getMethod() == 'POST' ) {
            $form->bind($request);

            if( $form->isValid() ) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($category);
                $em->flush();
                return $this->redirect($this->generateUrl('portfolioback_categories', array(
                    "add" => "true",
                    "category" => $category
                )));
            }
        }

        return $this->render('KaymoreyPortfolioBackBundle:Add:categories.html.twig', array(
            "form" => $form->createView()
        ));
    }
    /**
     * @Route("/categories/remove/{id}/{action}", name="portfolioback_categories_remove", defaults={"action" = null}, options={"expose"=true})
     */
    public function removeCategoriesAction($id, $action)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('KaymoreyPortfolioBackBundle:Category');
        $category = $repository->findOneById($id);

        if($action != null) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($category);
            $em->flush();

            return $this->redirect($this->generateUrl('portfolioback_categories', array(
                "action" => "remove"
            )));
        }
        else {
            $repository = $this->getDoctrine()->getManager()->getRepository('KaymoreyPortfolioBackBundle:Work');
            $works = $repository->findOneByCategory($category);

            if($works != null) {
                $canRemove = false;
            }
            else {
                $canRemove = true;
            }
        }
        return $this->render('KaymoreyPortfolioBackBundle:Remove:categories.html.twig', array(
            "categorie" => $category,
            "canRemove" => $canRemove
        ));
    }
    /**
     * @Route("/categories/edit/{id}", name="portfolioback_categories_edit")
     */
    public function editCategoriesAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('KaymoreyPortfolioBackBundle:Category');
        $category = $repository->findOneById($id);

        $formBuilder = $this->createFormBuilder($category);

        $formBuilder->add('Titre', 'text');
        $form = $formBuilder->getForm();

        $request = $this->get('request');

        if( $request->getMethod() == 'POST' ) {
            $form->bind($request);
            if( $form->isValid() ) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->flush();
                return $this->forward('KaymoreyPortfolioBackBundle:Section:categories', array(
                    "action" => "edit",
                    "category" => $category
                ));
            }
        }

        return $this->render('KaymoreyPortfolioBackBundle:Edit:categories.html.twig', array(
            "form" => $form->createView(),
            "categorie" => $category
        ));
    }
     /**
     * @Route("/projets", name="portfolioback_projets")
     */
    public function projetsAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('KaymoreyPortfolioBackBundle:Work');
        $works = $repository->findAll();
        return $this->render('KaymoreyPortfolioBackBundle:List:projets.html.twig', array(
            "projets" => $works
        ));
    }
     /**
     * @Route("/projets/add", name="portfolioback_projets_add")
     */
     public function addProjetsAction()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('KaymoreyPortfolioBackBundle:Category');
        $categories = $repository->findAll();
        return $this->render('KaymoreyPortfolioBackBundle:Add:projets.html.twig', array(
            "categories" => $categories
        ));
    }
}
