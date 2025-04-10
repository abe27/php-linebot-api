<?php

namespace App\Traits;

use Illuminate\Support\Str;
use Hidehalo\Nanoid\Client;

trait Nanoid
{
    protected static function boot()
    {
        // Boot other traits on the Model
        parent::boot();

        /**
         * Listen for the creating event on the user model.
         * Sets the 'id' to a UUID using Str::uuid() on the instance being created
         */
        static::creating(function ($model) {
            if ($model->getKey() === null) {
                $client = new Client();
                $model->setAttribute($model->getKeyName(), $client->generateId($size = 8));
            }
        });
    }

    // Tells the database not to auto-increment this field
    public function getIncrementing()
    {
        return false;
    }

    // Helps the application specify the field type in the database
    public function getKeyType()
    {
        return 'string';
    }
}
