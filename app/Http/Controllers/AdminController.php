<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Models\Job;
use App\Models\User;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function viewListUser()
    {
        $allUsers = User::all();
        $candidates = $allUsers->where('role_id', config('user.candidate'));
        $employers = $allUsers->where('role_id', config('user.employer'));

        return view('user_list', [
            'candidates' => $candidates,
            'employers' => $employers,
        ]);
    }

    public function updateUser($id, $status)
    {
        $user = User::findOrFail($id);
        $user->update(['status' => $status]);
        $allUsers = User::all();
        $candidates = $allUsers->where('role_id', config('user.candidate'));
        $employers = $allUsers->where('role_id', config('user.employer'));

        return redirect()->route('list_user', [
            'candidates' => $candidates,
            'employers' => $employers,
        ]);
    }

    public function viewListJob()
    {
        $approveJobs = Job::with(['tags', 'company', 'images'])->where('status', config('job_config.approve'))->get();
        $unapproveJobs = Job::with(['tags', 'company', 'images'])->where('status', config('job_config.unapprove'))->get();
        foreach ($approveJobs as $job) {
            $image =  $job->images()->firstWhere('type', config('user.avatar'));
            if ($image) {
                $job->url = $image->url;
            } else {
                $job->url = config('user.default_avatar_company');
            }
        }

        foreach ($unapproveJobs as $job) {
            $image =  $job->images()->firstWhere('type', config('user.avatar'));
            if ($image) {
                $job->url = $image->url;
            } else {
                $job->url = config('user.default_avatar_company');
            }
        }

        return view('job_list', [
            'approveJobs' => $approveJobs,
            'unapproveJobs' => $unapproveJobs,
        ]);
    }

    public function approveJob($id)
    {
        Job::where('id', $id)->update(['status' => config('job_config.approve')]);

        return redirect()->route('list_job');
    }
}
