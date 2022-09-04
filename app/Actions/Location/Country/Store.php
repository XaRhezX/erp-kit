<?php

namespace App\Actions\Location\Country;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\LocationCountry;

class Store
{
    use AsAction;

    public function handle(Array $request)
    {
        $handle = LocationCountry::create($request);
        return $handle;
    }
}
