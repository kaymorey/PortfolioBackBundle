<?php

namespace Kaymorey\PortfolioBackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\UploadedFile;

use Kaymorey\PortfolioBackBundle\Entity\Category;
use Kaymorey\PortfolioBackBundle\Form\CategoryType;

use Kaymorey\PortfolioBackBundle\Entity\Work;
use Kaymorey\PortfolioBackBundle\Form\WorkType;

use Kaymorey\PortfolioBackBundle\Entity\Doc;
use Kaymorey\PortfolioBackBundle\Form\DocType;

use Kaymorey\PortfolioBackBundle\Controller\Tools;

class SectionController extends WebController
{
    /**
     * @Route("/", name="portfolioback_index")
     * 
     */
    public function indexAction()
    {
        $last_works = $this->getLastWorks(3, 0);
        return $this->render('KaymoreyPortfolioBackBundle::index.html.twig', array(
            "projets" => $last_works
        ));
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
     * @Route("/projets", name="portfolioback_projects")
     */
    public function projectsAction()
    {
        $workRepository = $this->getDoctrine()->getManager()->getRepository('KaymoreyPortfolioBackBundle:Work');
        $works = $workRepository->findAll();

        $docRepository = $this->getDoctrine()->getManager()->getRepository('KaymoreyPortfolioBackBundle:Doc');
        $docs = $docRepository->findAll();

        return $this->render('KaymoreyPortfolioBackBundle:List:projets.html.twig', array(
            "projets" => $works,
            "docs" => $docs
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

        if($request->getMethod() == 'POST') {
            $form->bind($request);

            if($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();

                $data = $data->request->get('kaymorey_portfoliobackbundle_worktype');

                // Set publishedAt
                $now = new \DateTime();
                $work->setPublishedAt($now);

                // set modifiedAt
                $work->setModifiedAt($now);
                
                // Set slug
                $slug = $this->slug($data['title']);
                $work->setSlug($slug);
                
                $em->persist($work);
                $em->flush();
                return $this->redirect($this->generateUrl('portfolioback_projects'));
            }
        }

        return $this->render('KaymoreyPortfolioBackBundle:Add:projets.html.twig', array(
            "form" => $form->createView()
        ));
    }
    /**
     * @Route("/projets/edit/{id}", name="portfolioback_projects_edit")
     */
    public function editProjectsAction($id)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('KaymoreyPortfolioBackBundle:Work');
        $work = $repository->findOneById($id);

        $form = $this->createForm(new WorkType, $work);

        $request = $this->get('request');

        if( $request->getMethod() == 'POST' ) {
            $form->bind($request);
            if( $form->isValid() ) {
                // Set modifiedAt
                $now = new \DateTime();
                $work->setModifiedAt($now);

                $em = $this->getDoctrine()->getEntityManager();
                $em->flush();
                return $this->redirect($this->generateUrl('portfolioback_projects'));
            }
        }

        return $this->render('KaymoreyPortfolioBackBundle:Edit:projets.html.twig', array(
            "form" => $form->createView(),
            "projet" => $work
        ));
    }
    /**
     * @Route("/projets/remove/{id}/{action}", name="portfolioback_projects_remove", defaults={"action" = null}, options={"expose"=true})
     */
    public function removeProjectsAction($id, $action)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository('KaymoreyPortfolioBackBundle:Work');
        $work = $repository->findOneById($id);

        if($action != null) {
            // Penser à gérer les documents liés grâce à une relation cascade
            $em = $this->getDoctrine()->getEntityManager();
            $em->remove($work);
            $em->flush();

            return $this->redirect($this->generateUrl('portfolioback_projects'));
        }
        return $this->render('KaymoreyPortfolioBackBundle:Remove:projets.html.twig', array(
            "projet" => $work
        ));
    }

    /**
     * @Route("/projets/documents/{id}", name="portfolioback_projects_docs")
     */
    public function editDocsProjectsAction($id)
    {
        $form = $this->createForm(new DocType);

        $repository = $this->getDoctrine()->getManager()->getRepository('KaymoreyPortfolioBackBundle:Work');
        $work = $repository->findOneById($id);
        $docs = $work->getDocs();

        return $this->render('KaymoreyPortfolioBackBundle:List:docs.html.twig', array(
            "form" => $form->createView(),
            "docs" => $docs,
            "projet" => $work
        ));
    }
    /**
     * @Route("/projets/documents/{id}/add", name="portfolioback_projects_docs_add")
     */
    public function addDocsProjectsAction(Request $request, $id)
    {
        $doc = new Doc();
        $repository = $this->getDoctrine()->getManager()->getRepository('KaymoreyPortfolioBackBundle:Work');
        $work = $repository->findOneById($id);

        $form = $this->createForm(new DocType, $doc);
        $form->bind($request);

        if($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            
            $work->addDoc($doc);

            $em->persist($doc);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('portfolioback_projects_docs', array(
            "id" => $id
        )));
    }
     /**
     * @Route("/projets/documents/{workId}/remove/{id}", name="portfolioback_projects_docs_remove")
     */
    public function removeDocsProjectsAction(Request $request, $id, $workId)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $doc = $em->getRepository('KaymoreyPortfolioBackBundle:Doc')
            ->findOneById($id);

        $work = $em->getRepository('KaymoreyPortfolioBackBundle:Work')
            ->findOneById($workId);

        $work->removeDoc($doc);

        $em->remove($doc);
        $em->flush();

        return $this->redirect($this->generateUrl('portfolioback_projects_docs', array(
            "id" => $workId
        )));
    }
}
