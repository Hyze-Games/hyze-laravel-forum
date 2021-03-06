@extends('layouts.admin')

@section('content')

<div>
    <form class="d-flex flex-column" action="{{ route('admin.categories.store') }}" method="POST">
        @method('POST')
        @csrf
        <div class="form-group row">
            <label for="inputName" class="col-sm-2 col-form-label">Nome</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputName" placeholder="Nome" name="name"
                    value="{{ old('name') }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputSlug" class="col-sm-2 col-form-label">Slug</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputSlug" placeholder="Slug" name="slug"
                    value="{{ old('slug') }}" required>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputSlug" class="col-sm-2 col-form-label">Quem pode ler?</label>
            <div class="col-sm-10">
                <select class="custom-select" name="restrict_read">
                    <option value>Visitantes</option>
                    @foreach ($groups as $group)
                    <option value="{{ $group->key }}">
                        {{ $group->value['display_name'] }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="form-group row">
            <label for="inputSlug" class="col-sm-2 col-form-label">Quem pode escrever?</label>
            <div class="col-sm-10">
                <select class="custom-select" name="restrict_write" required>
                    @foreach ($groups as $group)
                    <option value="{{ $group->key }}">
                        {{ $group->value['display_name'] }}
                    </option>
                    @endforeach
                </select>
            </div>
        </div>

        <div class="ml-auto">
            <a href="{{ route('admin.tree') }}" class="btn btn-secondary">Cancelar</a>
            <button class="btn btn-primary ml-auto" type="submit">Criar</button>
        </div>
    </form>
</div>

@stop