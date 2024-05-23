<?php

namespace App\Providers;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class MacroServiceProvider extends ServiceProvider {
    /**
     * Register services.
     */
    public function register(): void {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void {

        /**
         * Str Macros
         */
        Str::macro('isHtml', function (string $string) {
            // Regular expression to match HTML tags
            $pattern = '/<[^<]+>/';

            // Check if the string contains any HTML tags
            if (preg_match($pattern, $string)) {
                return true; // HTML tags found
            } else {
                return false; // No HTML tags found
            }
        });

        /**
         * Generates url with current query strings appended
         *
         * @param  string  $name
         * @param  array  $params
         * @return string
         */
        Route::macro('withQuery', function (string $name, mixed $params = []): string {
            $queryStrings = '';
            $count = 0;
            if (count(request()->query()) > 0) {
                $queryStrings = '?';
                foreach (request()->query() as $key => $value) {
                    $amp = $count == 0 ? '' : '&';
                    $queryStrings = $queryStrings.$amp.$key.'='.$value;
                    $count++;
                }
            }

            return route(
                $name,
                $params
            ).$queryStrings;
        });

        /**
         * Redirects back to the provided `go_back` url if `go_back` is found in the request.\
         * Else behaves like normal `redirect()->back()`
         */
        Redirect::macro('goBack', function (): \Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Contracts\Routing\ResponseFactory {
            if (request()->ajax()) {
                request()->session()->forget('notify');
                request()->session()->forget('toast');

                return response(['success' => 'true']);
            }
            if (request()->go_back != null) {
                return Redirect::to(request()->go_back)->withInput();
            }

            return back()->withInput();
        });

        $this->bootCollectionMacros();
        $this->bootSchemaMacros();
        $this->bootCarbonMacros();
    }

    public function bootCollectionMacros() {
        /**
         * Convert values to uppercase
         */
        Collection::macro('toUpper', function () {
            /**
             * @var Collection $this
             */
            return $this->map(function ($value) {
                return is_string($value) ? Str::upper($value) : $value;
            });
        });
        /**
         * Convert values to lowercase
         */
        Collection::macro('toLower', function () {
            /**
             * @var Collection $this
             */
            return $this->map(function ($value) {
                return is_string($value) ? Str::lower($value) : $value;
            });
        });
        /**
         * Find a key
         */
        Collection::macro('find', function ($key) {
            /**
             * @var Collection $this
             */
            $filteredArray = $this->filter(function ($value, $k) use ($key) {
                return $key == $k;
            });

            return $filteredArray[$key];
        });

        /**
         * Recursive collection
         */
        Collection::macro('recursive', function () {
            /**
             * @var Collection $this
             */
            $map = $this->map(function ($value, $key) {
                if (is_array($value)) {
                    return collect($value)->recursive();
                }

                return $value;

            });

            return collect($map);
        });
    }

    public function bootSchemaMacros() {
        /**
         * Sets owner_id as foreign key referring users table
         *
         * @param  bool  $nullable  default true
         */
        Blueprint::macro('ownerId', function (bool $nullable = true) {
            /**
             * @var Blueprint $table
             */
            $table = $this;
            if ($nullable) {
                $table->unsignedBigInteger('owner_id')->nullable();
                $table->foreign('owner_id')->references('id')->on('users')->cascadeOnDelete();
            } else {
                $table->unsignedBigInteger('owner_id');
                $table->foreign('owner_id')->references('id')->on('users')->cascadeOnDelete();
            }
        });
        /**
         * Sets creator_id as foreign key referring users table
         *
         * @param  bool  $nullable  default true
         */
        Blueprint::macro('creatorId', function (bool $nullable = true) {
            /**
             * @var Blueprint $table
             */
            $table = $this;
            if ($nullable) {
                $table->unsignedBigInteger('creator_id')->nullable();
                $table->foreign('creator_id')->references('id')->on('users')->nullOnDelete();
            } else {
                $table->unsignedBigInteger('creator_id');
                $table->foreign('creator_id')->references('id')->on('users')->nullOnDelete();
            }
        });
        /**
         * Sets customer_id as foreign key referring users table
         *
         * @param  bool  $nullable  default true
         */
        Blueprint::macro('customerId', function (bool $nullable = true) {
            /**
             * @var Blueprint $table
             */
            $table = $this;
            if ($nullable) {
                $table->foreignId('customer_id')->nullable()->constrained('users')->cascadeOnDelete();
            } else {
                $table->foreignId('customer_id')->constrained('users')->cascadeOnDelete();
            }
        });
        /**
         * Sets parent_id as foreign key referring users table
         *
         * @param  bool  $nullable  default true
         */
        Blueprint::macro('parentId', function (bool $nullable = true) {
            /**
             * @var Blueprint $table
             */
            $table = $this;
            if ($nullable) {
                $table->foreignId('parent_id')->nullable()->constrained('users')->cascadeOnDelete();
            } else {
                $table->foreignId('parent_id')->constrained('users')->cascadeOnDelete();
            }
        });
    }

    public function bootCarbonMacros() {

        /**
         * Calculate the age in years or months
         */
        Carbon::macro('age', function (): string {
            /**
             * @var Carbon $carbon
             */
            $carbon = $this;
            $age = 0;
            $text = trans('years old');
            if ($carbon->greaterThan(now())) {
                return $age.' '.$text;
            }
            if ($carbon->isBetween(now()->subYear(), now())) {
                $age = round($carbon->floatDiffInMonths()).' '.trans('months old');
            } else {
                $years = round($carbon->floatDiffInYears());
                $months = $carbon->subYears($years)->format('m');
                $age = $years.' '.trans('years old');
            }

            return $age;
        });
    }
}