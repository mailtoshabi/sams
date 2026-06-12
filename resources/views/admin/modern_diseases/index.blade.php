@extends('admin.layouts.master')
@section('title', 'Modern Disease Links')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Modern Disease Links</h3>
        <a href="{{ route('admin.modern_diseases.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-circle"></i> Link Division & Disease
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('admin.modern_diseases.index') }}" class="row g-2 mb-4">
        <div class="col-md-4">
            <input type="text" name="search" class="form-control" placeholder="Search by Division or Disease name"
                   value="{{ request('search') }}">
        </div>

        <div class="col-md-3">
            <button type="submit" class="btn btn-outline-primary">
                <i class="bi bi-search"></i> Filter
            </button>
            <a href="{{ route('admin.modern_diseases.index') }}" class="btn btn-outline-secondary">
                <i class="bi bi-arrow-repeat"></i> Reset
            </a>
        </div>
    </form>

     <div class="table-responsive">
          <table class="table table-bordered align-middle">
              <thead class="table-light">
                  <tr>
                      <th width="80">#</th>
                      <th>Division Name</th>
                      <th>Disease Name</th>
                      <th>Linked Medicines</th>
                      <th>Linked Procedures</th>
                      <th>Linked Date</th>
                      <th class="text-center" width="180">Actions</th>
                  </tr>
              </thead>
              <tbody>
                  @forelse($modernDiseases as $link)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>
                              <strong>{{ $link->division?->name ?? 'No Division' }}</strong><br>
                              <small class="text-muted">{{ $link->division?->slug }}</small>
                          </td>
                          <td>
                              <strong>{{ $link->disease?->name ?? 'No Disease' }}</strong><br>
                              <small class="text-muted">{{ $link->disease?->slug }}</small>
                          </td>
                          <td>
                              @if($link->medicines->count() > 0)
                                  @foreach($link->medicines->take(5) as $med)
                                      <span class="badge bg-info me-1 mb-1">{{ $med->name }}</span>
                                  @endforeach
                                  @if($link->medicines->count() > 5)
                                      <span class="badge bg-secondary me-1 mb-1">+{{ $link->medicines->count() - 5 }} more</span>
                                  @endif
                              @else
                                  <span class="text-muted small">None linked</span>
                              @endif
                          </td>
                          <td>
                              @if($link->proceedures->count() > 0)
                                  @foreach($link->proceedures->take(5) as $proc)
                                      <span class="badge bg-success me-1 mb-1" title="{{ $proc->pivot->description ?? 'No description' }}">{{ $proc->name }}</span>
                                  @endforeach
                                  @if($link->proceedures->count() > 5)
                                      <span class="badge bg-secondary me-1 mb-1">+{{ $link->proceedures->count() - 5 }} more</span>
                                  @endif
                              @else
                                  <span class="text-muted small">None linked</span>
                              @endif
                          </td>
                          <td>{{ $link->created_at ? $link->created_at->diffForHumans() : 'N/A' }}</td>
                          <td class="text-center">
                              <a href="{{ route('admin.modern_diseases.show', $link->id) }}" class="btn btn-sm btn-info" title="View Details">
                                  <i class="bi bi-eye"></i>
                              </a>
                              <a href="{{ route('admin.modern_diseases.edit', $link->id) }}" class="btn btn-sm btn-warning" title="Edit">
                                  <i class="bi bi-pencil"></i>
                              </a>
                              <form action="{{ route('admin.modern_diseases.destroy', $link->id) }}" method="POST" class="d-inline">
                                  @csrf @method('DELETE')
                                  <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Remove this link?')" title="Delete">
                                      <i class="bi bi-trash"></i>
                                  </button>
                              </form>
                          </td>
                      </tr>
                  @empty
                      <tr><td colspan="7" class="text-center text-muted">No links found</td></tr>
                  @endforelse
            </tbody>
        </table>
    </div>

    {{ $modernDiseases->links() }}
</div>
@endsection
