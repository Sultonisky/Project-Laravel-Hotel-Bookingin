@extends('backend.layouts.app')
@section('title', 'List of Claims')

@section('contents')
    <div class="d-flex align-items-center justify-content-between">
        <a href="{{ route('backend.claims.create') }}" class="btn btn-success">Add Category</a>
    </div>

    <hr />
    @if (Session::has('success'))
        <div class="alert alert-success" role="alert">
            {{ Session::get('success') }}
        </div>
    @endif

    <table class="table table-hover">
        <thead class="table-success">
            <tr>
                <th>No</th>
                <th>Item</th>
                <th>Claimed By</th>
                <th>Status</th>
                <th>Claim Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>+
            @if ($claims->count() > 0)
                @foreach ($claims as $claim)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $claim->item->name ?? '-' }}</td>
                        <td>{{ $claim->user->name ?? '-' }}</td>
                        <td>{{ ucfirst($claim->status) }}</td>
                        <td>{{ $claim->created_at->format('d M Y') }}</td>
                        <td>
                            <a href="{{ route('backend.claims.show', $claim->id) }}" class="btn btn-sm btn-primary">Detail</a>
                        </td>
                    </tr>
                @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="5">Data not found</td>
                </tr>

            @endif
        </tbody>
    </table>

    {{-- Pagination jika pakai paginate --}}
    <div class="mt-3">
        {{ $claims->links() }}
    </div>
@endsection
