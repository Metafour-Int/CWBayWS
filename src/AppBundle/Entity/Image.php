<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Image
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\ImageRepository")
 */
class Image
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="file", type="string", length=255)
     */
    private $file;


    /**
     * @ORM\ManyToOne(targetEntity="Ad", inversedBy="images")
     * @ORM\JoinColumn(name="ad_id", referencedColumnName="id")
     */
    private $ad;
    
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
     * Set file
     *
     * @param string $file
     * @return Image
     */
    public function setFile($file)
    {
        $this->file = $file;

        return $this;
    }

    /**
     * Get file
     *
     * @return string 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set ad
     *
     * @param \AppBundle\Entity\Ad $ad
     * @return Image
     */
    public function setAd(\AppBundle\Entity\Ad $ad = null)
    {
        $this->ad = $ad;

        return $this;
    }

    /**
     * Get ad
     *
     * @return \AppBundle\Entity\Ad 
     */
    public function getAd()
    {
        return $this->ad;
    }
}
