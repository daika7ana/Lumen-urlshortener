<?php

namespace App\Http\Controllers;

use App\Url;
use Illuminate\Http\Request;
use Carbon\Carbon;

class UrlController extends Controller
{
    // Self Explanatory
    public function index($key = null)
    {
        $decoded = $this->decode_key($key);
        strpos($decoded, 'http') > -1 ? $decoded : ($decoded = 'http://'.$decoded);

        return $decoded ? redirect($decoded) : json_encode('Invalid URL');
    }

    // Verify if the URL is already in the DB
    // If it is, return the ShortURL
    // If not, create and return a new ShortURL
    public function create_url(Request $request) 
    {
        
        $verify_url = $this->check_url_exists($request->url);
        if($verify_url) return url($verify_url);

        $key = $this->generate_unique_key();
        Url::create(['url' => $request->url,
                     'key' => $key,
                     'created_at' => Carbon::now() ]);

        return url($key);
    }

    // Check for the key, return original URL
    private function decode_key($key)
    {
        $found_key = Url::where('key', $key)->first();

        return $found_key ? $found_key->url : false;
    }

    // Lookup the URL provided, return the key if found else bool(false)
    private function check_url_exists($url) 
    {
        $existing_url = Url::where('url', $url)->first();

        return $existing_url ? $existing_url->key : false;
    }

    // Generate a new unique Key
    private function generate_unique_key()
    {
        $length = 6;
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $key = substr(str_shuffle($characters), -6);

        if(Url::where('key', $key)->count()) $this->generate_unique_key();

        return $key;
    }
}
