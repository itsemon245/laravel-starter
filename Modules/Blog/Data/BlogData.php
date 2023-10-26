<?php

namespace Modules\Blog\Models;

use Spatie\LaravelData\Data;

class BlogData extends Data
{
    public function __construct(
        public string $var,
    ) {
    }
}