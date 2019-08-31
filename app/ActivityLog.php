<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
	public $timestamps = false;

	protected $fillable = ['url_id', 'method', 'response', 'ip_address', 'created_at'];
    protected $dates = ['created_at'];

    // Return URL object
    public function url()
    {
        return $this->belongsTo(Url::class);
    }

    // Search though response json column
    public static function search_response($index, $value)
    {
        return self::where('response->'.$index, $value)->get();
    }
}
