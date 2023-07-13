<h1>Nova Dúvida</h1>

<form action="{{ route('supports.store') }}" method="POST">
    {{-- <input type="hidden" name="_token" id="" value="{{ csrf_token() }}"> --}}
    {{-- Uso por meio de diretiva - Token de validação da requisição --}}
    @csrf()

    <input type="text" placeholder="Assunto" name="subject">
    <textarea name="body" cols="30" rows="5" placeholder="Descrição"></textarea>
    <button type="submit">Enviar</button>
</form>