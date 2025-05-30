@extends('backend.layouts.app')
@section('title', 'Create Claim')
@section('contents')

    <h4>Claim Item</h4>
    <hr />

    <form action="{{ route('backend.claims.store') }}" method="POST">
        @csrf
        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Item</label>
                <select name="item_id" class="form-control">
                    <option value="" selected disabled>-- Select Item --</option>
                    @foreach ($items as $item)
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endforeach
                </select>
                @error('item_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col">
                <label class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="pending">Pending</option>
                    <option value="approved">Approved</option>
                    <option value="rejected">Rejected</option>
                </select>
                @error('status')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <div class="row mb-3">
            <div class="col">
                <label class="form-label">Your Name (optional)</label>
                <input type="text" name="claimed_by_name" class="form-control" placeholder="Your name (optional)">
            </div>
        </div>

        <div class="row">
            <div class="d-grid">
                <button type="submit" class="btn btn-success">Submit Claim</button>
            </div>
        </div>
    </form>

@endsection
