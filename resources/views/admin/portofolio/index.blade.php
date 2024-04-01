@extends('admin.layout.main')
@section('main')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">My Portofolio</h1>
  </div>
  @if (session()->has('success'))
  <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
  @endif
  <div class="table-responsive">
      <a class="btn btn-primary mb-3" href="/admin/portofolio/create"> Create New Portofolio</a>
      <table class="table table-hover table-bordered">
        <thead>
          <tr>
            <th scope="col">#</th>
            <th scope="col">Title</th>
            <th scope="col">Git Link</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($portofolio as $item)
          <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $item->title }}</td>
              <td>{{ $item->git_link }}</td>
              
              <td>
                  <a class="badge bg-warning" href="/admin/portofolio/{{ $item->id }}/edit"><i class="bi bi-pencil-square"></i></a>
                  <form action="/admin/portofolio/{{ $item->id }}" method="POST" class="d-inline">
                  @method('delete')
                  @csrf
                  <button class="badge bg-danger border-0" onclick="return confirm('Are you sure?')"><i class="bi bi-x-circle"></i></button>
                  </form>
              </td>
            </tr>
          @endforeach

        </tbody>
      </table>
    </div>
    </div>
@endsection