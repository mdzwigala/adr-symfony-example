<?php
declare(strict_types=1);

namespace App\Infrastructure\Responder;

use Symfony\Component\Console\Helper\Table;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

final class TableConsoleResponder implements ConsoleResponder
{
    public function __construct(private readonly NormalizerInterface $normalizer)
    {
    }
    public function __invoke(OutputInterface $output, $data): void
    {
        $dataAsArray = $this->normalizer->normalize($data, 'array');
        $this->writeToOutput($dataAsArray, $output);
    }

    private function writeToOutput(array $data, OutputInterface $output): void
    {
        $table = new Table($output);
        $table->setHeaders(array_keys($data));
        $table->addRow(array_values($data));
        $table->render();
    }
}
