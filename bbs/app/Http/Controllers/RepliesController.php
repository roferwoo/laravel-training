<?php

namespace App\Http\Controllers;

use App\Models\Reply;
use App\Http\Requests\ReplyRequest;
use Auth;

class RepliesController extends Controller
{
    public function __construct()
    {
        // $this->middleware('auth', ['except' => ['index', 'show']]);
        $this->middleware('auth');
    }


    public function store(ReplyRequest $request, Reply $reply)
    {
        // $reply->content = $request->content;
        $reply->content = $request->input('content');
        if (empty($reply->content)) {
            return redirect()->back()->with('danger', '回复内容错误！');
        }

        $reply->user_id = Auth::id();
        $reply->topic_id = $request->input('topic_id');// $request->topic_id;
        $reply->save();

        return redirect()->to($reply->topic->link())->with('success', '创建成功！');
    }

    public function destroy(Reply $reply)
    {
        $this->authorize('destroy', $reply);
        $reply->delete();

        return redirect()->route('replies.index')->with('success', '删除成功！');
    }
}