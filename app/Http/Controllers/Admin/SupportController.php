<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Support;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    // Modelo Laravel via injeção de dependência - Cria o objeto e injeta no variável (parâmetro)
    public function index(Support $support) {

        $supports = $support->all();

        // 1º Forma
        // $support = new Support();
        // $supports = $support->all();
        // dd($supports);

        // Alternativa
        // $supports = Support::all();

        // Compact cria um array contendo variáveis e seus valores
        return view('admin/supports/index', compact('supports'));

        // Alternativa
        // return view('admin/supports/index', [
        //     'supports' => $supports
        // ]);
    }

    public function create() {
        return view('admin/supports/create');
    }

    public function store(Request $request) {
        dd($request->all());
    }
}
