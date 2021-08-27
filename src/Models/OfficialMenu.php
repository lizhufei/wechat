<?php

namespace Hsvisus\Wechat\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OfficialMenu extends Model
{
    use HasFactory;

    protected $table = 'official_menus';
    protected $guarded = [];

    /**
     * 获取所有菜单
     * @param null $company_id
     * @return mixed
     */
    protected function gain($company_id=null)
    {
        return $this->when($company_id, function ($q)use($company_id){
            $q->where('company_id', $company_id);
        })
            ->get();
    }
}
