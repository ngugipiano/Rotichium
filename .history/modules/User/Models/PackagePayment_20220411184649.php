<?php

namespace Modules\User\Models;
use Modules\User\Models\User;
use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class PackagePayment extends BaseModel
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

    public function scopeFreelancer($query)
    {
        return $query->where('package_type', 'freelancer');
    }

    public function scopeClient($query)
    {
        return $query->where('package_type', 'client');
    }
}
