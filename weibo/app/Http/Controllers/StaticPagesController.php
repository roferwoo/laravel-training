<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class StaticPagesController extends Controller
{
    public function home()
    {
        // return 'home';
        return view('static_pages/home');
    }

    public function help()
    {
        // return 'help';
        return view('static_pages/help');
    }

    public function about()
    {
        // return 'about';
        return view('static_pages/about');
    }

    public function t(Request $request)
    {
        $imgUrl = 'http://sn.people.com.cn/n2/2018/0819/NMediaFile/2018/0819/LOCAL201808191042000321410916308.jpg';//'http://www.lzbs.com.cn/zbxw/attachement/jpg/site2/20180722/d43d7e636a811cbe1c3e1a.jpg';
        $header = [
            'User-Agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_13_6) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.110 Safari/537.36',
            'Referrer' => parse_url($imgUrl)['host'],
            'Host' => parse_url($imgUrl)['host'],
        ];
        $guzzle = new Client(['debug' => true]);

        try {

            var_dump($header);
            $response = $guzzle->get($imgUrl, [
                'headers' => $header,
                'allow_redirects' => true,
                // 'connect_timeout' => 1
            ]);
            // echo '<hr>';
            dd($response->getStatusCode());
            var_dump($response->getHeader('Content-Type'));
            dd($response);

            // if ($response->getStatusCode() != 200) {
            //     return false;
            // }
            // $type = $response->getHeader('Content-Type');
            // if (isset($mimes[$type[0]])) {
            //     $ext       = $mimes[$type[0]];
            //     $file_path = $base_dir . '/' . $save_dir . '/' . $file_name . "." . $ext;
            //
            //     // 获取数据并保存
            //     $bool = Storage::disk('oss')->put($file_path, $response->getBody()->getContents());
            //     if ($bool) {
            //         return 'https://' . config('filesystems.disks.oss.cdnDomain') . '/' . $file_path . '-thumb';
            //         // return Storage::disk('oss')->url($file_path) . '-thumb';
            //     }
            //
            // }
        } catch (\Exception $e) {
            dd($e->getMessage());
            // Log::error('_uploadImgToAliOSS Exception:', ['errMsg' => $e->getMessage(), 'imgUrl' => $imgUrl]);
        }

    }
}
