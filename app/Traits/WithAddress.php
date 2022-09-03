<?php

namespace App\Traits;

use App\Models\Address;

trait WithAddress
{
    public function address()
    {
        return $this->morphOne(Address::class, 'addressable')->orderBy('updated_at', 'desc');
    }

    public function getAddressDetailAttribute()
    {
        return $this->address ? $this->address->address : null;
    }

    public function getAddressZoneAttribute()
    {
        return $this->address && $this->address->zipcode ? $this->address->zipcode->name : null;
    }
}
