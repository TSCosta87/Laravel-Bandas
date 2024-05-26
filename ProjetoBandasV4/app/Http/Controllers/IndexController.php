<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class IndexController extends Controller
{
    /**
     * Método da pagina principal onde mostra todas as bandas
     * @return - todas as bandas
     */
    public function home()
    {
        $bands = DB::table('bands')
            ->leftJoin('albuns', 'bands.id', '=', 'albuns.band_id')
            ->select('bands.*', DB::raw('COUNT(albuns.id) as albums_count'))
            ->groupBy('bands.id')
            ->get();

        return view('home.index', compact('bands'));
    }

    /**
     * Método que mostra a página fallback
     * @return - blade fallback
     */
    public function fallback() {
        return view('error.fallback');
    }


    /**
     * Método que devolve os detalhes de uma determinada banda
     * @param $id - id da banda em questão
     * @return - devolve os detalhes da banda e os respetivos albuns
     */
    public function viewBand($id)
    {
        $band = DB::table('bands')->where('id', $id)->first();
        $albums = DB::table('albuns')->where('band_id', $id)->get();
        return view('bands.band-view', compact('band', 'albums'));
    }

    /**
     * Método que devolve os detalhes de um determinado album
     * @param $id - id do album em questão
     * @return - devolve os detalhes do album e as respectivas musicas
     */
    public function viewAlbum($id)
    {
        $album = DB::table('albuns')->where('id', $id)->first();
        $musics = DB::table('musics')->where('album_id', $id)->get();
        return view('albuns.album-view', compact('album', 'musics'));
    }

    /**
     * método que de devolve musicas para a blade do search
     * @param $id - id da musica
     * @return
     */
    public function viewMusic($id)
    {
        $music = DB::table('musics')->where('id', $id)->first();
        if ($music) {
            return $this->viewAlbum($music->album_id);
        }
        return redirect()->route('search')->with('error', 'Music not found');
    }

    /**
     * Método que devolve os resultados para pesquisa para blade search
     * @param Request $request - string a pesquisar
     * @return - bandas, albuns e musicas resultantes da pesquisa
     */
    public function search(Request $request)
    {
        $query = $request->input('query');

        $bands = DB::table('bands')->where('name', 'LIKE', "%{$query}%")->get();
        $albums = DB::table('albuns')->where('name', 'LIKE', "%{$query}%")->get();
        $musics = DB::table('musics')->where('name', 'LIKE', "%{$query}%")->get();

        return view('search-results', compact('bands', 'albums', 'musics', 'query'));
    }
}
