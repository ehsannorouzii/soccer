<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;

use App\Player;
use App\Team;
use Illuminate\Http\Request;

class PlayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $players = Player::orderBy('id', 'DESC')->paginate(10);


        return view('admin.player.index', compact('players'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teams=Team::all();
       

        return view('admin.player.create',compact('teams'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $player = new Player();
        $player->name = $request->name;
        $player->team_id = $request->team_id;
        $player->lastname = $request->lastname;
        $player->age = $request->age;
        $player->nationality = $request->nationality;

        if ($request->hasFile('image')) {

            $file_name ='/images/playerImage/'.time() . '.' . $request->file('image')->getClientOriginalExtension();

            if ($request->file('image')->move( 'images'.'/'.'playerImage', $file_name)) {

                $player->image = $file_name;

            }
        }


        $player->saveOrFail();

        return redirect()->route('player.index')->with('success', 'بازیکن با موفقیت ایجاد شد.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function show(Player $player)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $teams=Team::all();
        $player = Player::find($id);
        return view('admin.player.edit',compact('teams','player'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $player = Player::find($id);
        $player->name = $request->name;
        $player->team_id = $request->team_id;
        $player->lastname = $request->lastname;
        $player->age = $request->age;
        $player->nationality = $request->nationality;
        if ($request->hasFile('image')) {

            $file_name ='/images/playerImage/'.time() . '.' . $request->file('image')->getClientOriginalExtension();

            if ($request->file('image')->move( 'images'.'/'.'playerImage', $file_name)) {

                $player->image = $file_name;

            }
        }
        $player->saveOrFail();

        return redirect()->route('player.index')->with('success', 'بازیکن با موفقیت ویرایش شد.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Player  $player
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Player::destroy($id);

        return redirect()->back()
            ->with('success', 'بازیکن با موفقیت حذف شد.');
    }
}
