<?php

namespace App\Http\Controllers\Settings;

use App\Jobs\CreateBaseTemplate;
use App\Http\Controllers\Controller;
use App\Services\PageService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\FacebookPage;
use JavaScript;

class BotSettingController extends Controller
{
    protected function openPage(PageService $pageService)
    {

        $is_social_account = true;
        $subscribed_page = '';

        if (!isset(Auth::user()->id)) {
            return redirect('auth/login');
        }

        //exist page in db
        $is_subscribed_page = FacebookPage::where('user_id', Auth::user()->id)->first();

        if ($is_subscribed_page) {
            $subscribed_page = $is_subscribed_page;
        }


        if(isset(Auth::user()->socialAccount()->first()->access_token)) {
            $token = Auth::user()->socialAccount()->first()->access_token;
            $result = $pageService->getPage($token);
            $result = json_decode($result, true);
        }

        if (isset($result['data'])) {
            $result = $result['data'];
        } else {
            $result['error'] = "Social";
        }

        if(!isset(Auth::user()->socialAccount()->first()->access_token)){
           $is_social_account = false;
        }

        if(!empty($subscribed_page)) {
            JavaScript::put([
                'current_id_page' => $subscribed_page->id_page
            ]);
        }

        return view('setting-bot.setting', [
            'pages' => $result,
            'user_id' => Auth::user()->id,
            'is_page' => $is_subscribed_page,
            'subscribed_page' => $subscribed_page,
            'style' => 'setting',
            'is_social_account' => $is_social_account
        ]);
    }

    protected function setToken(Request $request, PageService $pageService)
    {
        try {
            $token = $request['token'];
            $id_page = $request['id_page'];
            $name = $request['name_page'];
            $id_user = $request['id_user'];

            $facebookPage = FacebookPage::where('user_id', $id_user)->first();

            $old_page_id = $request['old_page_id'] ?: false;

            dispatch(new CreateBaseTemplate($id_page, $old_page_id));

            if (!$facebookPage) {
                $facebookPage = new FacebookPage();
                $facebookPage->user_id = $id_user;
                $facebookPage->id_page = $id_page;
                $facebookPage->name_page = $name;
                $facebookPage->access_token_page = $token;
                $facebookPage->save();

                $result = $pageService->subscribedAppPage($token);
                return $id_page;
            }

            $pageService->unsubscribedAppPage($facebookPage->access_token_page, $facebookPage->id_page);

            FacebookPage::where('user_id', $id_user)->update([
                'id_page' => $id_page,
                'name_page' => $name,
                'access_token_page' => $token
            ]);

            $pageService->subscribedAppPage($token);

            return $id_page;
        } catch (Exception $e) {
            return $e->getMessage();
        }
        return 'ok';
    }

    protected function deleteToken(Request $request, PageService $pageService)
    {
        $token = $request['token'];
        $id_page = $request['id_page'];
        $id_user = $request['id_user'];
        $result_query = DB::table('facebook_pages')->where('user_id', $id_user)->delete();
        $result_unsubsc = $pageService->unsubscribedAppPage($token, $id_page);

        $result = $result_query . "=>" . $result_unsubsc;
        return $result;
    }
}
