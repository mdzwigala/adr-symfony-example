<?php
declare(strict_types=1);

namespace App\Infrastructure\ParamConverter\InputFactory;

use Symfony\Component\DependencyInjection\ServiceLocator;

final class ServiceLocatorInputFactoryProvider implements InputFactoryProvider
{
    public function __construct(private readonly ServiceLocator $serviceLocator)
    {
    }

    public function getFactory(string $className): InputFactory
    {
        return $this->serviceLocator->get($className);
    }
}
