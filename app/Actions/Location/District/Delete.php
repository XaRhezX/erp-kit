<?php

namespace App\Actions\Location\District;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\LocationDistrict;

class Delete
{
    use AsAction;

    public function handle(LocationDistrict $locationDistrict)
    {
        $handle = $locationDistrict->delete();
        return $handle;
    }
}
