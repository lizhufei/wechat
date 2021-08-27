<?php


namespace Hsvisus\Wechat\Modules\Official;

use Hsvisus\Wechat\Models\Configuration;
use EasyWeChat\Factory;

class Official
{
    protected $config;

    public function __construct(string $callback="", string $scopes='snsapi_userinfo', string $type='array')
    {
        $this->config = [
            'response_type' => $type,
            'oauth' => [
                'scopes'   => [$scopes],
                'callback' => $callback,
            ],
        ];
    }

    /**
     * 获取公众号处理对象
     * @param null $company_id
     * @return \EasyWeChat\OfficialAccount\Application
     */
    public function getOfficial($company_id=null)
    {
        $options = Configuration::getOptions($company_id);
        $this->config['app_id'] = $options['app_id'];
        $this->config['secret'] = $options['secret'];
        $this->config['token'] = $options['token'];
        $this->config['aes_key'] = $options['aes_key'];

        return Factory::officialAccount($this->config);
    }
}
