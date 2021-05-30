<?php


namespace Mini\Model;


use Mini\Core\Model;

class BonusPoint  extends Model
{
    // <editor-fold desc="PARAMS">
    /**
     * @var string
     */
    protected  $category;
    /**
     * @var string
     */
    protected  $type;
    /**
     * @var string
     */
    protected  $language;
    // </editor-fold>
    // <editor-fold desc="STATIC">
    /**
     * BonusPoint constructor.
     *
     * @param string $category
     * @param string $type
     * @param string $language
     */
    public function __construct(string $category,string $type, string $language)
    {
        $this->category = $category;
        $this->type     = $type;
        $this->language = $language;
    }
    // </editor-fold>
    // <editor-fold desc="GETTER">
    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @return string
     */
    public function getLanguage(): string
    {
        return $this->language;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
    // </editor-fold>
    // <editor-fold desc="SETTER">
    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @param string $language
     */
    public function setLanguage(string $language): void
    {
        $this->language = $language;
    }

    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }
    // </editor-fold>
}
