<?php

namespace App\Actions\Location\City;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\LocationCity;

class Store
{
    use AsAction;

    public function handle(Array $request)
    {
        $handle = LocationCity::create($request);
        return $handle;
    }
}
