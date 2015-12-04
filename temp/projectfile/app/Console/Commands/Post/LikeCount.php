<?php

namespace App\Console\Commands\Post;

use App\Model\Posts;
use Illuminate\Support\Facades\Redis;
use Illuminate\Console\Command;

class LikeCount extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'post:like-count';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Update post's like count into mysql";

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

        $hkeys = Redis::hkeys('post_like_count');

        if (empty($hkeys)) {
            $this->error('empty hkeys');
            return;
        }

        foreach ($hkeys as $post_id) {
            $like_count = Redis::hget('post_like_count', $post_id);
            Redis::hdel('post_like_count', $post_id);
            Posts::where('id', $post_id)->increment('like_count', $like_count);
        }

        $this->info('done');

    }
    
}
