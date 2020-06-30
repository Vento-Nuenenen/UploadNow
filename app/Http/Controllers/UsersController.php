<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     *
     * @return Factory|View
     */
    public function index(Request $request)
    {
        if ($request->input('search') == null) {
            $users = DB::table('users')->select('*')->get();
        } else {
            $search_string = $request->input('search');
            $users = DB::table('users')->select('*')
                ->where('scoutname', 'LIKE', "%$search_string%")
                ->orWhere('lastname', 'LIKE', "%$search_string%")
                ->orWhere('firstname', 'LIKE', "%$search_string%")->get();
        }

        return view('users.users', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Factory|View
     */
    public function create()
    {
        return view('users.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     *
     * @return RedirectResponse
     */
    public function store(Request $request)
    {
        $scoutname = $request->input('scoutname');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');

        $password = $request->input('password');
        $password_repeat = $request->input('password_repeat');

        if ($password != null && $password === $password_repeat) {
            $password = Hash::make($password);

            $password_repeat = null;

            DB::table('users')->insert([
                'scoutname' => $scoutname,
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'password' => $password,
            ]);

            return redirect()->back()->with('message', 'Benutzer wurde erstellt.');
        } else {
            return redirect()->back()->with('error', 'Passwort wurde nicht korrekt wiederholt!');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $uid
     *
     * @return Factory|View
     */
    public function edit($uid)
    {
        $users = DB::table('users')->where('id', '=', $uid)->first();

        return view('users.edit', ['users' => $users]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param                          $uid
     *
     * @return RedirectResponse
     */
    public function update(Request $request, $uid)
    {
        $scoutname = $request->input('scoutname');
        $firstname = $request->input('firstname');
        $lastname = $request->input('lastname');
        $email = $request->input('email');

        $password = $request->input('password');
        $password_repeat = $request->input('password_repeat');

        if ($password != null && $password === $password_repeat) {
            $password = Hash::make($password);

            $password_repeat = null;

            DB::table('users')->where('id', '=', $uid)->update([
                'scout_name' => $scoutname,
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
                'password' => $password,
            ]);

            return redirect()->back()->with('message', 'Benutzer wurde aktualisiert.');
        } elseif ($password == null) {
            DB::table('users')->where('id', '=', $uid)->update([
                'scout_name' => $scoutname,
                'first_name' => $firstname,
                'last_name' => $lastname,
                'email' => $email,
            ]);

            return redirect()->back()->with('message', 'Benutzer wurde aktualisiert. Das Passwort wurde beibehalten!');
        } else {
            return redirect()->back()->with('error', 'Passwort wurde nicht korrekt wiederholt!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $uid
     *
     * @return RedirectResponse
     */
    public function destroy($uid)
    {
        DB::table('users')->where('id', '=', $uid)->delete();

        return redirect()->back()->with('message', 'Benutzer erfolgreich gelöscht.');
    }
}
