<?php

namespace Src;

class JsonFormatter
{
    /**
     * @param int $views
     * @param int $urls
     * @param int $traffics
     * @param array $statusCodes
     * @param array $crawlers
     * @return string
     */
    public static function jsonResponse(
        int $views,
        int $urls,
        int $traffics,
        array $statusCodes,
        array $crawlers
    ): string
    {
        $data =  [
            'views' => $views,
            'urls' => $urls,
            'traffics' => $traffics,
            'status_codes' => $statusCodes,
            'crawlers' => $crawlers,
        ];

        return json_encode($data);
    }
}
