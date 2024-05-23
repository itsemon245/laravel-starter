<?php

use App\Helpers\Sidebar;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use App\Services\Notify\Notify;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Redirect;

function sidebar(): array {
    return Sidebar::items();
}

function isHtml($string): bool {
    return Str::isHtml($string);
}
/**
 * Deletes a given value from array
 */
function array_remove(array &$array, mixed $value): array {
    if (($key = array_search($value, $array)) !== false) {
        unset($array[$key]);
    }

    return $array;
}

/**
 * Scans all files in a given directory except the exception
 *
 * @param  string  $dir
 * @param  string  $exception
 */
function scandir_except($dir, $exception): array {
    $files = scandir($dir);
    $currentFile = basename($exception);

    $files = array_remove($files, '.');
    $files = array_remove($files, '..');
    $files = array_remove($files, $currentFile);

    return $files;
}
/**
 * Extracts a regex pattern from a string and returns the match and the remaining string
 *
 * @return array<string, string> ` [
        'match' => $matched,
        'remains' => $remains
    ]`
 */
function preg_extract(string $pattern, string $string): array {
    preg_match_all($pattern, $string, $matches);
    $mb_classes = $matches[0];
    $matched = Arr::join($mb_classes, ' ');
    $position = strpos($string, $matched);
    //Replace the matched string with empty string
    $remains = substr_replace($string, '', $position, strlen($matched));

    return [
        'match' => $matched,
        'remains' => $remains,
    ];
}

/**
 * Set env variables
 *
 * @param  array<string,string>  $values
 * @return void
 */
function setEnv($values) {
    $envFile = base_path('.env');
    foreach ($values as $key => $value) {
        $envContent = File::get($envFile);
        $pattern = "/^({$key}=)(.*)$/m";
        $updatedEnvContent = preg_replace($pattern, "$1\"{$value}\"", $envContent);
        File::put($envFile, $updatedEnvContent);
    }
    Artisan::call('config:clear');

}

/**
 * Alerts the user with a popup
 *
 * @return void|mixed|App\Services\Notify\Notify
 */
function notify(
    ?string $message = null,
    string $type = 'success',
    ?string $title = null,
    string $confirmText = 'Ok'
) {
    $notify = new Notify();

    return $notify->notify(
        $message,
        $type,
        $title,
        $confirmText,
    );
}

/**
 * Alerts the user with a toast message
 *
 * @return void|mixed|App\Services\Notify\Notify
 */
function toast(
    ?string $message = null,
    string $type = 'success',
    ?string $title = null,
    string $confirmText = 'Ok'
) {
    $notify = new Notify('toast');

    return $notify->notify(
        $message,
        $type,
        $title,
        $confirmText,
    );
}

/**
 * Generates url with current query strings appended
 *
 * @param  mixed  $params
 * @return string
 */
function routeWithQuery(string $name, $params = []) {
    return Route::withQuery($name, $params);
}

/**
 * Redirects back to the provided `go_back` url if `go_back` is found in the request.\
 * Else behaves like normal `redirect()->back()`
 *
 * @return \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory
 */
function goBack() {
    return Redirect::goBack();
}

function tab() {
    return request()->query('tab');
}