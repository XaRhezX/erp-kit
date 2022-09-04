<?php

namespace App\Actions\Location\Province;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\LocationProvince;

class Update
{
    use AsAction;

    public function handle(LocationProvince $locationProvince, Array $request)
    {
        $handle = $locationProvince->update($request);
        return $handle;
    }
}
