<?php

namespace App\Http\Controllers;
/** @author marco 
*   Questo controller serve per la gestione delle immagini nei tag <img src="" ...> 
*/


use Illuminate\Http\Request;

class StorageFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /** @author Marco
     * Questa funzione serve per ottenere il file da passare alla src
     * @param filename è il nome del file (ad esempio il nome dell'immagine)
     * sto seguendo questa guida: https://devnote.in/how-to-display-the-storage-folder-image-in-laravel/
     */

    public function displayImage($filename) { 
        $path = storage_public('images/' . $filename);
    
        if (!File::exists($path)) {
            abort(404);
        }
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    }

   /*  public function getPubliclyStorgeFile($filename)
    {
        /* $path = storage_path('app/public/image/'. $filename); */
       /*  $path = storage_path('app/public/image/'. $filename); */

        /* Se il file non esiste in nel percorso indicato da path */
        /* if (!File::exists($path)) 
        {
            abort(404); // Errore 404
        } */

        /* mmmmm */
       /*  $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    } */ // fine funzione 	getPubliclyStorgeFile */

  /*   public function displayImage($filename) { 
    $path = storage_public('images/' . $filename);

    if (!File::exists($path)) {
        abort(404);
    }
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
} */
}
