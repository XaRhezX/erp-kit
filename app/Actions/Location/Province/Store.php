<?php

namespace App\Actions\Location\Province;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\LocationProvince;

class Store
{
    use AsAction;

    public function handle(Array $request)
    {
        $handle = LocationProvince::create($request);
        return $handle;
    }
}
