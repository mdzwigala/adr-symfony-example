<?php
declare(strict_types=1);

namespace App\Infrastructure\ParamConverter;

use App\Infrastructure\ParamConverter\InputFactory\InputFactory;
use App\Infrastructure\Validator\DataValidator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Request\ParamConverter\ParamConverterInterface;
use Symfony\Component\HttpFoundation\Request;

final class InputParamConverter implements ParamConverterInterface
{
    private DataValidator $validator;

    private InputFactory $inputFactory;

    public function __construct(DataValidator $validator)
    {
        $this->validator = $validator;
    }

    public function apply(Request $request, ParamConverter $configuration)
    {
        $input = $this->inputFactory->createFromRequest($request);

        $this->validator->validate($input);

        $request->attributes->set($configuration->getName(), $input);
    }

    public function supports(ParamConverter $configuration): bool
    {
        $inputFactoryClass = $configuration->getOptions()['inputFactory'];
        $this->inputFactory = new $inputFactoryClass;

        return $configuration->getClass() === $this->inputFactory->supportedInput();
    }
}
