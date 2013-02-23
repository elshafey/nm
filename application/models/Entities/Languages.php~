<?php

namespace Entities;

use Doctrine\ORM\Mapping as ORM;

/**
 * Languages
 *
 * @Table(name="languages")
 * @Entity
 */
class Languages
{
    /**
     * @var integer
     *
     * @Column(name="lang_id", type="integer", nullable=false)
     * @Id
     * @GeneratedValue(strategy="IDENTITY")
     */
    protected $langId;

    /**
     * @var string
     *
     * @Column(name="lang_code", type="string", nullable=false)
     */
    protected $langCode;

    /**
     * @var string
     *
     * @Column(name="lang_name", type="string", length=50, nullable=false)
     */
    protected $langName;


    /**
     * Get langId
     *
     * @return integer 
     */
    public function getLangId()
    {
        return $this->langId;
    }

    /**
     * Set langCode
     *
     * @param string $langCode
     * @return Languages
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
     * Set langName
     *
     * @param string $langName
     * @return Languages
     */
    public function setLangName($langName)
    {
        $this->langName = $langName;
    
        return $this;
    }

    /**
     * Get langName
     *
     * @return string 
     */
    public function getLangName()
    {
        return $this->langName;
    }
}
