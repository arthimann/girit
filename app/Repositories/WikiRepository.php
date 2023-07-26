<?php

namespace App\Repositories;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Config;

class WikiRepository implements WikiRepositoryInterface
{
    /**
     * Get on this day, today data from WIKI
     * @return array
     */
    public function getToday(): array
    {
        $todayDate = Carbon::now();
        $response = Http::get($this->genApiUrl($todayDate->format('m'), $todayDate->format('d')));

        if ($response->failed()) {
            abort($response->status(), $response->json(self::ERR_RESPONSE_KEY));
        }

        $result = [];
        foreach ($response->json(self::RESPONSE_KEY) as $datum) {
            $result[] = [
                'title' => $datum['pages'][0]['titles']['normalized'] ?? 'Title',
                'description' => $datum['text'],
                'thumbnail' => $datum['pages'][0]['thumbnail']['source'] ?? $this->getPlaceholderPicture(),
                'year' => $datum['year'],
                'url' => $datum['pages'][0]['content_urls']['desktop']['page'] ?? '',
            ];
        }

        return $result;
    }

    /**
     * Placeholder picture
     * @return string
     */
    private function getPlaceholderPicture(): string
    {
        $response = Http::get(Config::get('wiki.lorem_picsum'));

        if ($response->failed()) {
            return '';
        }
        $body = $response->effectiveUri();
        return $body->getScheme() . '://' . $body->getHost() . $body->getPath() . '?' . $body->getQuery();
    }

    /**
     * Generate title url
     * @return string
     */
    public function genTitleUrl(): string
    {
        $todayDate = Carbon::now();
        $month = $todayDate->format('M');
        $day = $todayDate->format('d');
        $baseUrl = Config::get('wiki.base_title_url');
        return "{$baseUrl}/{$month}_{$day}";
    }

    /**
     * Generate API URL using params
     * @param string $day
     * @param string $month
     * @return string
     */
    private function genApiUrl(string $day, string $month): string
    {
        $baseUrl = Config::get('wiki.base_url');
        return "{$baseUrl}/$day/$month";
    }
}
