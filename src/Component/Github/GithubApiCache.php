<?php

namespace Drupal\aa\Component\Github;

class GithubApiCache
{
    const CACHE_FILE = '/tmp/aa_drupal_wunder.github_api_cache';

    private static $cache = [];

    public static function set($key, $value)
    {
        static::$cache[$key] = $value;
        self::save();
    }

    public static function get($key)
    {
        if(empty(static::$cache)) {
            self::retrieve();
        }

        if(!array_key_exists($key, static::$cache)) {
            return null;
        }

        return static::$cache[$key];
    }

    public static function clear($key)
    {
        if(array_key_exists($key, static::$cache)) {
            unset(static::$cache[$key]);
            self::save();
        }
    }

    private static function save()
    {
        file_put_contents(self::CACHE_FILE, serialize(static::$cache));
    }

    private function retrieve()
    {
        if(file_exists(self::CACHE_FILE)) {
            static::$cache = unserialize(file_get_contents(self::CACHE_FILE));
        }
    }
}
