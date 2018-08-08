<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users =  User::paginate();
        if ($request->filter) {
            $users = User::where('name', 'like', '%' . $request->filter . '%')->orWhere('email', 'like', '%' . $request->filter . '%')->paginate();
        }
        $users->map(function ($item) {

            $item->button = 'View User Permissions';
            $item['view'] = action('UserController@show', $item->id);
            $item['edit'] = action('UserController@edit', $item->id);
            $item['delete'] = action('Api\UserController@destroy', $item->id);
           // $item->meetingDate = Carbon::createFromFormat('Y-m-d', $item->meetingDate)->format('dS F y');
            return $item;
        });
        return $users;
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::destroy($id);
        return array('ok' => 'ok');
    }
}
