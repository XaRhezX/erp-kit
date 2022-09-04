<?php

namespace App\Actions\Location;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\Location;

class Store
{
    use AsAction;

    public function handle(Array $request)
    {
        $handle = Location::create($request);
        return $handle;
    }
}
