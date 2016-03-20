<?php


namespace PServerCoreTest\Form;


use PServerCore\Options\CollectionFactory;
use PServerCoreTest\Util\TestBase;

class RegisterFilterTest extends TestBase
{
    /** @var string */
    protected $className = '\PServerCore\Form\RegisterFilter';

    public function testIsValid()
    {
        $this->mockedMethodList = [
            'getUsernameValidator',
            'getUserNameBackendNotExistsValidator'
        ];

        $noRecordExistsMock = $this->getMockBuilder('PServerCore\Validator\NoRecordExists')
            ->disableOriginalConstructor()
            ->setMethods(['isValid'])
            ->getMock();

        $noRecordExistsMock->expects($this->any())
            ->method('isValid')
            ->willReturn(true);

        $UserNameBackendNotExistsMock = $this->getMockBuilder('PServerCore\Validator\UserNameBackendNotExists')
            ->disableOriginalConstructor()
            ->setMethods(['isValid'])
            ->getMock();

        $UserNameBackendNotExistsMock->expects($this->any())
            ->method('isValid')
            ->willReturn(true);

        $class = $this->getClass();

        $class->expects($this->any())
            ->method('getUsernameValidator')
            ->willReturn($noRecordExistsMock);

        $class->expects($this->any())
            ->method('getUserNameBackendNotExistsValidator')
            ->willReturn($UserNameBackendNotExistsMock);

        $class->setData([
            'username' => 'fo dfgo',
            'email' => 'fodfgo@example.com',
            'emailVerify' => 'fodfgo@example.com',
            'password' => 'fodfgo',
            'passwordVerify' => 'fodfgo',
        ]);

        $this->assertFalse($class->isValid());
    }


}
