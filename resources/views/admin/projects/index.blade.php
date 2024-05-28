@extends('layouts.admin')



@section('title')
 - Projects
@endsection



@section('content')

  <h1 class="text-center mb-5">Projects</h1>

  <div class="container">

  @if ($errors->any())
    <div class="alert alert-danger" role="alert">
      <ul class="m-0">
        @foreach ($errors->all() as $error)
          <li>{{$error}}</li>
        @endforeach
      </ul>
    </div>
  @endif

  @if (session('error'))
    <div class="alert alert-danger" role="alert">
      {{session('error')}}
    </div>
  @endif

  @if (session('success'))
    <div class="alert alert-success" role="alert">
      {{session('success')}}
    </div>
  @endif

    <table class="table crud-table">
      <thead>
        <tr>
          <th scope="col"><a class="text-black text-decoration-none" href="{{route('admin.order-by', ['col' => 'id', 'dir' => $dir])}}">ID</a></th>
          <th scope="col"><a class="text-black text-decoration-none" href="{{route('admin.order-by', ['col' => 'name', 'dir' => $dir])}}">Name</a></th>
          <th scope="col"><a class="text-black text-decoration-none" href="{{route('admin.order-by', ['col' => 'creator', 'dir' => $dir])}}">Creator</a></th>
          <th scope="col"><a class="text-black text-decoration-none" href="{{route('admin.order-by', ['col' => 'objective', 'dir' => $dir])}}">Objective</a></th>
          <th scope="col">Type</th>
          <th scope="col">Description</th>
          <th scope="col" class="text-center">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <form class="d-inline-block" action="{{route('admin.projects.store')}}" method="POST">
            @csrf
            <td><strong>#</strong></td>
            <td><input class="w-100 add-project" type="text" placeholder="Aggiungi nome" name="name" value="{{old('name')}}"></td>
            <td><input class="w-100 add-project" type="text" placeholder="Aggiungi creatore" name="creator" value="{{old('creator')}}"></td>
            <td><input class="w-100 add-project" type="text" placeholder="Aggiungi obiettivo" name="objective" value="{{old('objective')}}"></td>
            <td>
              <select style="-webkit-appearance: none; -moz-appearance: none;" class="select-empty" onchange="this.value === 'empty' ? this.className = 'select-empty' : this.className = 'text-black'" name="type_id">
                <option class="text-black" value="empty">Seleziona tipo</option>
                @foreach ($types as $type)
                  <option class="text-black" value="{{$type->id}}" @if($type->id == old('type_id')) selected @endif>{{$type->name}}</option>
                @endforeach
              </select>
            </td>
            <td><input class="w-100 add-project" type="text" placeholder="Aggiungi descrizione" name="description" value="{{old('description')}}"></td>
            <td class="text-center">
              <button type="submit" class="btn btn-success"><i class="fa-solid fa-plus"></i></button>
              <a href="{{route('admin.projects.create')}}" class="btn btn-primary"><i class="fa-solid fa-file-circle-plus"></i></a>
              <button onclick="formReset()" type="reset" class="btn btn-danger"><i class="fa-solid fa-rotate-right"></i></button>
            </td>
          </form>
        </tr>
        @forelse ($projects as $item)
        <tr>
          <td>{{$item->id}}</td>
          <td>{{$item->name}}</td>
          <td>{{$item->creator}}</td>
          <td>{{$item->objective}}</td>
          <td>{{$item->type?->name ? $item->type->name : '---'}}</td>
          <td class="w-25">{{$item->description}}</td>
          <td class="text-center w-25">
            <a href="{{route('admin.projects.show', $item)}}" class="btn btn-info"><i class="fa-solid fa-eye"></i></a>
            <a href="{{route('admin.projects.edit', $item)}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
            <form onsubmit="return confirm('Sei sicuro di voler eliminare {{$item->name}} ?')" action="{{route('admin.projects.destroy', $item)}}" method="POST" class="d-inline-block">
              @csrf
              @method('DELETE')
              <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></button>
            </form>
          </td>
        </tr>
        @empty
        <tr>
          <td colspan="7" class="text-center"><h6 class="my-2">Tabella vuota</h6></td>
        </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  @include('admin.partials.form-reset')

@endsection
