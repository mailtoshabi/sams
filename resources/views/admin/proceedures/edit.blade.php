@extends('admin.layouts.master')
@section('title', 'Edit Proceedure')
@section('css')
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Edit Proceedure: {{ $proceedure->name }}</h3>

    <form action="{{ route('admin.proceedures.update', $proceedure->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        @include('admin.proceedures._form')

        <div class="mt-3">
            <button type="submit" class="btn btn-success"><i class="bi bi-save"></i> Update</button>
            <a href="{{ route('admin.proceedures.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>
@endsection

@section('script')
    <script src="{{ URL::asset('assets/libs/select2/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/ecommerce-select2.init.js') }}"></script>
@endsection
