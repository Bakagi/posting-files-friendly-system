<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Log;

class AppController extends Controller
{
    public function index()
    {
        return view('app');
    }

    public function load()
    {
        $response = [];
        foreach (File::all() as $file)
        {
            $response[] = [
                'id' => $file->id,
                'filename' => $file->filename,
            ];
        }
        return response()->json($response);

    }

    public function create(Request $request)
    {
        $file = new File();
        $uploaded = $request->file('file');

        if ($uploaded instanceof UploadedFile) {
            $file->filename = $uploaded->getClientOriginalName();
            $file->mime_type = $uploaded->getClientMimeType();
            $file->file = $uploaded->get();
            $file->save();

            return response()->json(['success' => true]);
        }

        throw new \Exception('Failed');
    }
   

    public function read(File $file)
    {
         return response($file->file)
            ->header('Cache-Control', 'no-cache private')
            ->header('Content-Disposition', 'File Transfer')
            ->header('Content-Type', $file->mime_type)
            ->header('Content-length', strlen($file->file))
            ->header('Content-Disposition', 'attachment; filename=' . $file->filename )
            ->header('Content-Transfer-Encoding', 'binary');


            
    }

    public function update(Request $request, File $file)
    {
        $uploaded = $request->file('file');

       if ($uploaded instanceof UploadedFile) {
        $file->filename = $uploaded->getClientOriginalName();
        $file->mime_type = $uploaded->getClientMimeType();
        $file->file = $uploaded->get();
        $file->save();

        return response()->json([ 'success' => true ]);
       }

       throw new \Exception('Invalid file');
    }

    public function destroy(File $file)
    {
        $file->delete();
        return response()->json([ 'success' => true ]);
    }
}
