<?php

namespace Src;

require 'JsonFormatter.php';

class Parser
{
    private string $path;

    private array $views;

    private array $uniqueUrls;

    private array $statusCodes;

    private array $traffics;

    private array $crawlers;


    public function __construct(string $path)
    {
        $this->path = $path;
    }


    /**
     * @throws \Exception
     */
    private function parseData(): void
    {
        $statusCode = '';
        $crawlers = '';

        $handle = @fopen($this->path, "r");
        if ($handle) {

            $this->statusCodes[] = $statusCode;
            $this->crawlers[] = $crawlers;

            while (($buffer = fgets($handle, 4096)) !== false) {
                $explode = explode('"', $buffer);
                $statusCode = substr($explode[2], 1, 3);
                $traffics = substr($explode[2], 4);
                preg_match('/\)\s\w+/', $explode[5], $crawlersArr);

                $this->views[] = $explode;
                $this->uniqueUrls[] = $explode[3];
                $this->statusCodes[$statusCode]++;
                $this->traffics[$traffics] = $traffics;
                foreach ($crawlersArr as $crawler) {
                    $this->crawlers[str_replace(') ', '', $crawler)]++;
                }
            }

            if (!feof($handle)) {
                throw new \Exception('Something went wrong while getting file');
            }
            fclose($handle);
        }
    }

    /**
     * @return string
     * @throws \Exception
     */
    public function jsonResponse(): string
    {
        $this->parseData();

        return JsonFormatter::jsonResponse(
            count($this->views),
            count(array_unique($this->uniqueUrls)),
            array_sum($this->traffics),
            $this->statusCodes,
            $this->crawlers,
        );
    }
}
