<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pages
 *
 * @Table(name="pages")
 * @Entity
 */
class Pages
{
    /**
     * @var integer
     *
     * @Column(name="id", type="bigint", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string
     *
     * @Column(name="namespace", type="string", length=50, nullable=false)
     */
    protected $namespace;

    /**
     * @var integer
     *
     * @Column(name="page_order", type="integer", nullable=true)
     */
    protected $pageOrder;

    /**
     * @var boolean
     *
     * @Column(name="is_active", type="boolean", nullable=true)
     */
    protected $isActive;

    /**
     * @var \DateTime
     *
     * @Column(name="created_on", type="datetime", nullable=false)
     */
    protected $createdOn;

    /**
     * @var \DateTime
     *
     * @Column(name="updated_on", type="datetime", nullable=false)
     */
    protected $updatedOn;

    /**
     * @var \Entities\Pages
     *
     * @ManyToOne(targetEntity="Entities\Pages", inversedBy="Pages")
     * @JoinColumns({
     *   @JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    protected $parent;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany(targetEntity="Entities\PageDetails", mappedBy="Pages")
     * @JoinColumns({
     *   @JoinColumn(name="page_id", referencedColumnName="id")
     * })
     */
    protected $PageDetails;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @OneToMany(targetEntity="Entities\Pages", mappedBy="parent")
     * @JoinColumns({
     *   @JoinColumn(name="parent_id", referencedColumnName="id")
     * })
     */
    protected $Pages;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->PageDetails = new \Doctrine\Common\Collections\ArrayCollection();
        $this->Pages = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set namespace
     *
     * @param string $namespace
     * @return Pages
     */
    public function setNamespace($namespace)
    {
        $this->namespace = $namespace;
    
        return $this;
    }

    /**
     * Get namespace
     *
     * @return string 
     */
    public function getNamespace()
    {
        return $this->namespace;
    }

    /**
     * Set pageOrder
     *
     * @param integer $pageOrder
     * @return Pages
     */
    public function setPageOrder($pageOrder)
    {
        $this->pageOrder = $pageOrder;
    
        return $this;
    }

    /**
     * Get pageOrder
     *
     * @return integer 
     */
    public function getPageOrder()
    {
        return $this->pageOrder;
    }

    /**
     * Set isActive
     *
     * @param boolean $isActive
     * @return Pages
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
    
        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean 
     */
    public function getIsActive()
    {
        return $this->isActive;
    }

    /**
     * Set createdOn
     *
     * @param \DateTime $createdOn
     * @return Pages
     */
    public function setCreatedOn($createdOn)
    {
        $this->createdOn = $createdOn;
    
        return $this;
    }

    /**
     * Get createdOn
     *
     * @return \DateTime 
     */
    public function getCreatedOn()
    {
        return $this->createdOn;
    }

    /**
     * Set updatedOn
     *
     * @param \DateTime $updatedOn
     * @return Pages
     */
    public function setUpdatedOn($updatedOn)
    {
        $this->updatedOn = $updatedOn;
    
        return $this;
    }

    /**
     * Get updatedOn
     *
     * @return \DateTime 
     */
    public function getUpdatedOn()
    {
        return $this->updatedOn;
    }

    /**
     * Set parent
     *
     * @param \Entities\Pages $parent
     * @return Pages
     */
    public function setParent(\Entities\Pages $parent = null)
    {
        $this->parent = $parent;
    
        return $this;
    }

    /**
     * Get parent
     *
     * @return \Entities\Pages 
     */
    public function getParent()
    {
        return $this->parent;
    }

    /**
     * Add PageDetails
     *
     * @param \Entities\PageDetails $pageDetails
     * @return Pages
     */
    public function addPageDetail(\Entities\PageDetails $pageDetails)
    {
        $this->PageDetails[] = $pageDetails;
    
        return $this;
    }

    /**
     * Remove PageDetails
     *
     * @param \Entities\PageDetails $pageDetails
     */
    public function removePageDetail(\Entities\PageDetails $pageDetails)
    {
        $this->PageDetails->removeElement($pageDetails);
    }

    /**
     * Get PageDetails
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPageDetails()
    {
        return $this->PageDetails;
    }

    /**
     * Add Pages
     *
     * @param \Entities\Pages $pages
     * @return Pages
     */
    public function addPage(\Entities\Pages $pages)
    {
        $this->Pages[] = $pages;
    
        return $this;
    }

    /**
     * Remove Pages
     *
     * @param \Entities\Pages $pages
     */
    public function removePage(\Entities\Pages $pages)
    {
        $this->Pages->removeElement($pages);
    }

    /**
     * Get Pages
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPages()
    {
        return $this->Pages;
    }
}
