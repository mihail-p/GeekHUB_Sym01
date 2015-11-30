<?php

namespace AppBundle\Model;

use Faker;
class Team
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

    public function fPersonStr($num)
    {
        $fake = $this->fake;
        $fList = [];
        for ($i = 1; $i <= $num; $i++) {
            $fPerson = $fake->firstName.' '.$fake->lastName;
            $fList[$i] = ($fPerson);
        }
        return $fList;
    }

    public function age()
    {
        return rand(19,35);
    }
}