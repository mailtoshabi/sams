@extends('admin.layouts.master')
@section('title') {{ __('Add Content') }} @endsection
@section('css')
<link href="{{ URL::asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
@endsection

@section('content')

@component('admin.dir_components.breadcrumb')
    @slot('li_1') Content Management @endslot
    @slot('li_2') Contents @endslot
    @slot('title') {{ 'Add Content' }} @endslot
@endcomponent

<div class="container mt-4">
    <h3 class="mb-4">{{ $default_category->name }}</h3>

    <form action="{{ route('admin.content-items.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @include('admin.content-items._form', ['default_category'=>$default_category])

        <div class="mt-3">
            <button class="btn btn-primary">
                <i class="bi bi-save"></i> Save
            </button>
            <a href="{{ route('admin.content-items.index') }}" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>

@endsection

@section('script')
<script src="{{ URL::asset('assets/libs/select2/select2.min.js') }}"></script>
<script src="{{ URL::asset('assets/js/pages/ecommerce-select2.init.js') }}"></script>

<script>
    document.addEventListener('DOMContentLoaded', function () {

        // Global select2 init for AJAX selects
        document.querySelectorAll('.select2-ajax').forEach(function(el) {
            const url = el.dataset.url;
            const placeholder = el.dataset.placeholder || 'Search...';
            const dependsSelector = el.dataset.depends || null;

            $(el).select2({
                theme: 'classic', // optional (or remove to use default)
                placeholder: placeholder,
                allowClear: true,
                width: '100%',
                minimumInputLength: 1,
                ajax: {
                    url: url,
                    dataType: 'json',
                    delay: 300,
                    data: function(params) {
                        const query = {
                            q: params.term, // search term
                            page: params.page || 1
                        };
                        // pass dependent select value if exists
                        if (dependsSelector) {
                            const dep = document.querySelector(dependsSelector);
                            if (dep && dep.value) query.dependency = dep.value;
                        }
                        return query;
                    },
                    processResults: function(data, params) {
                        params.page = params.page || 1;
                        return {
                            results: data.results,
                            pagination: {
                                more: data.pagination && data.pagination.more
                            }
                        };
                    },
                    cache: true
                }
            });

            // If this select depends on another, reload when parent changes
            if (dependsSelector) {
                const parent = document.querySelector(dependsSelector);
                if (parent) {
                    parent.addEventListener('change', function () {
                        // clear current selection
                        $(el).val(null).trigger('change');

                        // optionally preload first page results or leave empty
                    });
                }
            }
        });

    });
    </script>
@endsection
