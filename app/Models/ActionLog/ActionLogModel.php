<?php

namespace App\Models\ActionLog;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Models\BaseModel;
use App\Models\Merchant\Merchant;

class ActionLogModel extends Model
{
    protected $table = 'a_action_log';//微擎的表

    protected $guarded = [];


    

}
