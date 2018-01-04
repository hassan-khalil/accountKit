<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use App\Events\TitleEvent;

class HomeController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth');
    }


    /**
     *  Return application's second page
     *
     */

    public function index()
    {
        return view('home');
    }


    /**
     *  broadCast get string and send it to pusher
     *  to display on home screen
     *
     *  @param string $title
     */

    private function broadCast($title)
    {
        $options = array(
                    'cluster' => 'us2',
                    'encrypted' => true
                  );
        $pusher = new \Pusher(
                     'pusher-id',
                     'pusher-key',
                     'pusher-secret',
                     $options
                    );

        $data['message'] = $title;
        $pusher->trigger('my-channel', 'my-event', $data);
    }


    /**
     *  Get title from given url and return response
     *
     *  @param Request $request
     *  @return array $result
     */
    public function search(Request $request)
    {
        try {
            $urlData = $request->get('urlData');
            $urlData  = explode(',', $urlData);

            foreach ($urlData as $url) {
                $url  = trim($url);
                if (filter_var($url, FILTER_VALIDATE_URL) == false) {
                    // $url = 'http://'.$url;
                    $this->broadCast('Invalid Url');
                    continue ;
                }

                $html = new \Htmldom($url);
                $title = $html->find('title', 0)->innertext;

                $this->broadCast($title);
            }
        } catch (\Exception $exp) {
            self::logError($exp, __CLASS__, __METHOD__);
            // return response()->json([]);
            return trans('messages.error.server_error');
        }
    }
}
