<?php declare(strict_types=1);

namespace ArticlesApp;

use Carbon\Carbon;

class Cache
{
    public static function save(string $key, string $data, int $ttl = 300): void
    {
        $cacheFile = '../cache/' . $key;

        file_put_contents($cacheFile, json_encode([
            'expires_at' => Carbon::now()->addSeconds($ttl),
            'content' => $data
        ]));
    }

    public static function delete(string $key): void
    {
        unlink('../cache/' . $key);
    }

    public static function get(string $key): ?string
    {
        if (!self::has($key)) {
            return null;
        }

        $content = json_decode(file_get_contents('../cache/' . $key));

        return $content->content;
    }

    public static function has(string $key): bool
    {
        if (!file_exists('../cache/' . $key)) {
            return false;
        }

        $content = json_decode(file_get_contents('../cache/' . $key));

        return (new Carbon($content->expires_at))->greaterThan(Carbon::now());
    }
}