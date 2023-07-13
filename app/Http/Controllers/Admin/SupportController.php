<?php

namespace App\Http\Controllers\Admin;

use App\DTO\CreateSupportDTO;
use App\DTO\UpdateSupportDTO;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateSupport;
use App\Models\Support;
use App\Services\SupportService;
use Illuminate\Http\Request;

class SupportController extends Controller
{
    public function __construct(protected SupportService $service) {

    }

    // READ
    // Modelo Laravel via injeção de dependência - Cria o objeto e injeta no variável (parâmetro)
    public function index(Request $request) {
        $supports = $this->service->getAll($request->filter);

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

    public function show(string | int $id) {
        // Métodos para recuperar os dados
        // Support::find($id);
        // Podemos declarar o critério de comparação '=', se ficar vazio considera igual
        // first indica a recuperação apenas do primeiro resultado
        // Support:where('id, '=' $id)->first();
        if (!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('admin/supports/show', compact('support'));
    }

    // CREATE
    public function create() {
        return view('admin/supports/create');
    }

    public function store(StoreUpdateSupport $request) {
        $this->service->new(CreateSupportDTO::makeFromRequest($request));

        return redirect()->route('supports.index');
    }

    // UPDATE
    public function edit(string $id) {
        // if (!$support = $support->where('id', $id)->first()) {
        if (!$support = $this->service->findOne($id)) {
            return back();
        }

        return view('admin/supports/edit', compact('support'));
    }

    public function update(StoreUpdateSupport $request, Support $support, string $id) {
        $support = $this->service->update(UpdateSupportDTO::makeFromRequest($request));

        // Recuperamos o objeto do suporte que queremos editar
        if (!$support) {
            return back();
        }

        return redirect()->route('supports.index');
        // Chamamos o método update passando os dados que desejamos editar
        // $support->update($request->validated());

        // Alternatica - Mais verbora
        // $support->subject = $request->subject;
        // $support->body = $request->body;
        // $support->save();
    }

    // DELETE
    public function destroy(string $id) {
        $this->service->delete($id);
        
        return redirect()->route('supports.index');
    }
}
