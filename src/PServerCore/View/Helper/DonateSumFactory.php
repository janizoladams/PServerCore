<?php


namespace PServerCore\View\Helper;


use Interop\Container\ContainerInterface;
use PServerCore\Service\Donate;
use Zend\ServiceManager\Factory\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorAwareInterface;

class DonateSumFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return DonateSum
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new DonateSum(
            $container->get(Donate::class)
        );
    }

}