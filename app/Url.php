<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
	public $timestamps = false;

	protected $fillable = ['url', 'key', 'created_at'];

	// Check for the key, return original URL or null
    public static function fetch_url($key): ?string
    {
        return optional(self::where('key', $key)->first())->url;
    }

    // Lookup the URL provided, return the key or null
    public static function fetch_key($url): ?string
    {
        return optional(self::where('url', $url)->first())->key;
    }

    // Generate a new unique Key
    public static function generate_unique_key($length = 6): string
    {
        $key = str_random($length);

        return URL::where('key', $key)->count() ?
            $this->generate_unique_key() : $key;
    }
}
