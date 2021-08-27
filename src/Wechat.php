<?php


namespace Hsvisus\Wechat;


use Hsvisus\Wechat\Models\Qr;
use Hsvisus\Wechat\Modules\Official\Binding;
use Hsvisus\Wechat\Modules\Official\CustomizeMenus;
use Hsvisus\Wechat\Modules\Official\TemplateNotifier;

class Wechat
{
    /**
     * 构建自定菜单
     * @param null $company_id
     * @return bool|mixed
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function buildMenus($company_id=null)
    {
        $build = new CustomizeMenus();
        return $build->build($company_id);
    }

    /**
     * 考勤通知
     * @param string $toOpenid 接收人OPENID
     * @param array $data      模板数据
     * @param null $company_id 公司ID
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function attendanceInform(string $toOpenid, array $data, $company_id=null)
    {
        $template = new TemplateNotifier($company_id);
        return $template->attendanceTemplate($toOpenid, $data);
    }

    /**
     * 消费通知
     * @param string $toOpenid
     * @param array $data
     * @param null $company_id
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function consumerInform(string $toOpenid, array $data, $company_id=null)
    {
        $template = new TemplateNotifier($company_id);
        return $template->consumerTemplate($toOpenid, $data);
    }

    /**
     * 访客申请通知
     * @param string $toOpenid
     * @param array $data
     * @param null $company_id
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function applyInform(string $toOpenid, array $data, $company_id=null)
    {
        $template = new TemplateNotifier($company_id);
        return $template->visitorApplyTemplate($toOpenid, $data);
    }

    /**
     * 预约审核通知
     * @param string $toOpenid
     * @param array $data
     * @param null $company_id
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     */
    public function auditInform(string $toOpenid, array $data, $company_id=null)
    {
        $template = new TemplateNotifier($company_id);
        return $template->visitorAheadTemplate($toOpenid, $data);
    }

    /**
     * 绑定员工和公众号
     * @param int $person_id
     * @param string $openid
     * @param null $company_id
     * @return mixed
     */
    public function bindStaff(int $person_id, string $openid, $company_id=null)
    {
        $bind = new Binding();
        return $bind->staff($person_id,$openid,$company_id);
    }

    /**
     * 绑定访客和公众号
     * @param string $openid
     * @param array $data     {nickname sex, head}
     * @return mixed
     */
    public function bindVisitor(string $openid, array $data)
    {
        $bind = new Binding();
        return $bind->visitor($openid, $data);
    }

    /**
     * 获取开门二维码图片
     * @param int $appointment_id
     * @return string
     */
    public function createQR(int $appointment_id):string
    {
        return Qr::getQR($appointment_id)?:Qr::storage($appointment_id);
    }



}
