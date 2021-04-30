<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tag;
use App\Models\Job;
use App\Models\User;
use App\Models\Company;
use DB;

class JobController extends Controller
{
    public function index()
    {
        $allJobs = Job::where('status', config('job_config.approve'))->with('images')->orderBy('created_at', 'desc')->paginate(config('job_config.paginate'));
        $skills = Tag::where('type', config('tag_config.skill'))->get();
        $langs = Tag::where('type', config('tag_config.language'))->get();
        $workingTimes = Tag::where('type', config('tag_config.working_time'))->get();
        foreach ($allJobs as $job) {
            $job->url =  $job->company->images()->where('type', config('user.avatar'))->first()->url;
        }
        if (Auth::check()) {
            $appliedJobs = Auth::user()->jobs()->where('applications.status', config('job_config.waiting'))->get();
            $tags = array();
            $tagSkill = Auth::user()->tags->where('type', config('tag_config.skill'))->first();

            if ($tagSkill) {
                array_push($tags, $tagSkill->id);
            }

            $tagLang = Auth::user()->tags->where('type', config('tag_config.language'))->first();

            if ($tagLang) {
                array_push($tags, $tagLang->id);
            }

            if (count($tags)) {
                $suitableJobsId = DB::table('jobs')
                    ->join('taggables', 'jobs.id', '=', 'taggables.taggable_id')
                    ->join('tags', 'tags.id', '=', 'taggables.tag_id')
                    ->select('jobs.id')
                    ->where('status', config('job_config.approve'))
                    ->whereIn('tags.id', $tags)
                    ->where('taggable_type', Job::class)
                    ->groupBy('jobs.id')
                    ->havingRaw('count(jobs.id)=' . count($tags))
                    ->get()->pluck('id');

                $suitableJobs = Job::with('images')->whereIn('id', $suitableJobsId)->orderBy('created_at', 'desc')->get();

                foreach ($suitableJobs as $job) {
                    $job->url =  $job->company->images()->where('type', config('user.avatar'))->first()->url;
                }

                return view('listjob', compact('allJobs', 'skills', 'langs', 'workingTimes', 'suitableJobs', 'appliedJobs'));
            }

            return view('listjob', compact('allJobs', 'skills', 'langs', 'workingTimes', 'appliedJobs'));
        }

        return view('listjob', compact('allJobs', 'skills', 'langs', 'workingTimes'));
    }

    public function create()
    {
        if ($this->authorize('create', Job::class)) {
            $skills = Tag::where('type', config('tag_config.skill'))->get();
            $langs = Tag::where('type', config('tag_config.language'))->get();
            $workingTimes = Tag::where('type', config('tag_config.working_time'))->get();
            $companyId = Auth::user()->company->id;

            return view('create_job', [
                'skills' => $skills,
                'langs' => $langs,
                'workingTimes' => $workingTimes,
                'id' => $companyId,
            ]);
        }
    }

    public function store(Request $request)
    {
        if ($this->authorize('create', Job::class)) {
            $job = Job::create($request->all());
            $job->tags()->attach($request->tag);

            return redirect()->route('history');
        }
    }

    public function show($id)
    {
        $job = Job::with('images')->findOrFail($id);
        $job->url = $job->company->images()->where('type', config('user.avatar'))->first()->url;
        $tag = $job->tags->where('type', config('tag_config.skill'))->first();
        if (is_null($tag)) {
            $similarJobs = Job::orderBy('created_at', 'desc')->with('tags')->get();
        } else {
            $similarJobs = $tag->jobs;
        }
        $jobCurrent = Job::where('id', $id)->get();
        $similarJobs = $similarJobs->diff($jobCurrent);
        if (Auth::check()) {
            $appliedJobs = Auth::user()->jobs()->where('applications.status', config('job_config.waiting'))->get();

            return view('job_detail', compact('similarJobs', 'appliedJobs', 'job'));
        }

        return view('job_detail', compact('similarJobs', 'job'));
    }

    public function edit($id)
    {
        $job = Job::findOrFail($id);
        if ($this->authorize('update', $job)) {
            $skills = Tag::where('type', config('tag_config.skill'))->get();
            $langs = Tag::where('type', config('tag_config.language'))->get();
            $workingTimes = Tag::where('type', config('tag_config.working_time'))->get();

            return view('edit_job', [
                'job' => $job,
                'skills' => $skills,
                'langs' => $langs,
                'workingTimes' => $workingTimes,
            ]);
        }
    }

    public function update(Request $request, $id)
    {
        $job = Job::findOrFail($id);
        if ($this->authorize('update', $job)) {
            $job->update($request->all());
            $job->tags()->sync($request->tag);

            return redirect()->route('jobs.show', ['job' => $id]);
        }
    }

    public function destroy($id)
    {
        $job = Job::findOrFail($id);
        if ($this->authorize('update', $job)) {
            $job->tags()->detach();
            $job->delete();

            return redirect()->route('history');
        }
    }
}
