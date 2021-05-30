<?php


namespace Mini\Model;


use Mini\Core\Application;
use Mini\Core\Model;

class ExamResult  extends Model
{
    // <editor-fold desc="PARAMS">
    /**
     * @var string
     */
    protected  $name;
    /**
     * @var string
     */
    protected  $type;
    /**
     * @var string
     */
    protected  $result;
    // </editor-fold>
    // <editor-fold desc="STATIC">
    /**
     * ExamResult constructor.
     *
     * @param string $name
     * @param string $type
     * @param string $result
     */
    public function __construct(string $name,string $type, string $result)
    {
        $this->name     = $name;
        $this->type     = $type;
        $this->result   = $result;
        if(intval($result)<20)
        {
            $_SESSION["error"][]="20% alatti érettségi eredménnyel nem lehetséges a pontszámtás!";
        }
    }
    // </editor-fold>
    // <editor-fold desc="GETTER">
    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getResult(): string
    {
        return $this->result;
    }
    public function getResultPercent(): int
    {
        return intval($this->result);
    }
    // </editor-fold>
    // <editor-fold desc="SETTER">
    /**
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @param string $result
     */
    public function setResult(string $result): void
    {
        $this->result = $result;
    }
    // </editor-fold>
}
