<?php


namespace Hsvisus\Wechat\Modules\Official;


use Hsvisus\Wechat\Models\Subscriber;
use Hsvisus\Wechat\Models\Visitor;

class Binding
{
    /**
     * 绑定员工
     * @param int $person_id
     * @param string $openid
     * @param null $company_id
     * @return mixed
     */
    public function staff(int $person_id, string $openid, $company_id=null)
    {
        return Subscriber::updateOrCreate(
            [
                'openid' => $openid
            ],
            [
                'person_id' => $person_id,
                'company_id' => $company_id
            ]
        );
    }

    /**
     * 绑定访客
     * @param string $openid
     * @param array $data
     * @return mixed
     */
    public function visitor(string $openid, array $data)
    {
        return Visitor::updateOrCreate(
            [
                'openid' => $openid
            ],
            $data);
    }

}
