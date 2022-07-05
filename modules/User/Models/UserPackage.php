<?php

namespace Modules\User\Models;
use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\User\Models\User;

class UserPackage extends BaseModel
{
    use SoftDeletes;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function package()
    {
        return $this->belongsTo(Package::class)->withTrashed();
    }
}
