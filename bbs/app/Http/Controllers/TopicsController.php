<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use App\Http\Requests\TopicRequest;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }

    public function index(TopicRequest $request, Topic $topic)
    {
        // $topics = Topic::paginate(30);// 默认是15条
        // 关联数据遍历时 N+1问题，使用预加载功能 来解决此问题
        // $topics = Topic::with('user', 'category')->paginate(30);

        $topics = $topic->withOrder($request->order)->paginate(20);

        return view('topics.index', compact('topics'));
    }

    public function show(Topic $topic)
    {
        return view('topics.show', compact('topic'));
    }

    public function create(Topic $topic)
    {
        return view('topics.create_and_edit', compact('topic'));
    }

    public function store(TopicRequest $request)
    {
        $topic = Topic::create($request->all());
        return redirect()->route('topics.show', $topic->id)->with('message', 'Created successfully.');
    }

    public function edit(Topic $topic)
    {
        $this->authorize('update', $topic);
        return view('topics.create_and_edit', compact('topic'));
    }

    public function update(TopicRequest $request, Topic $topic)
    {
        $this->authorize('update', $topic);
        $topic->update($request->all());

        return redirect()->route('topics.show', $topic->id)->with('message', 'Updated successfully.');
    }

    public function destroy(Topic $topic)
    {
        $this->authorize('destroy', $topic);
        $topic->delete();

        return redirect()->route('topics.index')->with('message', 'Deleted successfully.');
    }
}