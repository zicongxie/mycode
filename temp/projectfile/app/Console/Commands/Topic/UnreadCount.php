<?php

namespace App\Console\Commands\Topic;

use App\Model\TopicFollows;
use Illuminate\Support\Facades\Redis;
use Illuminate\Console\Command;

class UnreadCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'topic:unread-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Update topic's unread count into mysql";

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle() {

        $hkeys = Redis::hkeys('topic_unread_count');

        if (empty($hkeys)) {
            $this->error('empty hkeys');
            return;
        }

        foreach ($hkeys as $topic_id) {
            $unread_count = Redis::hget('topic_unread_count', $topic_id);
            Redis::hdel('topic_unread_count', $topic_id);
            TopicFollows::where('topic_id', $topic_id)->increment('unread_count', $unread_count);
        }

        $this->info('done');

    }
}
