<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Requests\Api\V1\VerificationCodeRequest;
use Overtrue\EasySms\EasySms;
use Overtrue\EasySms\Exceptions\NoGatewayAvailableException;
use GuzzleHttp\Exception\ClientException;
use Cache;

class VerificationCodesController extends ApiController
{

    // public function store(VerificationCodeRequest $request, EasySms $easySms)
    // {
    //     $phone = $request->phone;
    //
    //     if (!app()->environment('production')) {
    //         $code = '1234';
    //     } else {
    //
    //         // 生成4位随机数，左侧补0
    //         $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);
    //
    //         $this->yunpianSms($phone, $code, $easySms);
    //     }
    //
    //     $key = 'verificationCode_' . str_random(15);
    //     $expiredAt = now()->addMinutes(10);
    //     // 缓存验证码 10分钟过期。
    //     Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);
    //
    //     return $this->response->array([
    //         'key' => $key,
    //         'expired_at' => $expiredAt->toDateTimeString(),
    //     ])->setStatusCode(201);
    // }
    // 添加图片验证码后
    public function store(VerificationCodeRequest $request, EasySms $easySms)
    {
        // 图片验证码数据
        $captchaData = Cache::get($request->captcha_key);

        if (!$captchaData) {
            return $this->response->error('图片验证码已失效', 422);
        }

        if (!hash_equals($captchaData['code'], $request->captcha_code)) {
            // 验证错误就清除缓存
            Cache::forget($request->captcha_key);
            return $this->response->errorUnauthorized('验证码错误');
        }

        $phone = $captchaData['phone'];

        if (!app()->environment('production')) {
            $code = '1234';
        } else {
            // 生成4位随机数，左侧补0
            $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);

            $this->yunpianSms($phone, $code, $easySms);
        }

        $key = 'verificationCode_'.str_random(15);
        $expiredAt = now()->addMinutes(10);
        // 缓存短信验证码 10分钟过期。
        Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);
        // 清除图片验证码缓存
        Cache::forget($request->captcha_key);

        return $this->response->array([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
        ])->setStatusCode(201);
    }


    protected function yunpianSms($phone, $code, $easySms)
    {
        try {
            $result = $easySms->send($phone, [
                'content' => "【吴志伟test】您的验证码是{$code}。如非本人操作，请忽略本短信"
            ]);
        } catch (NoGatewayAvailableException $exception) {
            $message = $exception->getException('yunpian')->getMessage();

            return $this->response->errorInternal($message ?: 'yunpian短信发送异常');
        }

        return $result;
        // php artisan tinker 发送测试
        // $sms = app('easysms');
        // try {
        //     $sms->send(13501709322, [
        //         'content'  => '【吴志伟test】您的验证码是1234。如非本人操作，请忽略本短信',
        //     ]);
        // } catch (\Overtrue\EasySms\Exceptions\NoGatewayAvailableException $exception) {
        //     $message = $exception->getException('yunpian')->getMessage();
        //     dd($message);
        // }
    }

    protected function aliyunSms($phone, $code, $easySms)
    {
        try {
            $result = $easySms->send($phone, [
                'template' => 'SMS_XXXX',// 模板
                'data' => [
                    'code' => $code,// 'code'这里的变量名称为阿里云上定义的变量 => 6666
                ],
            ]);
        } catch (ClientException $exception){
            $response = $exception->getResponse();
            $result = json_decode($response->getBody()->getContents(), true);
            return $this->response->errorInternal($result['msg'] ?: 'aliyun短信发送异常');
        }
        return $result;
    }

    protected function qcloudSms($phone, $code, $easySms)
    {
        try {
            $result = $easySms->send($phone, [
                'content' => "您的验证码是{$code}。如非本人操作，请忽略本短信",
            ]);
        } catch (ClientException $exception) {
            $response = $exception->getResponse();
            $result = json_decode($response->getBody()->getContents(), true);
            return $this->response->errorInternal($result['msg'] ?: 'qcloud短信发送异常');
        }

        return $result;
    }
}
