<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Illuminate\Support\Facades\Validator;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.frontend');
    }

    public function show($hash)
    {
        $form = DB::table('forms')->where('form_hash', '=', $hash)->first();

        if (isset($form->form_hash) && $form->form_hash == $hash) {
            return view('frontend.show', ['form' => $form]);
        } else {
            return redirect('/')->with('error', 'No form with this key found!');
        }
    }

    public function send(Request $request, $hash)
    {
        $form = DB::table('forms')->where('form_hash', '=', $hash)->first();

        if (isset($form->form_hash) && $form->form_hash == $hash) {
            $answerer_name = $request->input('answerer_name');
            $email = $request->input('email');

            if ($request->file('filename')) {
                $file_name = time().'.'.$request->file('filename')->extension();
                $request->file('filename')->move(storage_path("data/$hash/"), $file_name);
            } else {
                return redirect()->back()->withInput()->with('error', 'File is missing!');
            }

            $validator = Validator::make($request->all(), [
                'g-recaptcha-response' => 'required|captcha',
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withInput()->with('error', 'Captcha validation failed!');
            }

            DB::table('entries')->insert([
                'answerer_name' => $answerer_name,
                'email' => $email,
                'file_path' => $file_name,
                'FK_FORM' => $form->id,
            ]);

            return redirect("/$hash")->with('message', 'Your response was saved successfully!');
        } else {
            return redirect('/')->with('error', 'No form with this key found!');
        }
    }
}
