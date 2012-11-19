<?php

namespace Kaymorey\PortfolioBackBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kaymorey\PortfolioBackBundle\Entity\Doc
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kaymorey\PortfolioBackBundle\Entity\DocRepository")
 */
class Doc
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
     * @ORM\ManyToOne(targetEntity="Kaymorey\PortfolioBackBundle\Entity\Work")
     * @ORM\JoinColumn(nullable=false)
     */
    private $work;

    /**
     * @var string $path
     *
     * @ORM\Column(name="path", type="string", length=255)
     */
    private $path;

    /**
     * @var string $type
     *
     * @ORM\Column(name="type", type="string", length=255)
     */
    private $type;

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
     * Set work
     *
     * @param Kaymorey\PortfolioBackBundle\Entity\Work $work
     * @return Doc
     */
    public function setWork(\Kaymorey\PortfolioBackBundle\Entity\Work $work)
    {
        $this->work = $work;
    
        return $this;
    }

    /**
     * Get work
     *
     * @return Kaymorey\PortfolioBackBundle\Entity\Work 
     */
    public function getWork()
    {
        return $this->work;
    }

    /**
     * Set path
     *
     * @param string $path
     * @return Doc
     */
    public function setPath($path)
    {
        $this->path = $path;
    
        return $this;
    }

    /**
     * Get path
     *
     * @return string 
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Doc
     */
    public function setType($type)
    {
        $this->type = $type;
    
        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }
}