<?php

namespace App\Jobs\Middleware;

use Closure;

class LimitRunningJob
{
    /**
     * Process the queued job.
     *
     * @param  \Closure(object): void  $next
     */
    public function handle(object $job, Closure $next): void
    {
        // $user = $job->user;

        // if ($user->role('admin')) {
        //     return $next($job);
        // }

        // return $job->release(60);
    }
}
