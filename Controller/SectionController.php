<?php

namespace Kaymorey\PortfolioBackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;

use Kaymorey\PortfolioBackBundle\Entity\Category;
use Kaymorey\PortfolioBackBundle\Form\CategoryType;

use Kaymorey\PortfolioBackBundle\Entity\Work;
use Kaymorey\PortfolioBackBundle\Form\WorkType;


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

        $request = $this->get('request');
        $referer = $request->headers->get("referer");

        return $this->render('KaymoreyPortfolioBackBundle:List:categories.html.twig', array(
            "categories" => $categories
        ));
    }
    /**
     * @Route("/categories/add", name="portfolioback_categories_add")
     */
    public function addCategoriesAction()
    {
        $category = new Category();
        $form = $this->createForm(new CategoryType, $category);

        $request = $this->get('request');

        if( $request->getMethod() == 'POST' ) {
            $form->bind($request);

            if( $form->isValid() ) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($category);
                $em->flush();
                return $this->redirect($this->generateUrl('portfolioback_categories'));
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

            return $this->redirect($this->generateUrl('portfolioback_categories'));
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

        $form = $this->createForm(new CategoryType, $category);

        $request = $this->get('request');

        if( $request->getMethod() == 'POST' ) {
            $form->bind($request);
            if( $form->isValid() ) {
                $em = $this->getDoctrine()->getEntityManager();
                $em->flush();
                return $this->redirect($this->generateUrl('portfolioback_categories'));
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
     * @Route("/projects/add", name="portfolioback_projects_add")
     */
    public function addProjectsAction(Request $data)
    {
        $work = new Work();
        $form = $this->createForm(new WorkType, $work);

        $request = $this->get('request');

        if( $request->getMethod() == 'POST' ) {
            $form->bind($request);

            if( $form->isValid() ) {
                $em = $this->getDoctrine()->getEntityManager();

                // Set image
                $form['img']->getData()->move($dir, $someNewFilename);
               
                // Set date
                $data = $data->request->get('kaymorey_portfoliobackbundle_worktype');
                $date = new \DateTime('01/01/'.$data['date']);
                $work->setDate($date);
                
                $em->persist($work);
                $em->flush();
                return $this->redirect($this->generateUrl('portfolioback_projets'));
            }
        }

        return $this->render('KaymoreyPortfolioBackBundle:Add:projets.html.twig', array(
            "form" => $form->createView()
        ));
    }
}
