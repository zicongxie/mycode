<?php

namespace App\Console\Commands\Topic;

use App\Model\Topics;
use Illuminate\Support\Facades\Redis;
use Illuminate\Console\Command;

class FollowCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'topic:follow-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Update topic's follow count into mysql";

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

        $hkeys = Redis::hkeys('topic_follow_count');

        if (empty($hkeys)) {
            $this->error('empty hkeys');
            return;
        }

        foreach ($hkeys as $topic_id) {
            $follow_count = Redis::hget('topic_follow_count', $topic_id);
            Redis::hdel('topic_follow_count', $topic_id);
            Topics::where('id', $topic_id)->increment('follow_count', $follow_count);
        }

        $this->info('done');

    }

}
