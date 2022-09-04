<?php

namespace App\Actions\Location;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\Location;

class Update
{
    use AsAction;

    public function handle(Location $location, Array $request)
    {
        $handle = $location->update($request);
        return $handle;
    }
}
