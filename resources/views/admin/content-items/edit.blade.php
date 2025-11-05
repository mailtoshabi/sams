@extends('admin.layouts.master')
@section('title') {{ __('Edit Content') }} @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
@endsection

@section('content')

@component('admin.dir_components.breadcrumb')
    @slot('li_1') Content Management @endslot
    @slot('li_2') Contents @endslot
    @slot('title') {{ 'Edit Content' }} @endslot
@endcomponent

<div class="container mt-4">
    <h3 class="mb-4">{{ $default_category->name }}</h3>

    <form action="{{ route('admin.content-items.update', $contentItem->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        @include('admin.content-items._form', [
            'default_category' => $default_category,
            'contentItem' => $contentItem
        ])

        <div class="mt-3">
            <button class="btn btn-success">
                <i class="bi bi-save"></i> Update
            </button>
            <a href="{{ route('admin.content-items.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@endsection
