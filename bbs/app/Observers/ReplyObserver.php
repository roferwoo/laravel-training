<?php

namespace App\Observers;

use App\Models\Reply;
use App\Notifications\TopicReplied;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        // 处理 XSS 安全问题
        $reply->content = clean($reply->content, 'user_topic_body');
    }

    public function updating(Reply $reply)
    {
        //
    }

    public function created(Reply $reply)
    {
        // $reply->topic->increment('reply_count', 1);
        // $reply->topic()->increment('reply_count', 1);

        $topic = $reply->topic;
        $topic->increment('reply_count', 1);

        // 通知作者话题被回复了
        $topic->user->notify(new TopicReplied($reply));
        // 如果评论的作者不是话题的作者，才需要通知
        // if ( ! $reply->user->isAuthorOf($topic)) {
        //     $topic->user->notify(new TopicReplied($reply));
        // }
    }
}