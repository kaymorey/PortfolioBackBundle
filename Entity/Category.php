<?php

namespace Kaymorey\PortfolioBackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kaymorey\PortfolioBackBundle\Entity\Category
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kaymorey\PortfolioBackBundle\Entity\CategoryRepository")
 */
class Category
{
    /**
     * @var integer $id
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string $titre
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $titre
     * @return Category
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getTitre()
    {
        return $this->titre;
    }
}