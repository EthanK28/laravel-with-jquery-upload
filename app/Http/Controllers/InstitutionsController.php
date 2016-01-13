<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InstitutionsController extends Controller
{

    /**
     * Store a newly created institution in storage.
     *
     * @return Response
     */
    public function store()
    {
        //$alldata = Input::all();/*   this gets all*/
        $data = Input::only('title', 'body', 'topcolor', 'topfontcolor','currentdi','extracomments');
        $data['logo'] = json_encode(Input::get('fileid'));

        // validation rules
        $rules = array(
            'title'      => 'required',
            'logo' => 'required',
        );
        $validator = Validator::make($data, $rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        // @todo: I need to move the file out of tmp to someplace else.
        Institution::create($data);

        // @todo: route to the "show" of the institution
        return Redirect::route('institutions.index');
    }

    /**
     * Show the form for editing the specified institution.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        $institution = Institution::find($id);
        $fileids = json_decode($institution->logo);

        $files = array();

        foreach ($fileids as $fileid) {
            $upload = Upload::find($fileid);
            if (isset($upload)) {
                $newurl = URL::asset($upload->publicpath() . $upload->filename);

                $success = new stdClass();
                $success->name = $upload->filename;
                $success->size = $upload->size;
                $success->url = $newurl;
                $success->thumbnailUrl = $newurl;
                $success->deleteUrl = action('UploadController@delete', $upload->id);
                $success->deleteType = 'DELETE';
                $success->fileID = $upload->id;
                $files[] = $success;
            }
        }

        $json = json_encode(array('files' => $files));

        return View::make('institutions.edit', compact('institution', 'json'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $institution = Institution::findOrFail($id);

        //get form data
        $data = Input::only('title', 'body', 'topcolor', 'topfontcolor','currentdi','extracomments');
        $data['logo'] = json_encode(Input::get('fileid'));

        // validation rules
        $rules = array(
            'title'      => 'required',
            //'body'     => '',
            //'topfontcolor'  =>'required|between:4,8',
            //'topcolor'  => 'required|between:4,8',
            'logo' => 'required',
            //'currentdi' => '',
            //'extracomments' => '',
        );
        $validator = Validator::make($data, $rules);

        if ($validator->fails())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $institution->update($data);

        return Redirect::to_action('InstitutionsController@show', array($id));
    }

    public function publicpath() {
        return str_replace('/public/', '/', URL::asset($this->path) . '/');
    }

}
