<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Models\Job;
use App\Models\User;
use App\Models\Company;
use DB;
use Alert;

class SearchController extends Controller
{
    public function filter(Request $request)
    {
        if (is_null($request->tag)) {
            $jobs = Job::where('status', config('job_config.approve'))->get();
            $appliedJobs = null;
            if (Auth::check()) {
                $appliedJobs = Auth::user()->jobs()->where('applications.status', config('job_config.waiting'))->get();
            }
            foreach ($jobs as $job) {
                $job->url =  $job->images()->where('type', config('user.avatar'))->first()->url;
            }

            return view('layouts.filter_job', [
                'jobs' => $jobs,
                'appliedJobs' => $appliedJobs,
            ]);
        }
        $filterJobsId = DB::table('jobs')
            ->join('taggables', 'jobs.id', '=', 'taggables.taggable_id')
            ->join('tags', 'tags.id', '=', 'taggables.tag_id')
            ->select('jobs.id')
            ->where('status', config('job_config.approve'))
            ->whereIn('tags.id', $request->tag)
            ->where('taggable_type', Job::class)
            ->groupBy('jobs.id')
            ->havingRaw('count(jobs.id)=' . count($request->tag))
            ->get()->pluck('id');
        $filterJobs = Job::with('images')->whereIn('id', $filterJobsId)->get();

        foreach ($filterJobs as $job) {
            $job->url =  $job->images()->where('type', config('user.avatar'))->first()->url;
        }
        if (Auth::check()) {
            $appliedJobs = Auth::user()->jobs()->where('applications.status', config('job_config.waiting'))->get();

            return view('layouts.filter_job', [
                'appliedJobs' => $appliedJobs,
                'jobs' => $filterJobs,
            ]);
        }

        return view('layouts.filter_job', [
            'jobs' => $filterJobs,
        ]);
    }

    public function search(Request $request)
    {
        if ($request->title) {
            $jobs = Job::where('status', config('job_config.approve'))->with('images')->where('title', 'LIKE', '%' . $request->title . '%')->get();

            foreach ($jobs as $job) {
                $job->url =  $job->images()->where('type', config('user.avatar'))->first()->url;
            }

            return view('search_jobs', [
                'jobs' => $jobs,
            ]);
        }

        $companies = Company::with('images')->where('name', 'LIKE', '%' . $request->name . '%')->get();

        foreach ($companies as $company) {
            $company->url =  $company->images()->where('type', config('user.avatar'))->first()->url;
        }

        return view('search_company', [
            'companies' => $companies,
        ]);
    }

    public function findJobByTag($id)
    {
        $tag = Tag::findOrFail($id);
        $jobs = $tag->jobs->where('status', config('job_config.approve'))->paginate(config('job_config.paginate'));
        $tag = Auth::user()->tags->where('type', config('tag_config.skill'))->first();
        $suitableJobs = $tag->jobs->where('status', config('job_config.approve'))->get();
        if (is_null($tag)) {
            $suitableJobs = Job::orderBy('created_at', 'desc')->with('tags')->get();
        }
        $appliedJobs = Auth::user()->jobs()->where('applications.status', config('job_config.waiting'))->get();
        $skills = Tag::where('type', config('tag_config.skill'))->get();
        $langs = Tag::where('type', config('tag_config.language'))->get();
        $workingTimes = Tag::where('type', config('tag_config.working_time'))->get();

        return view('listjob', [
            'allJobs' => $jobs,
            'suitableJobs' => $suitableJobs,
            'appliedJobs' => $appliedJobs,
            'skills' => $skills,
            'langs' => $langs,
            'workingTimes' => $workingTimes,
        ]);
    }
}