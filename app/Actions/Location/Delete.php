<?php

namespace App\Actions\Location;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\Location;

class Delete
{
    use AsAction;

    public function handle(Location $location)
    {
        $handle = $location->delete();
        return $handle;
    }
}
