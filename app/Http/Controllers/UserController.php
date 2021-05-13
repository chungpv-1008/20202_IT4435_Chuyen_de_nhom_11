<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Tag;
use App\Models\Image;
use App\Http\Requests\UpdateUserRequest;
use Illuminate\Database\Eloquent\Builder;
use Alert;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        if ($this->authorize('view', $user)) {
            return view('user_profile', compact('user'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        if ($this->authorize('update', $user)) {
            $skills = $user->tags()->where('type', config('user.skill'))->get();
            $skillsNotBelongTo = Tag::where('type', config('user.skill'))->get()->diff($skills);

            $langs = $user->tags()->where('type', config('user.language'))->get();
            $langsNotBelongTo = Tag::where('type', config('user.language'))->get()->diff($langs);

            $workingTimes = $user->tags()->where('type', config('user.working_time'))->get();
            $workingTimesNotBelongTo = Tag::where('type', config('user.working_time'))->get()->diff($workingTimes);

            return view('edit_user', compact('user', 'skills', 'skillsNotBelongTo', 'langs', 'langsNotBelongTo', 'workingTimes', 'workingTimesNotBelongTo'));
        }

        return redirect()->route('home');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::find($id);
        if ($this->authorize('update', $user)) {
            $user->update($request->all());
            $user->tags()->sync($request->tag);
            $cv = $request->cv;
            $avt = $request->avatar;

            if (isset($cv) && ($cv->getMimeType() === config('user.pdf'))) {
                $user->cv = $cv->move(public_path() . config('user.upload_user'), date(config('user.date_time')) . $cv->getClientOriginalName());
            }

            if (isset($avt) && ($avt->getMimeType() === config('user.png') || $avt->getMimeType() === config('user.jpg'))) {
                $urlAvt = $avt->move(public_path() . config('user.upload_user'), date(config('user.date_time')) . $avt->getClientOriginalName());
                $url = config('user.upload_user') . date(config('user.date_time')) . $avt->getClientOriginalName();
                if ($user->image) {
                    $user->image->update([
                        'url' => $url,
                    ]);
                } else {
                    Image::create([
                        'url' => $url,
                        'imageable_id' => $user->id,
                        'imageable_type' => User::class,
                        'type' => config('user.avatar'),
                    ]);
                }
            }

            $user->save();
            Alert::success(trans('job.update_messeage'));

            return redirect()->route('home');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
