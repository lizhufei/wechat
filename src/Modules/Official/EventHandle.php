<?php


namespace Hsvisus\Wechat\Modules\Official;


use Hsvisus\Wechat\Models\Subscriber;

class EventHandle
{
    private $appid;
    private $toOpenid;
    private $time;
    private $type;

    public function __construct($event)
    {
        //ToUserName 接收方帐号（该公众号 ID）
        //FromUserName 发送方帐号（OpenID, 代表用户的唯一标识）
        //CreateTime 消息创建时间（时间戳）
        //MsgId 消息 ID（64位整型）
        //MsgType event
        //Event 事件类型 （如：subscribe(订阅)、unsubscribe(取消订阅) ...， CLICK 等）
        $this->appid = $event['ToUserName'];
        $this->toOpenid = $event['FromUserName'];
        $this->time = $event['CreateTime'];
        $this->type = $event['Event'];
    }

    /**
     * 事件处理
     */
    public function handler()
    {
        switch ($this->type){
            case 'subscribe': return $this->subscribe();
            case 'unsubscribe': return $this->unsubscribe();
            default: break;
        }
    }

    private function subscribe()
    {
        return '';

    }
    private function unsubscribe()
    {
        return Subscriber::where('openid', $this->toOpenid)->update(['attention' => 0]);
    }

}
