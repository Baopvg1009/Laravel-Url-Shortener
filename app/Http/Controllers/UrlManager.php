<?php

namespace App\Http\Controllers;

use App\Models\Url;
use Illuminate\Http\Request;

class UrlManager extends Controller
{
    function createShortUrl(Request $request){
        $request->validate([
            'original_url'=>'required'
        ]);
        $url = Url::where('original_url',$request->original_url)->first();
        if (!$url){
            $shortCode =  Url::generateShortCode();
            $url = new Url();
            $url->original_url = $request->original_url;
            $url->short_code = $shortCode;
            $url->save();
        }
        return response()->json([
            'short_url' => url('/').'/' . $shortCode
        ]);
}
    function redirectToOriginalUrl($code){
        $url= Url::where('short_code',$code)->first();
        if (!$url){
            abort(404, 'URL not found');
        }
        $url->increment('visits');
        return response($url->original_url);
    }
    function stats()
    {
        $url= Url::where('short_code',$code)->first();
        if (!$url){
            abort(404, 'URL not found');
        }
        return response()->json([
            'original_url' => $url->original_url,
            'short_code' => $url('/').'/'.$url->short_code,
            'visits' => $url->visits,
        ]);
    }

}
