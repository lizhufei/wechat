<?php


namespace Hsvisus\Wechat;

use Illuminate\Support\Facades\Facade;

class FacadeService extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'wechat';
    }
}
