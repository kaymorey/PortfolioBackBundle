<?php

namespace Kaymorey\PortfolioBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kaymorey\PortfolioBundle\Entity\Doc
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Kaymorey\PortfolioBundle\Entity\DocRepository")
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
     * @var integer $id_work
     *
     * @ORM\Column(name="id_work", type="integer")
     */
    private $id_work;

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
     * Set id_work
     *
     * @param integer $idWork
     * @return Doc
     */
    public function setIdWork($idWork)
    {
        $this->id_work = $idWork;
    
        return $this;
    }

    /**
     * Get id_work
     *
     * @return integer 
     */
    public function getIdWork()
    {
        return $this->id_work;
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
