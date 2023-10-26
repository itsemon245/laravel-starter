<?php

namespace Modules\Blog\Models;

class BlogDto {

   /**
     * Create a new BlogDto instance.
     */
    public function __construct(
        public readonly string $foo
    )
    {
    }

}