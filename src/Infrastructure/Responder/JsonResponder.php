<?php
declare(strict_types=1);

namespace App\Infrastructure\Responder;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Serializer\SerializerInterface;

final class JsonResponder
{
    private const SUPPORTED_CONTENT_TYPE = 'json';
    private SerializerInterface $serializer;

    private RouterInterface $router;

    public function __construct(SerializerInterface $serializer, RouterInterface $router)
    {
        $this->serializer = $serializer;
        $this->router = $router;
    }

    public function __invoke(ViewEvent $viewEvent): void
    {
        if (self::SUPPORTED_CONTENT_TYPE !== $viewEvent->getRequest()->getContentType()) {
            return;
        }

        $viewEvent->setResponse(
            new JsonResponse(
                $this->serializer->serialize($viewEvent->getControllerResult(), 'json'),
                JsonResponse::HTTP_OK,
                [],
                true
            )
        );
    }
}
