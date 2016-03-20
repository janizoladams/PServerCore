<?php


namespace PServerCore\Controller;


use Zend\ServiceManager\AbstractPluginManager;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class AuthFactory implements FactoryInterface
{
    /**
     * @param ServiceLocatorInterface|AbstractPluginManager $serviceLocator
     * @return AuthController
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        /** @noinspection PhpParamsInspection */
        return new AuthController(
            $serviceLocator->getServiceLocator()->get('small_user_service'),
            $serviceLocator->getServiceLocator()->get('pserver_usercodes_service'),
            $serviceLocator->getServiceLocator()->get('pserver_add_email_service')
        );
    }

}