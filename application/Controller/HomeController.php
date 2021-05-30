<?php

/**
 * Class HomeController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;

use Mini\Model\BonusPoint;
use Mini\Model\ExamResult;
use Mini\Model\Result;
use Mini\Model\Specialization;

class HomeController
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {

        $exampleData = [
            'valasztott-szak' => [
                'egyetem' => 'ELTE',
                'kar' => 'IK',
                'szak' => 'Programtervező informatikus',
            ],
            'erettsegi-eredmenyek' => [
                [
                    'nev' => 'magyar nyelv és irodalom',
                    'tipus' => 'közép',
                    'eredmeny' => '15%',
                ],
                [
                    'nev' => 'történelem',
                    'tipus' => 'közép',
                    'eredmeny' => '80%',
                ],
                [
                    'nev' => 'matematika',
                    'tipus' => 'emelt',
                    'eredmeny' => '90%',
                ],
                [
                    'nev' => 'angol nyelv',
                    'tipus' => 'közép',
                    'eredmeny' => '94%',
                ],
                [
                    'nev' => 'informatika',
                    'tipus' => 'közép',
                    'eredmeny' => '95%',
                ],
            ],
            'tobbletpontok' => [
                [
                    'kategoria' => 'Nyelvvizsga',
                    'tipus' => 'B2',
                    'nyelv' => 'angol',
                ],
                [
                    'kategoria' => 'Nyelvvizsga',
                    'tipus' => 'C1',
                    'nyelv' => 'német',
                ],
            ],
        ];


        $exams  = [];
        foreach ($exampleData["erettsegi-eredmenyek"] as $example) {
            $exams[]    = new ExamResult($example["nev"], $example["tipus"], $example["eredmeny"]);
        }
        $bonus  = [];
        foreach ($exampleData["tobbletpontok"] as $bonuspoint) {
            $bonus[]    = new BonusPoint($bonuspoint["kategoria"],$bonuspoint["tipus"],$bonuspoint["nyelv"]);
        }
        $specialization = new Specialization($exampleData["valasztott-szak"]["egyetem"], $exampleData["valasztott-szak"]["kar"], $exampleData["valasztott-szak"]["szak"], $exams);

        if(isset($_SESSION["error"]) and !empty($_SESSION["error"])){
            foreach ( $_SESSION["error"] as $value){
                echo $value;
            }
        }else{
            $bonuspoints    = 0;
            $requiredpoints = 0;
            $firsthigh      = 0;
            $secondhigh     = 0;
            $requiredexams  = $specialization->getRequiredexams();
            $extraexams     = $specialization->getExtraexams();
            $firstname="";
            $secondname="";
            foreach ($exams as $index => $exam) {
                if(in_array($exam->getName(),$requiredexams)) {
                    if($firsthigh<$exam->getResultPercent()){
                        $firsthigh=$exam->getResultPercent();
                        $firstname=$exam->getName();
                    }
                }
                if($exam->getType()=="emelt"){
                    $bonuspoints+=50;
                }
            }
            foreach ($exams as $index => $exam) {
                if(!in_array($exam->getName(),$requiredexams) and in_array($exam->getName(),$extraexams)) {
                    if($secondhigh<$exam->getResultPercent()){
                        $secondhigh=$exam->getResultPercent();
                        $secondname=$exam->getName();
                    }
                }
            }
            $basicpoints=$firsthigh+$secondhigh;
            $basicpoints*=2;
            foreach ($bonus as $index => $item) {
                if($item->getType()=="C1"){
                    $bonuspoints+=40;
                }else{
                    $bonuspoints+=28;
                }
            }
            if($bonuspoints>100){
                $bonuspoints=100;
            }
            //var_dump($firstname);
            //var_dump($secondname);
            $basicpoints=$basicpoints+$requiredpoints;
            $fullpoints=$basicpoints+$bonuspoints;
            $result = new Result($fullpoints, $basicpoints, $bonuspoints);
            // output: 470 (370 alappont + 100 többletpont)

            echo $result->getFullpoints() . " (". $result->getBasicpoints() ." alappont + ". $result->getBonuspoints() ." többletpont)";
        }
    }
}
