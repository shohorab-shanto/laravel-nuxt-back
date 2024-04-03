<?php

use App\Models\File;
use App\Models\Setting;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

if (!function_exists('message')) {
    /**
     * Message response for the API
     *
     * @param string $message Message to return
     * @param int $statusCode Response code
     * @return \Illuminate\Http\JsonResponse
     */
    function message($message = "Operation successful", $statusCode = 200, $data = [])
    {
        return response()->json(['message' => $message, 'data' => $data, 'status' => $statusCode], $statusCode);
    }
}


if (!function_exists('image')) {
    /**
     * Image URL generating
     *
     * @param mixed $file File including path
     * @param string $name Default name to create placeholder image
     * @return string URL of the file
     */
    function image($file, $name = 'Avatar')
    {
        if (Storage::exists($file))
            $url = asset('uploads/' . $file);
        else
            $url = 'https://i2.wp.com/ui-avatars.com/api/' . Str::slug($name) . '/400';

        return $url;
    }
}

if (!function_exists('user')) {

    /**
     * Get the authenticated user instance
     *
     * @return \Illuminate\Contracts\Auth\Authenticatable|null
     */
    function user()
    {
        return auth()->user();
    }
}
