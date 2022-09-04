<?php

namespace App\Actions\Location\District;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\LocationDistrict;

class Update
{
    use AsAction;

    public function handle(LocationDistrict $locationDistrict, Array $request)
    {
        $handle = $locationDistrict->update($request);
        return $handle;
    }
}
