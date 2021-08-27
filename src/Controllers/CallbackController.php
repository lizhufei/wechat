<?php


namespace Hsvisus\Wechat\Controllers;

use App\Http\Controllers\Controller;
use Hsvisus\Wechat\Modules\Official\Official;
use Illuminate\Http\Request;

class CallbackController extends Controller
{
    /**
     * auth2.0授权回调
     * @param Request $request
     */
    public function authorizer(Request $request, $company_id)
    {
        $code = $request->get('code');
        $state = $request->get('state');

        $app = (new Official())->getOfficial($company_id);
        $oauth = $app->oauth;

        if (empty($code)){
            $redirectUrl = $oauth->redirect($request->fullUrl());
            return \redirect($redirectUrl);
        }else{
            $user = $oauth->userFromCode($code);
            return response()->json($user->toArray());
        }

    }
}
