<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Client as GuzzleHttpClient;

class AccountKitController extends Controller
{
    /**
    * appId [string]
    */
    protected $appId;

    /**
     * appSecret [string]
     */
    protected $appSecret;

    /**
     *  tokenExchangeUrl [url string]
     */
    protected $tokenExchangeUrl;

    /**
     * endPointUrl [url string]
     */
    protected $endPointUrl;

    /**
     * userAccessToken [string]
     */
    public $userAccessToken;

    
    public function __construct()
    {
        $this->appId            = \Config::get('accountKit.appId');
        $this->client           = new GuzzleHttpClient();
        $this->appSecret        = \Config::get('accountKit.appSecret');
        $this->endPointUrl      = \Config::get('accountKit.endPoint');
        $this->tokenExchangeUrl = \Config::get('accountKit.tokenExchange');
    }


    /**
     * Login method
     * @param  Request $request
     */
    public function login(Request $request)
    {
        try {
            $url = $this->tokenExchangeUrl.'grant_type=authorization_code'.
                '&code='. $request->get('code').
                "&access_token=AA|$this->appId|$this->appSecret";
            $apiRequest = $this->client->request('GET', $url);

            $body = json_decode($apiRequest->getBody());

            $this->userAccessToken = $body->access_token;

            return $this->getData();
        } catch (\Exception $exp) {
            self::logError($exp, __CLASS__, __METHOD__);
            return Redirect(url('/'))->with(['serverError' => trans('messages.error.server_error')]);
        }
    }

    /**
     *  Get Logged in user detail ,
     *  save user detail in db
     *  Auth login with user
     *  and then redirect to the second page
     */
    public function getData()
    {
        try {
            $request = $this->client->request('GET', $this->endPointUrl.$this->userAccessToken);

            $data = json_decode($request->getBody());

            $userId = $data->id;

            $userAccessToken = $this->userAccessToken;

            $phone = isset($data->phone) ? $data->phone->number : '';
 
            $userObj = User::where('fb_id', '=', $userId)->first();

            if ($userObj instanceof User) {
                $userObj->setAccessToken($userAccessToken)->save();
            } else {
                $userObj = new User();
                $userObj->fill([
                            'fb_id' => $userId,
                            'phone' => $phone
                            ])->setAccessToken($userAccessToken)->save();
            }

            \Auth::login($userObj);
            return Redirect(url('/home'));
        } catch (\Exception $exp) {
            self::logError($exp, __CLASS__, __METHOD__);
            return Redirect(url('/'))->with(['serverError' => trans('messages.error.server_error')]);
        }
    }

    /**
     *  Logout and redirect to main page
     */
    public function logout()
    {
        \Auth::logout();
        return \Redirect(url('/'));
    }
}
