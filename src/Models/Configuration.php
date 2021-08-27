<?php

namespace Hsvisus\Wechat\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    use HasFactory;
    protected $table = 'configurations';
    protected $guarded = [];

    public function getOptionsAttribute($value)
    {
        return json_decode($value, true);
    }
    public function setOptionsAttribute($value)
    {
        $this->attributes['options'] = json_encode($value);
    }

    /**
     * 获取配置选项
     * @param string $mark
     * @param null $company_id
     * @return array
     */
    protected function getOptions($company_id=null, string $mark='official'):array
    {
        $result = $this->where('mark', $mark)
            ->where('company_id', $company_id)
            ->first();
        if ($result){
            return $result->options;
        }
        return [];
    }
}
