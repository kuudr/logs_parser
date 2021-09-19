<?php

namespace Src;

class ParserDto
{
    public int $views;

    public array $statusCodes;

    public array $urls;

    public array $traffics;


    public function __construct(
        int $views,
        array $statusCodes,
        array $urls,
        array $traffics
    )
    {
        $this->views = $views;
        $this->statusCodes = $statusCodes;
        $this->urls = $urls;
        $this->traffics = $traffics;
    }

    /**
     * @return int
     */
    public function views(): int
    {
        return $this->views;
    }

    /**
     * @return array
     */
    public function statusCodes(): array
    {
        $data = [];

        $statusCodes = $this->statusCodes;

        foreach ($statusCodes as $key => $statusCode) {
            $data[$key] = count($statusCode);
        }

        return $data;
    }

    /**
     * @return int
     */
    public function urls(): int
    {
        return count(array_unique($this->urls));
    }

    /**
     * @return int
     */
    public function traffics(): int
    {
        return array_sum($this->traffics);
    }
}
