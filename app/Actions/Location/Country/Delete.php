<?php

namespace App\Actions\Location\Country;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\LocationCountry;

class Delete
{
    use AsAction;

    public function handle(LocationCountry $locationCountry)
    {
        $handle = $locationCountry->delete();
        return $handle;
    }
}
