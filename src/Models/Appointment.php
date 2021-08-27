<?php

namespace Hsvisus\Wechat\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $table = 'appointments';
    protected $guarded = [];

    /**
     * 关联二维码
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function qr()
    {
        return $this->hasOne(Qr::class);
    }
}
