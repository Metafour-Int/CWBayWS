<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Ad
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\AdRepository")
 */
class Ad
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;

    /**
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="ads")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;
    
    /**
     * @ORM\OneToMany(targetEntity="Image", mappedBy="ad")
     */
    protected $images;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="ads")
     * @ORM\JoinColumn(name="user_email", referencedColumnName="email")
     */
    private $user;
    
    /**
     * @ORM\Column(type="datetime")
     */
    private $postedAt;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $approved;
    
    /**
     * @ORM\Column(type="boolean")
     */
    private $closed;
    
    /**
     * @ORM\ManyToOne(targetEntity="Place", inversedBy="ads")
     * @ORM\JoinColumn(name="place_id", referencedColumnName="id")
     */
    private $postedFrom;
    
    /**
     *
     * @ORM\Column(type="string", length=255)
     */
    private $contactName;
    
    /**
     *
     * @ORM\Column(type="string", length=255)
     */
    private $contactNumber;
    
    /**
     *
     * @ORM\Column(type="string", length=255)
     */
    private $contactMail;
    
    public function __construct()
    {
    	$this->images = new ArrayCollection();
    }
    
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
     * Set title
     *
     * @param string $title
     * @return Ad
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Ad
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set price
     *
     * @param string $price
     * @return Ad
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set postedAt
     *
     * @param \DateTime $postedAt
     * @return Ad
     */
    public function setPostedAt($postedAt)
    {
        $this->postedAt = $postedAt;

        return $this;
    }

    /**
     * Get postedAt
     *
     * @return \DateTime 
     */
    public function getPostedAt()
    {
        return $this->postedAt;
    }

    /**
     * Set approved
     *
     * @param boolean $approved
     * @return Ad
     */
    public function setApproved($approved)
    {
        $this->approved = $approved;

        return $this;
    }

    /**
     * Get approved
     *
     * @return boolean 
     */
    public function getApproved()
    {
        return $this->approved;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     * @return Ad
     */
    public function setCategory(\AppBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     * @return Ad
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set postedFrom
     *
     * @param \AppBundle\Entity\Place $postedFrom
     * @return Ad
     */
    public function setPostedFrom(\AppBundle\Entity\Place $postedFrom = null)
    {
        $this->postedFrom = $postedFrom;

        return $this;
    }

    /**
     * Get postedFrom
     *
     * @return \AppBundle\Entity\Place 
     */
    public function getPostedFrom()
    {
        return $this->postedFrom;
    }

    /**
     * Set closed
     *
     * @param boolean $closed
     * @return Ad
     */
    public function setClosed($closed)
    {
        $this->closed = $closed;

        return $this;
    }

    /**
     * Get closed
     *
     * @return boolean 
     */
    public function getClosed()
    {
        return $this->closed;
    }

    /**
     * Set contactName
     *
     * @param string $contactName
     * @return Ad
     */
    public function setContactName($contactName)
    {
        $this->contactName = $contactName;

        return $this;
    }

    /**
     * Get contactName
     *
     * @return string 
     */
    public function getContactName()
    {
        return $this->contactName;
    }

    /**
     * Set contactNumber
     *
     * @param string $contactNumber
     * @return Ad
     */
    public function setContactNumber($contactNumber)
    {
        $this->contactNumber = $contactNumber;

        return $this;
    }

    /**
     * Get contactNumber
     *
     * @return string 
     */
    public function getContactNumber()
    {
        return $this->contactNumber;
    }

    /**
     * Set contactMail
     *
     * @param string $contactMail
     * @return Ad
     */
    public function setContactMail($contactMail)
    {
        $this->contactMail = $contactMail;

        return $this;
    }

    /**
     * Get contactMail
     *
     * @return string 
     */
    public function getContactMail()
    {
        return $this->contactMail;
    }

    /**
     * Add images
     *
     * @param \AppBundle\Entity\Image $images
     * @return Ad
     */
    public function addImage(\AppBundle\Entity\Image $images)
    {
        $this->images[] = $images;

        return $this;
    }

    /**
     * Remove images
     *
     * @param \AppBundle\Entity\Image $images
     */
    public function removeImage(\AppBundle\Entity\Image $images)
    {
        $this->images->removeElement($images);
    }

    /**
     * Get images
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getImages()
    {
        return $this->images;
    }
}
