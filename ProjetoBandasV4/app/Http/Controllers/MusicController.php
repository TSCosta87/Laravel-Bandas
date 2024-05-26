<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class MusicController extends Controller
{
    /**
     * Método que devolve dados de bandas albuns e musicas para blade 'add-music' dados usados para apresentar no select-form
     * @param Request $request
     * @return
     */
    public function showAddMusicForm(Request $request)
    {
        $bands = DB::table('bands')->get();
        $albums = [];
        $musics = [];

        $selectedBand = $request->input('band_id');
        $selectedAlbum = $request->input('album_id');

        if ($selectedBand) {
            $albums = DB::table('albuns')->where('band_id', $selectedBand)->get();
        }

        if ($selectedAlbum) {
            $musics = DB::table('musics')->where('album_id', $selectedAlbum)->get();
        }

        return view('music.add-music', compact('bands', 'albums', 'musics', 'selectedBand', 'selectedAlbum'));
    }

    /**
     * Método para adicionar novas musicas
     * @param Request $request - recebe o dados da musica e o album a que pertence
     * @return - mensagem
     */
    public function storeMusic(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'album_id' => 'required|integer',
        ]);

        DB::table('musics')->insert([
            'name' => $request->name,
            'album_id' => $request->album_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('music.add-music')->with('message', 'Music Successfully Added');
    }

    /**
     * Método que perquisa bandas
     * @param Request $request palavra chave a procurar
     * @return - resultado de pesquisa
     */
    public function searchBands(Request $request)
    {
        $search = $request->query('q');
        $bands = DB::table('bands')
            ->where('name', 'LIKE', "%{$search}%")
            ->get();

        return response()->json($bands);
    }

    /**
     * Método que pesquisa albuns
     * @param Request $request - recebe a palavra chave a pesquisar e o id da banda em questão
     * @return - albuns resultantes da pesquisa
     */
    public function searchAlbums(Request $request)
    {
        $bandId = $request->query('band_id');
        $search = $request->query('q');
        $albums = DB::table('albuns')
            ->where('band_id', $bandId)
            ->where('name', 'LIKE', "%{$search}%")
            ->get();

        return response()->json($albums);
    }


    /**
     * Método para criar nova musica
     * @param Request $request - dados da musica e o id do album a que pertencem
     * @return - mensagem
     */
    public function createMusic(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'album_id' => 'required|integer',
        ]);

        DB::table('musics')->insert([
            'name' => $request->name,
            'album_id' => $request->album_id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('album.detail', ['id' => $request->album_id])->with('message', 'Music Successfully Added');
    }

    /**Método que atualiza dados da musica
     * @param Request $request - recebe dados a atualiza
     * @param $id - recebe id da musica
     * @return - mensagem
     */
    public function updateMusic(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        DB::table('musics')
            ->where('id', $id)
            ->update([
                'name' => $request->name,
                'updated_at' => now(),
            ]);

        return redirect()->route('album.detail', ['id' => $request->album_id])->with('message', 'Music Successfully Updated');
    }

    /**
     * Método que apaga musica
     * @param $id - id da musica a apagar
     * @return - mensagem
     */
    public function deleteMusic($id)
    {
        DB::table('musics')->where('id', $id)->delete();
        return redirect()->back()->with('message', 'Music deleted successfully.');
    }
}
