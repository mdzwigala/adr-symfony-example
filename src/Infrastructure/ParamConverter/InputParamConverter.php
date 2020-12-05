<?php
declare(strict_types=1);

namespace App\Infrastructure\ParamConverter;

use App\Infrastructure\ParamConverter\InputFactory\InputFactory;
use App\Infrastructure\ParamConverter\InputFactory\InputFactoryProvider;
use App\Infrastructure\Validator\DataValidator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;
use Symfony\Component\HttpFoundation\Request;

final class InputParamConverter implements ParamConverterInterface
{
    private DataValidator $validator;

    private InputFactory $inputFactory;

    private InputFactoryProvider $inputFactoryProvider;

    public function __construct(DataValidator $validator, InputFactoryProvider $inputFactoryProvider)
    {
        $this->validator = $validator;
        $this->inputFactoryProvider = $inputFactoryProvider;
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $input = $this->inputFactory->createFromRequest($request);

        $this->validator->validate($input);

        $request->attributes->set($configuration->getName(), $input);
    }

    public function supports(ParamConverter $configuration): bool
    {
        try {
            $this->inputFactory = $this->inputFactoryProvider->getFactory($configuration->getClass());
        } catch (ServiceNotFoundException $e) {
            return false;
        }

        return true;
    }
}
