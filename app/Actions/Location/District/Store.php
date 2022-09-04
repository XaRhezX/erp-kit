<?php

namespace App\Actions\Location\District;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\LocationDistrict;

class Store
{
    use AsAction;

    public function handle(Array $request)
    {
        $handle = LocationDistrict::create($request);
        return $handle;
    }
}
