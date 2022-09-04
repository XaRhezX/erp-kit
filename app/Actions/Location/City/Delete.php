<?php

namespace App\Actions\Location\City;

use Lorisleiva\Actions\Concerns\AsAction;
use App\Models\LocationCity;

class Delete
{
    use AsAction;

    public function handle(LocationCity $locationCity)
    {
        $handle = $locationCity->delete();
        return $handle;
    }
}
