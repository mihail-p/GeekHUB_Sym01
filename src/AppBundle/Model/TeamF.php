<?php

namespace AppBundle\Model;

use Faker;
class TeamF
{
    private $fake;

    public function __construct()
    {
        $fPerson = $this->setFake();
    }

    public function setFake()
    {
        $this->fake = Faker\Factory::create('en_EN');
    }

    public function getFake()
    {
        return $this->fake;
    }

    public function fTextStr()
    {
        $fText = $this->fake->text(700);

        return $fText;
    }

    public function fPersonStr()  //$num)
    {
        $fake = $this->fake;
 /*       $fList = [];
        for ($i = 1; $i <= $num; $i++) { */
            $fPerson = $fake->firstName.' '.$fake->lastName;
 /*           $fList[$i] = ($fPerson);
        }  */
        return $fPerson; // $fList;
    }

    public function fPersonStrOld($num)
    {
        $fake = $this->fake;
        $fList = [];
        for ($i = 1; $i <= $num; $i++) {
            $fPerson = $fake->firstName.' '.$fake->lastName;
            $fList[$i] = ($fPerson);

            $sd = Faker\Factory::create('en_En');
            $fake->$sd->country;
        }
        return $fList;
    }

    public function age($y1, $y2)
    {
        return rand($y1, $y2);
    }
}