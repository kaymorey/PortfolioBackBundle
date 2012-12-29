<?php

namespace Kaymorey\PortfolioBackBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use Kaymorey\PortfolioBackBundle\Entity\Work;


class WebController extends ToolsController
{
    protected function getLastWorks($limit, $offset) 
    { 
        $repository = $this->getDoctrine()->getManager()->getRepository('KaymoreyPortfolioBackBundle:Work');
        $last_works = $repository->findBy(array(), array('published_at' => 'desc'), $limit, $offset);
        return $last_works;
    }
}
