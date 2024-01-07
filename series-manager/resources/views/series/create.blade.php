<x-layout title="Nova Série:">
<form action="/series/save" method="post">
    @csrf
    <div class="mb-3">
        <label class="form-label" for="name">Nome:</label>
        <input class="form-control" type="text" name="name" id="name">
    </div>
    <button class="btn btn-primary">Adicionar</button>
</form>
</x-layout>
