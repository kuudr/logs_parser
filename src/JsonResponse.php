<?php

namespace Src;

class JsonResponse
{
    /**
     * @param int $views
     * @param int $urls
     * @param int $traffics
     * @param array $statusCodes
     * @return string
     */
    public static function jsonResponse(
        int $views,
        int $urls,
        int $traffics,
        array $statusCodes
    ): string
    {
        $data =  [
            'views' => $views,
            'urls' => $urls,
            'traffics' => $traffics,
            'status_codes' => $statusCodes
        ];

        return json_encode($data);
    }
}
