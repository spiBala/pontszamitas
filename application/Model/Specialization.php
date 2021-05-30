<?php


namespace Mini\Model;


use Mini\Core\Model;

class Specialization  extends Model
{
    // <editor-fold desc="PARAMS">
    /**
     * @var string
     */
    protected  $university;
    /**
     * @var string
     */
    protected  $specialization;
    /**
     * @var string
     */
    protected  $faculty;
    protected  $requiredexams;
    protected  $extraexams;

    // </editor-fold>
    // <editor-fold desc="STATIC">
    /**
     * Specialization constructor.
     *
     * @param string $university
     * @param string $specialization
     * @param string $faculty
     * @param \Mini\Model\ExamResult[]  $examresults
     * @param \Mini\Model\BonusPoint[]  $bonuspoints
     */
    public function __construct(string $university,string $specialization, string $faculty,array $examresults)
    {
        parent::__construct();
        $this->university       = $university;
        $this->specialization   = $specialization;
        $this->faculty          = $faculty;
        $error                  = 0;
        $requivest              = [];

        foreach ($examresults as $index => $examresult) {
            if($examresult->getType()=="emelt"){
                $requivest[$examresult->getName()]  = 2;
            }else{
                $requivest[$examresult->getName()]  = 1;
            }
        }
        if(!isset($requivest["magyar nyelv és irodalom"]) or !isset($requivest["történelem"]) or !isset($requivest["matematika"]))
        {
            $_SESSION["error"][]="hiba, nem lehetséges a pontszámítás a kötelező érettségi tárgyak hiánya miatt";
        }
        if($university=="ELTE" and $specialization=="IK" )
        {
            $this->requiredexams[]="matematika";
            $this->extraexams[]="biológia";
            $this->extraexams[]="fizika";
            $this->extraexams[]="informatika";
            $this->extraexams[]="kémia";

            if(isset($requivest["matematika"]) and (isset($requivest["biológia"]) or isset($requivest["fizika"]) or isset($requivest["informatika"]) or isset($requivest["kémia"])))
            {
                $error=0;
            }else{
                $_SESSION["error"][]="Nem felel meg a szak elvárásainak a pontszámtás nem lehetséges!";
            }
        }
        if($university=="PPKE" and $specialization=="BTK" ){
            $this->requiredexams[]="angol";
            $this->extraexams[]="francia";
            $this->extraexams[]="német";
            $this->extraexams[]="olasz";
            $this->extraexams[]="orosz";
            $this->extraexams[]="spanyol";
            $this->extraexams[]="történelem";
            if(isset($requivest["angol nyelv"]) and $requivest["angol nyelv"]==2)
            {
                $error=0;
            }else{
                $_SESSION["error"][]="Nem felel meg a szak elvárásainak a pontszámtás nem lehetséges!";
            }
        }
    }
    // </editor-fold>
    // <editor-fold desc="GETTER">
    /**
     * @return string
     */
    public function getFaculty(): string
    {
        return $this->faculty;
    }

    /**
     * @return string
     */
    public function getSpecialization(): string
    {
        return $this->specialization;
    }

    /**
     * @return string
     */
    public function getUniversity(): string
    {
        return $this->university;
    }

    /**
     * @return mixed
     */
    public function getExtraexams()
    {
        return $this->extraexams;
    }

    /**
     * @return mixed
     */
    public function getRequiredexams()
    {
        return $this->requiredexams;
    }
    // </editor-fold>
    // <editor-fold desc="SETTER">
    /**
     * @param string $faculty
     */
    public function setFaculty(string $faculty): void
    {
        $this->faculty = $faculty;
    }

    /**
     * @param string $specialization
     */
    public function setSpecialization(string $specialization): void
    {
        $this->specialization = $specialization;
    }

    /**
     * @param string $university
     */
    public function setUniversity(string $university): void
    {
        $this->university = $university;
    }
    // </editor-fold>
}
