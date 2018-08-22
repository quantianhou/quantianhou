<?php

namespace App\Models\CheckLog;

use App\Models\BaseModel;

class CheckLogModel extends BaseModel
{
    protected $table = 'a_check_log';
    protected $fillable = ['check_type', 'data_id', 'admin_id', 'check_remark', 'data'];
   

}
