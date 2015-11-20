<?php

namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;

class TeamControllerTest extends\PHPUnit_Framework_TestCase
{
    public function testteamShowAction()
    {
        $strResp = new TeamController();
        $request = new Request();
        $strResp->teamShowAction('Ukraine', $request);

        $this->assertContains('body', $strResp);
    }
/*
    public function testUpdate()
    {
        $stub = $this->getMockBuilder('Models\Word\EngWord')
            ->disableOriginalConstructor()
            ->getMock();

        $str = array('eng_word'=>'sub', 'id_en'=>3);
        $stub->method('update')->willReturn($str);

        $this->assertArrayHasKey('id_en',$stub->update('name'));
    }

    public function testEngWordHasAttr()
    {
        $this->assertClassHasAttribute('connector','Models\Word\EngWord');
    }

    public function testFindName()
    {
        $stub = $this->getMockBuilder('Models\Word\EngWord')
            ->disableOriginalConstructor()
            ->getMock();

        $subArr = [
            0=> [0, 'id_en', '5']
        ];
        $stub->method('findName')->willReturn($subArr);

        $this->assertArraySubset([0=>[0, 'id_en', '5']], $stub->findName('query'));

    }

    /**
     * @param $arr
     * @dataProvider removeProvider
     */
  /*  public function testRemove($exp, $arr)
    {
        $stub = $this->getMockBuilder('Models\Word\EngWord')
            ->disableOriginalConstructor()
            ->getMock();

        var_dump($arr);
        $stub->method('remove')->willReturn($arr);

        $this->assertCount($exp, $stub->remove($arr));
    }

    public function removeProvider()
    {
        return [
            [1, array('arbitrary')],
        ];
    }
  */
}