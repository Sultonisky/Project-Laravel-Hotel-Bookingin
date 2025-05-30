@extends('backend.layouts.app')
@section('title', 'List Category')
@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('backend.categories.create') }}" class="btn btn-success">Add Category</a>
    </div>

    <hr />
    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif
    <table class="table table-hover">
        <thead class="table-success">
            <tr>
                <th>No.</th>
                <th>Category Name</th>
                {{-- <th>Price</th>
                <th>Product Code</th>
                <th>Description</th>
                 --}}
                <th>Action</th>
            </tr>
        </thead>
        <tbody>+
            @if ($categories->count() > 0)
                @foreach ($categories as $category)
                    <tr>
                        <td class="align-middle">{{ $loop->iteration }}</td>
                        <td class="align-middle">{{ $category->name }}</td>
                        {{-- <td class="align-middle">{{ $categories->price }}</td>
                        <td class="align-middle">{{ $rs->product_code }}</td>
                        <td class="align-middle">{{ $rs->description }}</td> --}}
                        <td class="align-middle">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a href="{{ route('backend.categories.show', $category->id) }}" type="button"
                                    class="btn btn-secondary">Detail</a>
                                <a href="{{ route('backend.categories.edit', $category->id) }}" type="button"
                                    class="btn btn-warning">Edit</a>
                                <form action="{{ route('backend.categories.destroy', $category->id) }}" method="POST"
                                    type="button" class="btn btn-danger p-0" onsubmit="return confirm('Delete?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger m-0">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Category not found</td>
                </tr>

            @endif
        </tbody>
    </table>
@endsection
