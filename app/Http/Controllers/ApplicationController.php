<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Repositories\Application\ApplicationRepositoryInterface;
use DB;

class ApplicationController extends Controller
{
    protected $applicationRepo;

    public function __construct(ApplicationRepositoryInterface $applicationRepo)
    {
        $this->applicationRepo = $applicationRepo;
    }

    public function apply($id)
    {
        $user = Auth::user();
        $this->applicationRepo->apply($id, $user->id);

        return redirect()->route('show_apply_list');
    }

    public function cancelApply($id)
    {
        $user = Auth::user();
        $this->applicationRepo->cancelApply($id, $user->id);

        return redirect()->route('show_apply_list');
    }

    public function showApplyList()
    {
        $applyJobs = $this->applicationRepo->applyJobs(Auth::user());

        return view('apply_list', [
            'jobs' => $applyJobs,
        ]);
    }

    public function showListCandidateApply($id)
    {
        $job = $this->applicationRepo->getJob($id);
        $this->authorize('update', $job);
        $users = $this->applicationRepo->showListCandidateApply($job);
        return view('candidate', [
            'job' => $job,
            'users' => $users,
        ]);
    }

    public function showHistoryCreateJob()
    {
        $this->authorize('create', Job::class);
        $jobs = $this->applicationRepo->showHistoryCreateJob(Auth::user());

        return view('job_history', [
            'jobs' => $jobs,
        ]);
    }

    public function acceptOrReject($userId, $jobId, $status)
    {
        $job = $this->applicationRepo->find($jobId);
        $this->authorize('update', $job);
        $this->applicationRepo->acceptOrReject($job, $userId, $status);

        return redirect()->route('list_candidate', ['id' => $jobId]);
    }
}
