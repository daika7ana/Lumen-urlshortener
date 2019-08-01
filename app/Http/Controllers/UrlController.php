<?php

namespace App\Http\Controllers;

use App\Url as URL;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class UrlController extends Controller
{
    // Redirect the user to his Original URL from the provided ShortURL
    public function redirect_url(String $key): RedirectResponse
    {
        $original_url = URL::fetch_url($key);

        $original_url = $original_url && !parse_url($original_url, PHP_URL_SCHEME) ? "http://{$original_url}" : $original_url;

        return $original_url ? redirect($original_url) : abort(404, 'Invalid URL');
    }

    // Verify if the URL is already in the DB
    // If it is, return the ShortURL and Associated key
    // If not, create and return a new ShortURL
    // API and Frontend Usage
    public function create_url(Request $request): array
    {
        // Original URL provided by the user
        $original_url = $request->url;
        $parsed_url = parse_url($original_url);

        // Verify if URL respects the URL Standards
        if (false === $parsed_url)
            return ['error_msg' => 'The provided URL is invalid.'];

        if ($request->server("SERVER_NAME") === $parsed_url['host'])
            return ['error_msg' => 'This URL is already shortened.'];

        if ($existing_key = URL::fetch_key($original_url))
            return [
                'url' => url($existing_key),
                'key' => $existing_key
            ];

        // Generate a unique key for the URL
        $key = URL::generate_unique_key();

        URL::create([
            'url'          => $original_url,
            'key'          => $key,
            'created_at'   => Carbon::now()
        ]);

        return [
            'url' => url($key),
            'key' => $key
        ];
    }

    // Return the Original URL from the provided ShortURL
    // API Usage
    public function expand_url(Request $request)
    {
        $short_url = $request->url;
        $domain = $request->server("SERVER_NAME");

        if (!stripos($short_url, $domain))
            return ['error_msg' => 'The provided URL does not belong to this domain.'];

        $key = $this->grab_url_key($short_url, $domain);

        if ($original_url = URL::fetch_url($key)) {
            return [
                'url' => $original_url,
                'key' => $key
            ];
        } else {
            return ['error_msg' => 'The provided key was not found.'];
        }
    }

    // Strip the domain from the provided Short URL
    // to only obtain the key
    // Includes a fallback method
    private function grab_url_key($url, $domain): ?string
    {
        $url_path = parse_url($url, PHP_URL_PATH);
        $key = $url_path ? substr($url_path, 1) : null;

        // Fallback
        if (!$key) {
            $current_url = "{$domain}/";
            $exploded_url = explode($current_url, $url);
            $key = $exploded_url[1] ?? null;
        }

        return $key;
    }
}
