<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Categorie;
use App\Models\Etudiant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Lang;
use Illuminate\Http\Response;

class FileController extends Controller
{

  /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categorie = Categorie::selectCategorie();
        return view('file.create', ['categories'=>$categorie]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Etudiant $etudiant)
    {
        $request->validate([
            'file' => 'required|mimes:doc,zip,pdf|max:2048',
            'name' => 'required:max:255',
        ]);

        $fileName = time().'_'.$request->file->getClientOriginalName();
        $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');

        if ($request->categories_id === '1') {
          $newFile = File::create([
              'file_path' => '/app/public/' . $filePath,
              'name' => $request->name,
              'categories_id' => $request->categories_id,
              'user_id' => Auth::user()->id,
          ]);
        } else {
          $newFile = File::create([
              'file_path' => '/app/public/' . $filePath,
              'name' => $request->name,
              'name_fr' => $request->name,
              'categories_id' => $request->categories_id,
              'user_id' => Auth::user()->id,
          ]);
        }
        return back()
        ->with('success',Lang::get('lang.file_uploaded'))
        ->with('file', $fileName);
      }

      /**
       * Display the specified resource.
       *
       * @param  \App\Models\File  $file
       * @return \Illuminate\Http\Response
       */
      public function show(File $file)
      {
          $fileName = File::selectFileName($file->id);
          return view('file.show', ['file'=> $file ,'fileName' => $fileName]);
      }

      /**
       * Show the form for editing the specified resource.
       *
       * @param  \App\Models\File $file
       * @return \Illuminate\Http\Response
       */
      public function edit(File $file)
      {
          $categorie = Categorie::selectCategorie();
          $fileName = File::selectFileName($file->id);
          $fileSelected = substr($file->file_path, 20);
          return view('file.edit', ['file' => $file,
          'categories'=> $categorie, 'fileName' => $fileName,
          'fileSelected' => $fileSelected ]);
      }

      /**
       * Update the specified resource in storage.
       *
       * @param  \App\Models\File  $file
       * @param  \Illuminate\Http\Request  $request
       * @return \Illuminate\Http\Response
       */
      public function update(Request $request, File $file)
      {
          $request->validate([
              'file' => 'required|mimes:zip,doc,pdf|max:2048',
              'name' => 'required:max:255',
          ]);

          unlink(storage_path($file->file_path));

          $fileName = time().'_'.$request->file->getClientOriginalName();
          $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
  
          if($file->user_id === Auth::user()->id) {
          if ($request->categories_id === '1') {
            $file->update([
                'file_path' => '/app/public/'. $filePath,
                'name' => $request->name,
                'categories_id' => $request->categories_id,
            ]);
          } else {
            $file->update([
                'file_path' => '/app/public/' . $filePath,
                'name_fr' => $request->name,
                'categories_id' => $request->categories_id,
            ]);
          } 
          } else {
            abort(Response::HTTP_UNAUTHORIZED);
          }
          return back()
          ->with('success',Lang::get('lang.file_update_confirmation'))
          ->with('file', $fileName);
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  \App\Models\File  $blogPost
         * @return \Illuminate\Http\Response
         */
        public function destroy(File $file)
        {
            if($file->user_id === Auth::user()->id) {
                $file->delete();
                unlink(storage_path($file->file_path));
            } else {
                abort(Response::HTTP_UNAUTHORIZED);
            }

            return redirect(route('etudiant.show', Auth::user()->id))
            ->with('success',Lang::get('lang.file_delete_confirmation'))
            ->with('file', $file->name);
        }

        /**
         * download file
         * 
         * @param \Illuminate\Http\Request  $request
         *
         * @return \Illuminate\Auth\Access\Response
         */
          public function download(File $file)
            {
              $destination = storage_path('app/public/uploads/');
              $filename = substr($file->file_path, 19);
              $pathToFile = $destination.$filename;
              return response()->download($pathToFile);
            }
          }
