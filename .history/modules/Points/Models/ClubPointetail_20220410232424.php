<?php
namespace Modules\Points\Models;

use App\BaseModel;
// use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Space\Models\Space;
use Modules\User\Models\User;

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
