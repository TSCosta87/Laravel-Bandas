<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class AlbumController extends Controller
{
    /**
     * Método para criar e atualizar um album
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createAlbum(Request $request)
    {
        $photo = $request->hasFile('photo') ? Storage::putFile('bandPhotos/', $request->photo) : null;

        $request->validate([
            'name' => 'required|string|max:255',
            'release_date' => 'required|date',
            'band_id' => 'required|integer',
        ]);

        if ($request->id) {
            DB::table('albuns')
                ->where('id', $request->id)
                ->update([
                    'name' => $request->name,
                    'photo' => $photo,
                    'release_date' => $request->release_date,
                    'band_id' => $request->band_id,
                ]);
        } else {
            DB::table('albuns')
                ->insert([
                    'name' => $request->name,
                    'photo' => $photo,
                    'release_date' => $request->release_date,
                    'band_id' => $request->band_id,
                ]);
        }

        return redirect()->back()->with('message', 'Album Successfully Saved');
    }

    /**
     * Método que pequisa os detalhes de um album
     * @param $id - é o id do album
     * @return - devolve os detalhes do album, o nome da respectiva banda e as musicas do respetivo album
     */
    public function detailAlbum($id)
    {
        $albums = DB::table('albuns')
            ->join('bands', 'albuns.band_id', '=', 'bands.id')
            ->select('albuns.*', 'bands.name as band_name')
            ->where('albuns.id', $id)
            ->first();

        $musics = DB::table('musics')
            ->where('album_id', $id)
            ->get();

        return view('albuns.album-detail', compact('albums', 'musics'));
    }

    public function deleteAlbum($id)
    {
        DB::table('musics')->where('album_id', $id)->delete();
        DB::table('albuns')->where('id', $id)->delete();
        return redirect()->back()->with('message', 'Album and musicas deleted successfully.');
    }

    /**
     * Método que pesquisa as bandas para apresentar no select form
     * @return - devolve as bandas para o select-form
     */
    public function showAddAlbumForm()
    {
        $bands = DB::table('bands')->get();
        return view('albuns.add-album', compact('bands'));
    }

    /**
     * Método para cria album da blade add-album
     * @param Request $request recebe detalhes do novo album e a banda correspondente
     * @return
     */
    public function storeAlbum(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'release_date' => 'required|date',
            'band_id' => 'required|integer',
        ]);

        DB::table('albuns')->insert([
            'name' => $request->name,
            'release_date' => $request->release_date,
            'band_id' => $request->band_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('album.add')->with('message', 'Album Successfully Added');
    }
}
