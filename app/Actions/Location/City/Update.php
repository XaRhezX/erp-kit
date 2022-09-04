<?php

namespace App\Actions\Location\City;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\LocationCity;

class Update
{
    use AsAction;

    public function handle(LocationCity $locationCity, Array $request)
    {
        $handle = $locationCity->update($request);
        return $handle;
    }
}
