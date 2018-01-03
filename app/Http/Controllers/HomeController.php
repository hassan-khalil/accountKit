<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client as GuzzleHttpClient;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request; 

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

	public function index(){
		return view('home');	
	}

 
	/** 
	 *  Get title from given url and return response 
	 *
	 *  @param Request $request
	 *  @return array $result 
	 */
	public function search(Request $request){
		
		try{

			$urlData = $request->get('urlData');
			 
			$url  = trim($urlData);

			if(filter_var($url, FILTER_VALIDATE_URL) == false){
				// $url = 'http://'.$url;
				 return trans('messages.error.invalid_url');
			}

			$html = new \Htmldom($url);
			$title = $html->find('title',0)->innertext;
			
			return $title;

		}catch(\Exception $exp){
                self::logError($exp, __CLASS__, __METHOD__);
                // return response()->json([]);
                return trans('messages.error.server_error');
        }
	}

}
