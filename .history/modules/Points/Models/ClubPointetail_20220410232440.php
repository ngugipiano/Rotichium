<?php
namespace Modules\Points\Models;

use App\BaseModel;
use Modules\Space\Models\Space;

class ClubPointDetail extends BaseModel
{
    public function space()
    {
        return $this->belongsTo(Space::class);
    }

    public function club_point()
    {
        return $this->belongsTo(ClubPoint::class);
    }
}
