<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teams = Team::orderBy('id', 'DESC')->paginate(10);


        return view('admin.team.index', compact('teams'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.team.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $team = new Team();
        $team->name = $request->name;
        $team->coachName = $request->coachName;
        $team->country = $request->country;
        if ($request->hasFile('logo')) {

            $file_name ='/images/teamLogo/'.time() . '.' . $request->file('logo')->getClientOriginalExtension();

            if ($request->file('logo')->move( 'images'.'/'.'teamLogo', $file_name)) {

                $team->logo = $file_name;

            }
        }
        $team->saveOrFail();

        return redirect()->route('team.index')->with('success', 'تیم با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function show(Team $team)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $team = Team::find($id);
        return view('admin.team.edit', compact('team'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $team = Team::findOrFail($id);
        $team->name = $request->name;
        $team->coachName = $request->coachName;
        $team->country = $request->country;
        if ($request->hasFile('logo')) {

            $file_name ='/images/teamLogo/'.time() . '.' . $request->file('logo')->getClientOriginalExtension();

            if ($request->file('logo')->move( 'images'.'/'.'teamLogo', $file_name)) {

                $team->logo = $file_name;

            }
        }
        $team->saveOrFail();
       
        return redirect()->route('team.index')
            ->with('success', 'تیم با موفقیت بروزرسانی شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Team  $team
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Team::destroy($id);

        return redirect()->back()
            ->with('success', 'تیم با موفقیت حذف شد.');
    }
}
