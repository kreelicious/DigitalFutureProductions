<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class Sanity
{
    public function query(string $groq, array $params = [], int $cacheSeconds = 60): array
    {
        $projectId = config('sanity.project_id');
        $dataset = config('sanity.dataset');
        $apiVersion = config('sanity.api_version');
        $token = config('sanity.token');

        if (!$projectId || !$dataset || !$apiVersion) {
            throw new \RuntimeException('Missing Sanity config. Check SANITY_PROJECT_ID / SANITY_DATASET / SANITY_API_VERSION in .env');
        }

        $url = "https://{$projectId}.api.sanity.io/v{$apiVersion}/data/query/{$dataset}";

        // Cache key that varies by query+params
        $cacheKey = 'sanity:' . md5($groq . '|' . json_encode($params));

        return Cache::remember($cacheKey, $cacheSeconds, function () use ($url, $groq, $params, $token) {
            $sanityParams = [];
            foreach ($params as $key => $value) {
                $paramKey = str_starts_with($key, '$') ? $key : '$'.$key;
                $sanityParams[$paramKey] = json_encode($value, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
            }

            $queryParams = array_merge(['query' => $groq], $sanityParams);

            $req = Http::acceptJson();

            // Only needed for drafts/private datasets
            if ($token) {
                $req = $req->withToken($token);
            }

            $res = $req->get($url, $queryParams);

            if (!$res->successful()) {
                throw new \RuntimeException('Sanity query failed: ' . $res->status() . ' ' . $res->body());
            }

            return $res->json();
        });
    }
}
