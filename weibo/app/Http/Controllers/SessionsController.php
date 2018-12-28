<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionsController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store(Request $request)
    {
        $credentials = $this->validate($request, [
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);

        // if (Auth::attempt($credentials)) {
        if (Auth::attempt($credentials, $request->has('remember'))) {// 记住我 功能
            session()->flash('success', '欢迎回来！');
            return redirect()->route('users.show', [Auth::user()]);
        } else {
            session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
            // return redirect()->back();// 页面不保存上次输入内容
            // return redirect()->back()->withInput();// 保存上次输入所有内容
            return redirect()->back()->exceptInput('password');// 保存上次输入 除password的内容
        }
    }

    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('login');
    }
}
