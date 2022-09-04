<?php

namespace App\Actions\Location\SubDistrict;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\LocationSubDistrict;

class Update
{
    use AsAction;

    public function handle(LocationSubDistrict $locationSubDistrict, Array $request)
    {
        $handle = $locationSubDistrict->update($request);
        return $handle;
    }
}
