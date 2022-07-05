<?php
namespace Modules\User\Models;
use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use App;

class Package extends BaseModel
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'duration',
        'status',
        'amount',
        'commission',
        'item_upload_limit'
    ];
    
    public function scopeFreelancer($query)
    {
        return $query->where('type', 'freelancer');
    }

    public function scopeClient($query)
    {
        return $query->where('type', 'client');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public function package_payments(){
        return $this->hasMany(PackagePayment::class);
    }
    public function getTranslation($field = '', $lang = false){
		$lang = $lang == false ? App::getLocale() : $lang;
		$seller_package_translation = $this->hasMany(PackageTranslation::class)->where('locale', $lang)->first();
		return $seller_package_translation != null ? $seller_package_translation->$field : $this->$field;
	}
}
