<?php


namespace Hsvisus\Wechat\Controllers;

use App\Http\Controllers\Controller;
use Hsvisus\Wechat\Modules\Official\EventHandle;
use Hsvisus\Wechat\Modules\Official\Official;
use Illuminate\Http\Request;

class EntranceController extends Controller
{
    /**
     * 公众号入口处理
     * @param Request $request
     * @param null $company_id
     */
    public function index(Request $request, $company_id=null)
    {
        $official = new Official();
        $app = $official->getOfficial($company_id);
        // TODO 接收处理回复信息
        $app->server->push(function ($message) {
            switch ($message['MsgType']) {
                case 'event':
                    return (new EventHandle($message))->handler();
                case 'text':
                    return '收到文字消息';
                case 'image':
                    return '收到图片消息';
                case 'voice':
                    return '收到语音消息';
                case 'video':
                    return '收到视频消息';
                case 'location':
                    return '收到坐标消息';
                case 'link':
                    return '收到链接消息';
                case 'file':
                    return '收到文件消息';
                default:
                    return '收到其它消息';
            }

        });
        return $app->server->serve();
    }

}
