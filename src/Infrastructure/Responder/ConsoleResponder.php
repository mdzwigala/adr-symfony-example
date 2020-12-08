<?php

namespace App\Infrastructure\Responder;

use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

interface ConsoleResponder
{
    public function __invoke(OutputInterface $output, $data): void;
}
