<h1>Nova Dúvida</h1>

{{-- Apresentação de erros --}}
@if ($errors->any())
    @foreach($errors->all() as $error)
        {{ $error }}
    @endforeach()
@endif()

<form action="{{ route('supports.store') }}" method="POST">
    {{-- <input type="hidden" name="_token" id="" value="{{ csrf_token() }}"> --}}
    {{-- Uso por meio de diretiva - Token de validação da requisição --}}
    @csrf()

    {{-- O helper "old" irá persistir o valor do campo após a validação --}}
    <input type="text" placeholder="Assunto" name="subject" value="{{ old('subject') }}">
    <textarea name="body" cols="30" rows="5" placeholder="Descrição">{{ old('body') }}</textarea>
    <button type="submit">Enviar</button>
</form>