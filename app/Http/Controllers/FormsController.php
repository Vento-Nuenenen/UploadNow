<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Response;
use ZipArchive;
use File;

class FormsController extends Controller
{
    public function index(Request $request){
        if($request->input('search') == null){
            $forms = DB::table('forms')->select('*')->get();
        }else{
            $search_string = $request->input('search');
            $forms = DB::table('forms')->select('*')
                ->where('forms.form_name', 'LIKE', "%$search_string%")->get();
        }

        return view('forms.forms', ['forms' => $forms]);
    }

    public function show($fid){
        $form = DB::table('forms')->where('id', '=', $fid)->first();
        $entries = DB::table('entries')->where('FK_FORM', '=', $form->id)->get();

        return view('forms.show', ['form' => $form, 'entries' => $entries]);
    }

    public function downloadAll($hash){
        $filename = $hash . '.zip';
        $files = File::files(storage_path("data/$hash/"));

        $zip = new ZipArchive();
        $zip->open(storage_path("tmp/") . $filename, ZipArchive::CREATE | ZipArchive::OVERWRITE);

        foreach ($files as $file) {
            $zip->addFile($file, basename($file));
        }
        $zip->close();

        return Response::download(storage_path("tmp/") . $filename);
    }

    public function download($eid){
        $entry = DB::table('entries')->where('id', '=', $eid)->first();
        $form = DB::table('forms')->where('id', '=', $entry->FK_FORM)->first();

        return Response::download(storage_path("data/$form->form_hash/") . $entry->file_path);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        return view('forms.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return void
     */
    public function store(Request $request){
        $form_name = $request->input('form_name');
        $form_description = $request->input('form_description');
        $form_hash = sha1(microtime());

        DB::table('forms')->insert([
            'form_name' => $form_name,
            'form_description' => $form_description,
            'form_hash' => $form_hash,
        ]);

        return redirect()->back()->with('message', 'Formular wurde erstellt.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $gid
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($fid){
        $forms = DB::table('forms')->where('id', '=', $fid)->first();

        return view('forms.edit', ['forms' => $forms]);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $gid
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $gid){
        $form_name = $request->input('form_name');
        $form_description = $request->input('form_description');

        DB::table('forms')->where('id', '=', $gid)->update([
            'form_name' => $form_name,
            'form_description' => $form_description,
        ]);

        return redirect()->back()->with('message', 'Formular wurde aktualisiert.');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param $gid
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($fid){
        DB::table('forms')->where('id', '=', $fid)->delete();

        return redirect()->back()->with('message', 'Formular erfolgreich gelöscht.');
    }

    public function destroyEntry($eid){
        $entry = DB::table('entries')->where('id', '=', $eid)->first();
        DB::table('entries')->where('id', '=', $eid)->delete();
        $form = DB::table('forms')->where('id', '=', $entry->FK_FORM)->first();

        File::delete(storage_path("data/$form->form_hash/" . $entry->file_path  ));

        return redirect()->back()->with('message', 'Eintrag erfolgreich gelöscht.');
    }
}
