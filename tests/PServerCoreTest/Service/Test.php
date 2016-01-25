<?php


namespace PServerCoreTest\Service;


use PServerCoreTest\Util\TestBase;

class Test extends TestBase
{
    /** @var  string */
    protected $className = '\PServerCore\Service\Format';

    public function testGetCode()
    {
        /** @var \PServerCore\Service\Format $class */
        $class = $this->getClass();

        $result = $class->getCode(32);
        $this->assertInternalType('string', $result);
        $this->assertEquals(32, strlen($result));
    }


}