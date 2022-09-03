<?php

namespace App\Traits;

use Spatie\Activitylog\Contracts\Activity as ContractsActivity;

trait TapActivity
{
    public function tapActivity(ContractsActivity $activity, string $eventName)
    {
        switch ($eventName) {
            case 'created':
                $activity->description = "Melakukan Input Data ".$activity->subject_name." Baru";
                break;
            case 'updated':
                $activity->description = "Mengubah Data ".$activity->subject_name;
                break;
            case 'deleted':
                $activity->description = "Melakukan Hapus Data ".$activity->subject_name;
                break;

            default:
                $activity->description = null;
                break;
        }
    }
}
