<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class InstitutionsController extends Controller
{
    /**
 * Show the form for editing the specified institution.
 *
 * @param  int  $id
 * @return Response
 */
public function edit($id)
{
    $institution = Institution::find($id);
    $fileids = json_decode($institution->logo);

    $files = array();

    foreach ($fileids as $fileid) {
        $upload = Upload::find($fileid);
        if (isset($upload)){
            $newurl = URL::asset($upload->publicpath().$upload->filename);

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

    $json = json_encode(array('files'=> $files));

    return View::make('institutions.edit', compact('institution','json'));
}
}
