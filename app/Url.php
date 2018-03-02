<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Url extends Model
{
	protected $fillable = ['url', 'key', 'created_at'];
	public $timestamps = false;
}
