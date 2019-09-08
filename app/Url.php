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

    // URL fetch by key
    public static function fetch_by_key($key): ?self
    {
        return self::where('key', $key)->first();
    }

    // URL fetch by long URL
    public static function fetch_by_url($url): ?self
    {
        return self::where('url', $url)->first();
    }

    // Generate a new unique Key
    public static function generate_unique_key($length = 6): string
    {
        $key = str_random($length);

        return URL::where('key', $key)->count() ?
            self::generate_unique_key() : $key;
    }
}
