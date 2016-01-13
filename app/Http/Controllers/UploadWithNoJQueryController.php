<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;
use Redirect;
use Session;

class UploadWithNoJQueryController extends Controller
{

    // 싱글 이미지 처리
    public function upload(Request $request)
    {
        // getting all of the post data
        $file = array('image' => Input::file('image'));
        // setting up rules
        $rules = array('image' => 'required',); //mimes:jpeg,bmp,png and for max size max:10000
        // doing the validation, passing post data, rules and the messages
        $validator = Validator::make($file, $rules);
        if ($validator->fails()) {
            // send back to the page with the input data and errors
            return Redirect::to('upload')->withInput()->withErrors($validator);
        } else {
            // checking file is valid.
            if (Input::file('image')->isValid()) {
                $destinationPath = 'uploads'; // upload path
                $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
                Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message
//                Session::flash('success', 'Upload successfully');
//                $request->session()->flash('success', 'Task was successful!');


//                $request->session()->flash('success', 'Upload successfully');

                if($request->ajax()){
                    return Response::json(['success' => true, "message" => "Saved Success"]);
                } else {
                    return Redirect::to('upload');
                }

            } else {
                // sending back with error message.
                if($request->ajax()){
                    return Response::json(['success' => false, "error" => "uploaded file is not valid"]);
                } else {
                    Session::flash('error', 'uploaded file is not valid');
                    return Redirect::to('upload');
                }

            }
        }

    }

    // 다수 이미지 처리
    public function multiple_upload()
    {
        // getting all of the post data
        $files = Input::file('images');
        // Making counting of uploaded images
        $file_count = count($files);
        // start count how many uploaded
        $uploadcount = 0;
        foreach ($files as $file) {
            $rules = array('file' => 'required'); //'required|mimes:png,gif,jpeg,txt,pdf,doc'
            $validator = Validator::make(array('file' => $file), $rules);
            if ($validator->passes()) {
                $destinationPath = 'uploads';
                $filename = $file->getClientOriginalName();
                $upload_success = $file->move($destinationPath, $filename);
                $uploadcount++;
            }
        }
        if ($uploadcount == $file_count) {
            Session::flash('success', 'Upload successfully');
            return Redirect::to('multiple_upload');
        } else {
            return Redirect::to('multiple_upload')->withInput()->withErrors($validator);
        }
    }
}
