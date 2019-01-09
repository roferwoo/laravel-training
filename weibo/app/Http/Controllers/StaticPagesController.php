<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Auth;
use QL\QueryList;

class StaticPagesController extends Controller
{
    public function home()
    {
        // return 'home';
        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(30);
        }

        return view('static_pages/home', compact('feed_items'));
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
        // QueryList

        $data = QueryList::get('http://www.myzaker.com/')
            // 设置采集规则
            ->rules([
                'title' => ['h2>a', 'text'],
                'link' => ['h2>a', 'href'],
                // 'source' => ['.subtitle>span', 'text'],// 来源
                // 'pub_date' => ['.subtitle span', 'text'],// 发布时间
                'image' => ['.img', 'style']
            ])
            // ->range('.flex-9')
            ->queryData();
        dd($data);

        // 采集百度搜索结果列表的标题和链接
        $data = QueryList::get('https://www.baidu.com/s?wd=QueryList')
            // 设置采集规则
            ->rules([
                'title' => ['h3', 'text'],
                'link' => ['h3>a', 'href'],
                'em' => ['.c-abstract>em', 'text']
            ])->queryData();
        dd($data);

        // $url = 'https://it.ithome.com/ityejie/';
        // // 元数据采集规则
        // $rules = [
        //     // 采集文章标题
        //     'title' => ['h2>a', 'text'],
        //     // 采集链接
        //     'link' => ['h2>a', 'href'],
        //     // 采集缩略图
        //     'img' => ['.list_thumbnail>img','src'],
        //     // 采集文档简介
        //     'desc' => ['.memo','text']
        // ];
        // // 切片选择器
        // $range = '.ulcl';
        // $rt = QueryList::get($url)->rules($rules)->range($range)->query()->getData();
        // dd($rt->all());

        $url = 'http://www.myzaker.com/';
        $client = new Client();
        $res = $client->request('GET', 'http://www.myzaker.com/');
        $html = (string)$res->getBody();
        $titles = QueryList::html($html)->rules([
            'title' => ['h2>a', 'text']
        ])->queryData();
        $links = QueryList::html($html)->rules([
            'link' => ['h2>a', 'href']
        ])->queryData();
        $sources = QueryList::html($html)->rules([
            'source' => ['.subtitle span', 'text']
        ])->queryData();
        dd($titles, $links, $sources);

        // HTTP客户端 GuzzleHttp
        $client = new Client();
        $res = $client->request('GET', 'https://www.baidu.com/s', [
            'wd' => 'QueryList'
        ]);
        $html = (string)$res->getBody();

        $data = QueryList::html($html)->find('h3')->texts();

        //采集某页面所有的图片
        $data = QueryList::get('http://cms.querylist.cc/bizhi/453.html')->find('img')->attrs('src');
        //打印结果
        dd($data->all());

        // 分别采集百度搜索结果列表的标题和链接
        $ql = QueryList::get('https://www.baidu.com/s?wd=QueryList');
        $titles = $ql->find('h3>a')->texts();// 获取搜索结果标题列表
        $links = $ql->find('h3>a')->attrs('href');// 获取搜索结果链接列表
        dd($titles, $links);

        // 加密
        $raw_str = encrypt(['Laravel学院', 'arr']);
        // 解密
        $decrypted_str = decrypt($raw_str);
        dd(['after_encryt' => $raw_str, 'after_decrypt' => $decrypted_str]);

        /*
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
        */

    }
}
