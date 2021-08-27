<?php

namespace Hsvisus\Wechat\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor_info extends Model
{
    use HasFactory;
    protected $table = 'visitor_infos';
    protected $guarded = [];
}
