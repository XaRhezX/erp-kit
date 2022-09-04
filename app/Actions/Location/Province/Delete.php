<?php

namespace App\Actions\Location\Province;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\LocationProvince;

class Delete
{
    use AsAction;

    public function handle(LocationProvince $locationProvince)
    {
        $handle = $locationProvince->delete();
        return $handle;
    }
}
