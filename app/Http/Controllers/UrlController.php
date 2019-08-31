<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Url as URL;
use App\ActivityLog;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class UrlController extends Controller
{
    // Redirect the user to his Original URL from the provided ShortURL
    public function redirect_url(String $key, Request $request): RedirectResponse
    {
        $url_object = URL::fetch_by_key($key);

        $original_url = optional($url_object)->url;
        $original_url = $original_url && !parse_url($original_url, PHP_URL_SCHEME) ? "https://{$original_url}" : $original_url;

        if ($original_url) {
            $response = array(
                'original_url' => $original_url,
                'short_url' => url($key),
                'key' => $key
            );
        } else {
            $response = array('error_msg' => 'The provided URL is invalid.');
        }

        return $this->handle_response(__FUNCTION__, $response, $url_object, $request);
    }

    // Verify if the URL is already in the DB
    // If it is, return the ShortURL and Associated key
    // If not, create and return a new ShortURL
    // API and Frontend Usage
    public function create_url(Request $request): Array
    {
        // Original URL provided by the user
        $original_url = $request->url;
        $parsed_url = parse_url($original_url);

        // Verify if URL respects the URL Standards
        if (false === $parsed_url || !array_key_exists('host', $parsed_url))
            return $this->handle_response(__FUNCTION__, array('error_msg' => 'The provided URL is invalid.'), null, $request);

        if ($request->server("SERVER_NAME") === $parsed_url['host'])
            return $this->handle_response(__FUNCTION__, array('error_msg' => 'This URL is already shortened.'), null, $request);

        if (($url_object = URL::fetch_by_url($original_url)) && ($existing_key = $url_object->key))
            return $this->handle_response(__FUNCTION__, array(
                'original_url' => $original_url,
                'short_url' => url($existing_key),
                'key' => $existing_key
            ), $url_object, $request);

        // Generate a unique key for the URL
        $new_key = URL::generate_unique_key();
        $url_object = URL::create([
            'url'          => $original_url,
            'key'          => $new_key,
            'created_at'   => Carbon::now()
        ]);

        return $this->handle_response(__FUNCTION__, array(
            'original_url' => $original_url,
            'short_url' => url($new_key),
            'key' => $new_key
        ), $url_object, $request);
    }

    // Return the Original URL from the provided ShortURL
    // API Usage
    public function expand_url(Request $request): Array
    {
        $short_url = !parse_url($request->url, PHP_URL_SCHEME) ? "https://$request->url" : $request->url;
        $domain = $request->getHost();

        if (false === stripos($short_url, $domain))
            return $this->handle_response(__FUNCTION__, array('error_msg' => 'The provided URL does not belong to this domain.'), null, $request);

        $key = $this->grab_url_key($short_url, $domain);

        if (($url_object = URL::fetch_by_key($key)) && ($original_url = $url_object->url)) {
            return $this->handle_response(__FUNCTION__, array(
                'original_url' => $original_url,
                'short_url' => url($short_url),
                'key' => $key
            ), $url_object, $request);
        } else {
            return $this->handle_response(__FUNCTION__, array('error_msg' => 'The provided key was not found.'), null, $request);
        }
    }

    // Log the response
    // Handles the returns for entrypoint
    private function handle_response(String $function_name, array $response, ?URL $url_object, Request $request)
    {
        // Log the response
        ActivityLog::create([
            'url_id' => optional($url_object)->id,
            'method' => $function_name,
            'response' => json_encode($response),
            'ip_address' => $request->ip(),
            'created_at' => Carbon::now()
        ]);

        // Handle returns
        switch ($function_name) {
            case 'redirect_url':
                return array_key_exists('original_url', $response) ? redirect($response['original_url']) : abort(404, $response['error_msg']);

            case 'create_url':
            case 'expand_url':
                return $response;

            default:
                throw new \Exception('Unhandled function in ' . __METHOD__);
        }
    }

    // Helper fn
    // Strip the domain from the provided Short URL
    // to only obtain the key
    // Includes a fallback method
    private function grab_url_key($url, $domain): ?string
    {
        $url_path = parse_url($url, PHP_URL_PATH);
        $key = $url_path ? substr($url_path, 1) : null;

        // Fallback
        if (!$key || false !== strpos($key, '/')) {
            $current_url = "{$domain}/";
            $exploded_url = explode($current_url, $url);
            $key = $exploded_url[1] ?? null;
        }

        return $key;
    }
}
