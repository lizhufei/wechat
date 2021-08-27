<?php

namespace Hsvisus\Wechat\Modules\Official;

use GuzzleHttp\Client;

class TemplateNotifier
{
    private $post_template_id = 'https://api.weixin.qq.com/cgi-bin/template/api_add_template?access_token=';
    private $app;

    public function __construct($company_id=null)
    {
        $this->app = (new Official())->getOfficial($company_id);
    }

    /**
     * 考勤打卡通知
     * @param string $toOpenid
     * @param array $data
     * @throws \EasyWeChat\Kernel\Exceptions\HttpException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyWeChat\Kernel\Exceptions\RuntimeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function attendanceTemplate(string $toOpenid, array $data)
    {
        $template_no = config('wechat.attendance');
        $template_id = $this->getTemplateLib($template_no);
        return $this->app->template_message->sendSubscription([
            'touser' => $toOpenid,
            'template_id' => $template_id,
            'data' => [
                'first' => $data[0],
                'keyword1' => $data[1],
                'keyword2' => $data[2],
                'keyword3' => $data[3],
                'remark' => $data[4],
            ],
        ]);
    }

    /**
     * 消费通知
     * @param string $toOpenid
     * @param array $data
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\HttpException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyWeChat\Kernel\Exceptions\RuntimeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function consumerTemplate(string $toOpenid, array $data)
    {
        $template_no = config('wechat.consumer');
        $template_id = $this->getTemplateLib($template_no);
        return $this->app->template_message->sendSubscription([
            'touser' => $toOpenid,
            'template_id' => $template_id,
            'data' => [
                'first' => $data[0],   //例:亲爱的闰蜜，
                'keyword1' => $data[1], //本次消费金额：560.00元
                'keyword2' => $data[2], //消费门店：涟依白鹭洲店
                'keyword3' => $data[3], //结算时间：2018-11-16 16:55:55
                'keyword4' => $data[4],  //帐户余额：1000.00元
                'remark' => $data[5], //查看详情
            ],
        ]);

    }

    /**
     * 访客申请通知
     * @param string $toOpenid
     * @param array $data
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\HttpException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyWeChat\Kernel\Exceptions\RuntimeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function visitorApplyTemplate(string $toOpenid, array $data)
    {
        $template_no = config('wechat.visitor_apply');
        $template_id = $this->getTemplateLib($template_no);
        return $this->app->template_message->sendSubscription([
            'touser' => $toOpenid,
            'template_id' => $template_id,
            'data' => [
                'first' => $data[0],      // 例:新访客申请
                'keyword1' => $data[1],   // 来访姓名：张三
                'keyword2' => $data[2],   // 来访事由：面试
                'keyword3' => $data[3],   // 预约时间：2019-01-02 9:00-10:00
                'keyword4' => $data[4],   // 预约时间：2019-01-02 9:00-10:00
                'remark' => $data[5],     // 请尽快审核！
            ],
        ]);

    }

    /**
     * 预约审核通知
     * @param string $toOpenid
     * @param array $data
     * @return array|\EasyWeChat\Kernel\Support\Collection|object|\Psr\Http\Message\ResponseInterface|string
     * @throws \EasyWeChat\Kernel\Exceptions\HttpException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyWeChat\Kernel\Exceptions\RuntimeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    public function visitorAheadTemplate(string $toOpenid, array $data)
    {
        $template_no = config('wechat.visitor_ahead');
        $template_id = $this->getTemplateLib($template_no);
        return $this->app->template_message->sendSubscription([
            'touser' => $toOpenid,
            'template_id' => $template_id,
            'data' => [
                'first' => $data[0],       // 例:您好，您有一天访客预约已被拒绝
                'keyword1' => $data[1],    //被访企业：厦门一指通智能科技有限公司
                'keyword2' => $data[2],    //被访人员：张三
                'keyword3' => $data[3],    //被访人电话：18255667788
                'keyword4' => $data[4],    //审核状态：拒绝
                'keyword5' => $data[5],    // 预约访问时间：2020年06月23日 下午2:00
                'remark' => $data[6],      //拒绝原因：谢绝推销
            ],
        ]);
    }

    /**
     * 根据行业模板编号获取模板ID
     * @param string $number 行业模板编号
     * @return mixed|string
     * @throws \EasyWeChat\Kernel\Exceptions\HttpException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidArgumentException
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \EasyWeChat\Kernel\Exceptions\RuntimeException
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Psr\SimpleCache\InvalidArgumentException
     */
    private function getTemplateLib(string $number)
    {
        $accessToken = $this->app->access_token;
        $token = $accessToken->getToken(); // token 数组  token['access_token'] 字符串
        //$token = $accessToken->getToken(true); // 强制重新从微信服务器获取 token.
        $result = $this->postTemplateId($number, $token);
        if ('ok' == $result['errcode']){
            return $result['template_id'];
        }
        return '';
    }

    /**
     * 获取微信模板库指的模板ID
     * @param string $token
     * @return mixed
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    private function postTemplateId(string $token, string $number)
    {
        $url = $this->post_template_id . $token;
        $client = new Client(['base_uri' => $url]);
        $response = $client->$client->request('POST', '', [
            'template_id_short' => $number
        ]);
        $body = $response->getBody();
        return json_decode($body->getContents(), true);
    }

}
