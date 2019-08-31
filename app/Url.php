<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
	public $timestamps = false;

	protected $fillable = ['url', 'key', 'created_at'];
    protected $dates = ['created_at'];

    // Return logs for the selected URL
    public function activity_log()
    {
        return $this->hasMany(ActivityLog::class);
    }

	// Check for the key, return original URL or null
    public static function fetch_by_key($key): ?self
    {
        return self::where('key', $key)->first();
    }

    // Lookup the URL provided, return the key or null
    public static function fetch_by_url($url): ?self
    {
        return self::where('url', $url)->first();
    }

    // Generate a new unique Key
    public static function generate_unique_key($length = 6): string
    {
        $key = str_random($length);

        return URL::where('key', $key)->count() ?
            $this->generate_unique_key() : $key;
    }
}
