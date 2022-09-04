<?php

namespace App\Actions\Location\Country;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\LocationCountry;

class Update
{
    use AsAction;

    public function handle(LocationCountry $locationCountry, Array $request)
    {
        $handle = $locationCountry->update($request);
        return $handle;
    }
}
