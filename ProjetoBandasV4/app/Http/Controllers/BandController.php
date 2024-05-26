<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class BandController extends Controller
{
    /**
     * Método que mostra todas as bandas por defeito ou por parametro de pesquisa
     * @return - devolve todas as bandas da bd
     */
    public function allBands()
    {
        $search = request()->query('search', null);
        $bands = $search ?
            DB::table('bands')->where('name', 'LIKE', "%{$search}%")->get() :
            $this->getBands();

        return view('bands.allbands', compact('bands'));
    }

    /**
     * Método que pesquisa todas as bandas da bd
     * @return - bandas
     */
    public function getBands()
    {
        return DB::table('bands')->get();
    }

    /**
     * Método que pesquisa albuns de uma determinada banda
     * @param $id - id da banda
     * @return - todos os albuns da respectiva banda
     */
    public function getAlbums($id)
    {
        return DB::table('albuns')->where('band_id', $id)->get();
    }

    /**
     * Método que cria uma nova banda
     * @param Request $request - recebe detalhes e foto da banda
     * @return - devolve mensagem
     */
    public function createBand(Request $request)
    {
        $photo = $request->hasFile('photo') ? Storage::putFile('bandPhotos/', $request->photo) : null;

        $request->validate([
            'band_name' => 'required|string|max:255',
        ]);

        if ($request->id) {
            DB::table('bands')
                ->where('id', $request->id)
                ->update([
                    'name' => $request->band_name,
                    'photo' => $photo,
                ]);
        } else {
            DB::table('bands')->insert([
                'name' => $request->band_name,
                'photo' => $photo,
            ]);
        }

        return redirect()->route('all.bands')->with('message', 'Band Successfully Saved');
    }

    /**
     * Método que apaga banda
     * @param $id - id da banda a apagar
     * @return  - devolve mensagem
     */
    public function deleteBand($id)
    {
        DB::table('bands')->where('id', $id)->delete();
        return redirect()->back()->with('message', 'Band Successfully Deleted');
    }

    /**
     * Método que devolve os detalhes de uma determinada banda
     * @param $id - id da banda em questão
     * @return  - devolve os detalhes da banda e os respectivos albuns da banda
     */
    public function detailBand($id)
    {
        $band = DB::table('bands')->where('id', $id)->first();
        $albums = $this->getAlbums($id);
        return view('bands.band-detail', compact('band', 'albums'));
    }
}
