<?php

namespace Src;

require '../vendor/autoload.php';

class Parser
{
    private const LOGS_FILE = '../logs/logs';

    private array $parsedData = [];

    /**
     * @return array
     * @throws \Exception
     */
    private function getLogs(): array
    {
        $lines = [];

        $logsFile = file(self::LOGS_FILE);

        if (!$logsFile) {
            throw new \Exception('Something went wrong while getting file');
        }

        foreach ($logsFile as $parts) {
            $lines[] = explode('"', $parts);
        }

        return $lines;
    }


    /**
     * @return array
     * @throws \Exception
     */
    public function parseData(): array
    {
        $data = [];
        foreach ($this->getLogs() as $log) {
            $data['urls'][] = $log[3];
            $data['views'] = count($this->getLogs());
            $data['traffics'][] = substr($log[2], 4);
            $statusCode = substr($log[2], 1, 3);
            $data['status_codes'][$statusCode][] = $statusCode;
        }

        return $this->parsedData = $data;

    }

    /**
     * @return ParserDto
     */
    public function dto(): ParserDto
    {
        return new ParserDto(
            $this->parsedData['views'],
            $this->parsedData['status_codes'],
            $this->parsedData['urls'],
            $this->parsedData['traffics'],
        );
    }
}

$parser = new Parser();
$parser->parseData();

echo JsonFormatter::jsonResponse(
    $parser->dto()->views(),
    $parser->dto()->urls(),
    $parser->dto()->traffics(),
    $parser->dto()->statusCodes(),

);

