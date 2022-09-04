<?php

namespace App\Actions\Location\SubDistrict;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\LocationSubDistrict;

class Delete
{
    use AsAction;

    public function handle(LocationSubDistrict $locationSubDistrict)
    {
        $handle = $locationSubDistrict->delete();
        return $handle;
    }
}
