<?php

namespace Hsvisus\Wechat\Modules\Official;


use Hsvisus\Wechat\Models\OfficialMenu;

class CustomizeMenus
{
    /**
     * 构建自定义菜单
     * @param null $company_id
     * @return bool|mixed
     * @throws \EasyWeChat\Kernel\Exceptions\InvalidConfigException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function build($company_id=null)
    {
        $official = new Official();
        $app = $official->getOfficial($company_id);
        $buttons = [];
        $menus = OfficialMenu::gain($company_id);
        $count = 0;
        foreach ($menus as $i=>$m){
            if (0 == $m->parent_id){
                if (3 <= $count){ //一级菜单不能超过三个
                    return true;
                }
                $but = [
                    'name' => $m->name,
                    'type' => $m->type
                ];
                $buttons[$m->id] = array_merge($but, $this->classify($m));
                $count++;
                unset($menus[$i]);
            }
        }
        foreach ($menus as $m){
            if (isset($buttons[$m->parent_id])){
                $but = [
                    'name' => $m->name,
                    'type' => $m->type
                ];
                $buttons[$m->parent_id]['sub_button'][] = array_merge($but, $this->classify($m));
                unset(
                    $buttons[$m->parent_id]['type'],
                    $buttons[$m->parent_id]['key'],
                    $buttons[$m->parent_id]['url'],
                    $buttons[$m->parent_id]['appid'],
                    $buttons[$m->parent_id]['pagepath'],
                    $buttons[$m->parent_id]['media_id'],
                );
            }
        }

        $app->menu->delete(); // 全部
        return $app->menu->create(array_values($buttons));
    }

    /**
     * 菜单分类
     * @param $data
     * @return array
     */
    private function classify($data)
    {
        switch ($data->type){
            case 'view':
                return ['url' => $data->url];
            case 'click':
                return ['key' => $data->key];
            case 'miniprogram':
                return [
                    'url' => $data->url,
                    'appid' => $data->appid,
                    'pagepath' => $data->pagepath
                ];
            default:
                return ['media_id' => $data->media_id];
        }
    }

}
