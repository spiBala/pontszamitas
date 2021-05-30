<?php


namespace Mini\Model;


use Mini\Core\Model;

class Result  extends Model
{
    // <editor-fold desc="PARAMS">
    /**
     * @var int
     */
    protected  $fullpoints;
    /**
     * @var int
     */
    protected  $basicpoints;
    /**
     * @var int
     */
    protected  $bonuspoints;
    // </editor-fold>
    // <editor-fold desc="STATIC">
    /**
     * Result constructor.
     *
     * @param int $fullpoints
     * @param int $basicpoints
     * @param int $bonuspoints
     */
    public function __construct(int $fullpoints,int $basicpoints,int $bonuspoints)
    {
        parent::__construct();
        $this->fullpoints   = $fullpoints;
        $this->basicpoints  = $basicpoints;
        $this->bonuspoints  = $bonuspoints;
    }
    // </editor-fold>
    // <editor-fold desc="GETTER">
    /**
     * @return int
     */
    public function getBasicpoints(): int
    {
        return $this->basicpoints;
    }

    /**
     * @return int
     */
    public function getBonuspoints(): int
    {
        return $this->bonuspoints;
    }

    /**
     * @return int
     */
    public function getFullpoints(): int
    {
        return $this->fullpoints;
    }
    // </editor-fold>
    // <editor-fold desc="SETTER">
    /**
     * @param int $basicpoints
     */
    public function setBasicpoints(int $basicpoints): void
    {
        $this->basicpoints = $basicpoints;
    }

    /**
     * @param int $bonuspoints
     */
    public function setBonuspoints(int $bonuspoints): void
    {
        $this->bonuspoints = $bonuspoints;
    }

    /**
     * @param int $fullpoints
     */
    public function setFullpoints(int $fullpoints): void
    {
        $this->fullpoints = $fullpoints;
    }
    // </editor-fold>
}
