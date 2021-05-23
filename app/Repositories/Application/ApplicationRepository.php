<?php

namespace App\Repositories\Application;

use App\Repositories\BaseRepository;
use App\Models\Job;
use App\Models\Tag;
use DB;

class ApplicationRepository extends BaseRepository implements ApplicationRepositoryInterface
{
    public function getModel()
    {
        return Job::class;
    }

    public function getJob($id)
    {
        $job = $this->model->findOrFail($id);
        $job->url =  $job->images()->where('type', config('user.avatar'))->first()->url;

        return $job;
    }

    public function apply($id, $userId)
    {
        $job = $this->model->findOrFail($id);

        return $job->users()->attach($userId, ['status' => config('job_config.waiting')]);
    }

    public function cancelApply($id, $userId)
    {
        $job = $this->model->findOrFail($id);

        return $job->users()->detach($userId);
    }

    public function applyJobs($user)
    {
        $applyJobs = $user->jobs()->orderBy('applications.status', 'asc')->get()->load('images');
        foreach ($applyJobs as $job) {
            $job->url =  $job->images()->where('type', config('user.avatar'))->first()->url;
        }

        return $applyJobs;
    }

    public function acceptOrReject($job, $userId, $status)
    {
        return $job->users()->where('user_id', $userId)->update(['applications.status' => $status]);
    }

    public function showHistoryCreateJob($user)
    {
        $jobs = $user->company->jobs()->orderBy('created_at', 'desc')->get()->load('images');
        foreach ($jobs as $job) {
            $job->url =  $job->images()->where('type', config('user.avatar'))->first()->url;
        }

        return $jobs;
    }

    public function showListCandidateApply($job)
    {
        return $job->users()->orderBy('applications.status', 'asc')->get();
    }
}
