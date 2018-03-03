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
        // Original URL provided by the user
        $original_user_url = $request->url;

        // Sanitize URL and verify if it respects the URL Standards
        $sanitized_url = filter_var($original_user_url, FILTER_SANITIZE_URL);
        if(filter_var($sanitized_url, FILTER_VALIDATE_URL) === false)
            return json_encode('Invalid URL');

        $existing_key = $this->check_url_exists($sanitized_url);
        if($existing_key) 
            return url($existing_key);

        // Generate a unique key for the URL
        $key = $this->generate_unique_key();
        Url::create([ 'url'          => $sanitized_url,
                      'key'          => $key,
                      'created_at'   => Carbon::now() ]);

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
        $seed = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz';
        $key = substr(str_shuffle($seed), -6);

        if(Url::where('key', $key)->count()) 
            $this->generate_unique_key();

        return $key;
    }
}
