<?php
namespace Modules\Chat\Models;

use App\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;
use Modules\Core\Models\SEO;
use Modules\User\Models\User;

class Chat extends BaseModel
{

    use SoftDeletes;
    public function chatThread()
    {
        return $this->belongsTo(ChatThread::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_user_id');
    }


}
