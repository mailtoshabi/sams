@extends('admin.layouts.master')
@section('title', 'Classical Disease Link Details')

@section('content')
<div class="container mt-4">
    @component('admin.dir_components.breadcrumb')
    @slot('li_1') Classical Diseases @endslot
    @slot('li_2') Link Details @endslot
    @slot('title') Classical Disease Link Details @endslot
    @endcomponent

    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="card-title mb-0">Link Details</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <h6>Division</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Name</th>
                            <td>{{ $classicalDisease->division?->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Ayurveda Name</th>
                            <td>{{ $classicalDisease->division?->ayurveda_name ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6 mb-3">
                    <h6>Chapter</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Name</th>
                            <td>{{ $classicalDisease->chapter?->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Ayurveda Name</th>
                            <td>{{ $classicalDisease->chapter?->ayurveda_name ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6 mb-3">
                    <h6>Medicine Type</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Name</th>
                            <td>{{ $classicalDisease->medicineType?->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Ayurveda Name</th>
                            <td>{{ $classicalDisease->medicineType?->ayurveda_name ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-6 mb-3">
                    <h6>Formulation</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="30%">Name</th>
                            <td>{{ $classicalDisease->formulation?->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Ayurveda Name</th>
                            <td>{{ $classicalDisease->formulation?->ayurveda_name ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>

                <div class="col-md-12 mb-3">
                    <h6>Medicine</h6>
                    <table class="table table-bordered">
                        <tr>
                            <th width="15%">Name</th>
                            <td>{{ $classicalDisease->medicine?->name ?? 'N/A' }}</td>
                        </tr>
                        <tr>
                            <th>Ayurveda Name</th>
                            <td>{{ $classicalDisease->medicine?->ayurveda_name ?? 'N/A' }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('admin.classical_diseases.edit', $classicalDisease->id) }}" class="btn btn-warning">
                    <i class="bi bi-pencil"></i> Edit Link
                </a>
                <a href="{{ route('admin.classical_diseases.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
