@extends('layouts.admin')



@section('title')
 - Types & Projects
@endsection



@section('content')

<h1 class="text-center mb-5">Types & Projects</h1>


<div class="container">
  <table class="table table-primary table-striped">
    <thead>
      <tr>
        <th scope="col"><h4>Type</h4></th>
        <th class="w-75 text-center" scope="col"><h4>Projects</h4></th>
      </tr>
    </thead>
    <tbody>

      @foreach ($types as $type)
        <tr>
          <td><h5>{{$type->name}}</h5></td>
          <td>
            <ul class="list-group">
              @foreach ($type->projects as $project)
                <li class="list-group-item list-group-item-danger text-center"><a class="text-decoration-none text-black"  href="{{route('admin.projects.show', $project)}}">{{$project->name}}</a></li>
              @endforeach
            </ul>
          </td>
        </tr>
      @endforeach

    </tbody>
  </table>
</div>


@endsection
