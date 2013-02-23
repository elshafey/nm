<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * PageDetails
 *
 * @Table(name="page_details")
 * @Entity
 */
class PageDetails
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
     * @Column(name="name", type="string", length=50, nullable=false)
     */
    protected $name;

    /**
     * @var string
     *
     * @Column(name="value", type="text", nullable=false)
     */
    protected $value;

    /**
     * @var string
     *
     * @Column(name="lang_code", type="string", length=11, nullable=true)
     */
    protected $langCode;

    /**
     * @var \Entities\Pages
     *
     * @ManyToOne(targetEntity="Entities\Pages", inversedBy="PageDetails")
     * @JoinColumns({
     *   @JoinColumn(name="page_id", referencedColumnName="id")
     * })
     */
    protected $Pages;


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
     * Set name
     *
     * @param string $name
     * @return PageDetails
     */
    public function setName($name)
    {
        $this->name = $name;
    
        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set value
     *
     * @param string $value
     * @return PageDetails
     */
    public function setValue($value)
    {
        $this->value = $value;
    
        return $this;
    }

    /**
     * Get value
     *
     * @return string 
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Set langCode
     *
     * @param string $langCode
     * @return PageDetails
     */
    public function setLangCode($langCode)
    {
        $this->langCode = $langCode;
    
        return $this;
    }

    /**
     * Get langCode
     *
     * @return string 
     */
    public function getLangCode()
    {
        return $this->langCode;
    }

    /**
     * Set Pages
     *
     * @param \Entities\Pages $pages
     * @return PageDetails
     */
    public function setPages(\Entities\Pages $pages = null)
    {
        $this->Pages = $pages;
    
        return $this;
    }

    /**
     * Get Pages
     *
     * @return \Entities\Pages 
     */
    public function getPages()
    {
        return $this->Pages;
    }
}
