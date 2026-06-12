@extends('admin.layouts.master')
@section('title') {{ __('Link Classical Disease Fields') }} @endsection
@section('css')
    <link href="{{ URL::asset('assets/libs/select2/select2.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('assets/libs/dropzone/dropzone.min.css') }}" rel="stylesheet">
@endsection

@section('content')

    @component('admin.dir_components.breadcrumb')
    @slot('li_1') Classical Diseases @endslot
    @slot('li_2') Link @endslot
    @slot('title') {{ 'Link Classical Disease Fields' }} @endslot
    @endcomponent

    <div class="container mt-4">
        <h3 class="mb-4">Link Classical Disease Fields</h3>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.classical_diseases.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row g-3">
                <div id="dynamic-fields" class="col-12">
                    <div class="row g-3">

                        <!-- Division -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Division</label>
                            <select name="division_id" id="division_id" class="form-select select2-ajax"
                                data-url="{{ route('admin.ajax.divisions') }}" data-placeholder="Search division...">
                                <option value="">Select Division</option>
                                @foreach($divisions as $division)
                                    <option value="{{ $division->id }}" {{ old('division_id') == $division->id ? 'selected' : '' }}>
                                        {{ $division->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Chapter -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Chapter</label>
                            <select name="chapter_id" id="chapter_id" class="form-select select2-ajax"
                                data-url="{{ route('admin.ajax.chapters') }}" data-depends="#division_id"
                                data-placeholder="Search chapter...">
                                <option value="">Select Chapter</option>
                                @foreach($chapters as $chapter)
                                    <option value="{{ $chapter->id }}" {{ old('chapter_id') == $chapter->id ? 'selected' : '' }}>
                                        {{ $chapter->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Medicine Type -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Medicine Type</label>
                            <select name="medicine_type_id" id="medicine_type_id" class="form-select select2-ajax"
                                data-url="{{ route('admin.ajax.medicine_types') }}" data-depends="#division_id"
                                data-placeholder="Search Medicine Type...">
                                <option value="">Select Medicine Type</option>
                                @foreach($medicine_types as $mt)
                                    <option value="{{ $mt->id }}" {{ old('medicine_type_id') == $mt->id ? 'selected' : '' }}>
                                        {{ $mt->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Formulation -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Formulation</label>
                            <select name="formulation_id" id="formulation_id" class="form-select select2-ajax"
                                data-url="{{ route('admin.ajax.formulations') }}" data-placeholder="Search formulation...">
                                <option value="">Select Formulation</option>
                                @foreach($formulations as $formulation)
                                    <option value="{{ $formulation->id }}" {{ old('formulation_id') == $formulation->id ? 'selected' : '' }}>
                                        {{ $formulation->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Medicine -->
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Medicine</label>
                            <select name="medicine_id" id="medicine_id" class="form-select select2-ajax"
                                data-url="{{ route('admin.ajax.medicines', ['require_formulation' => 1]) }}" data-depends="#formulation_id"
                                data-placeholder="Search medicine...">
                                <option value="">Select Medicine</option>
                                @foreach($medicines as $medicine)
                                    <option value="{{ $medicine->id }}" {{ old('medicine_id') == $medicine->id ? 'selected' : '' }}>
                                        {{ $medicine->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                </div>
            </div>

            <div class="mt-4">
                <button class="btn btn-primary">
                    <i class="bi bi-save"></i> Save Link
                </button>
                <a href="{{ route('admin.classical_diseases.index') }}" class="btn btn-secondary">Cancel</a>
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
            document.querySelectorAll('.select2-ajax').forEach(function (el) {
                const url = el.dataset.url;
                const placeholder = el.dataset.placeholder || 'Search...';
                const dependsSelector = el.dataset.depends || null;

                $(el).select2({
                    theme: 'classic',
                    placeholder: placeholder,
                    allowClear: true,
                    width: '100%',
                    minimumInputLength: 1,
                    ajax: {
                        url: url,
                        dataType: 'json',
                        delay: 300,
                        data: function (params) {
                            const query = {
                                q: params.term,
                                page: params.page || 1
                            };
                            if (dependsSelector) {
                                const dep = document.querySelector(dependsSelector);
                                if (dep && dep.value) query.dependency = dep.value;
                            }
                            return query;
                        },
                        processResults: function (data, params) {
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
                }).on('select2:open', function (e) {
                    // Focus the search field when opened
                    setTimeout(() => {
                        const searchField = document.querySelector('.select2-search__field');
                        if (searchField) {
                            searchField.focus();
                        }
                    }, 50);
                });

                // Automatically open Select2 on focus
                $(el).on('focus', function (e) {
                    if (!$(this).data('select2').isOpen()) {
                        $(this).select2('open');
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
