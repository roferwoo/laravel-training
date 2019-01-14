<?php

namespace App\Observers;

use App\Models\Topic;
use App\Handlers\SlugTranslateHandler;
use App\Jobs\TranslateSlug;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class TopicObserver
{
    public function creating(Topic $topic)
    {
        //
    }

    public function updating(Topic $topic)
    {
        //
    }

    public function saving(Topic $topic)
    {
        // XSS 过滤
        $topic->body = clean($topic->body, 'user_topic_body');

        // 生成话题摘录
        $topic->excerpt = make_excerpt($topic->body);

        // // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        // if ( ! $topic->slug) {
        //     // $topic->slug = app(SlugTranslateHandler::class)->translate($topic->title);
        //     // // 修复edit或者编辑的时候会跑到路由后面的问题
        //     // // @url https://laravel-china.org/topics/14584/slug-has-bug?#reply76507
        //     // if (trim($topic->slug) === 'edit') {
        //     //     $topic->slug = 'edit-slug';
        //     // }
        //
        //     // 推送任务到队列
        //     dispatch(new TranslateSlug($topic));
        // }
    }

    public function saved(Topic $topic)
    {
        // 如 slug 字段无内容，即使用翻译器对 title 进行翻译
        if ( ! $topic->slug) {

            // 推送任务到队列
            dispatch(new TranslateSlug($topic));
        }
    }

    public function deleted(Topic $topic)
    {
        // 注意的是，在模型监听器中，数据库操作需要避免再次 Eloquent 事件，所以这里我们使用了 DB 类进行操作
        \DB::table('replies')->where('topic_id', $topic->id)->delete();
    }
}