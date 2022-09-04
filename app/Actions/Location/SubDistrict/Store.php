<?php

namespace App\Actions\Location\SubDistrict;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\LocationSubDistrict;

class Store
{
    use AsAction;

    public function handle(Array $request)
    {
        $handle = LocationSubDistrict::create($request);
        return $handle;
    }
}
