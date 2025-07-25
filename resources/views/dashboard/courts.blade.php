<x-dashboard-layout>
    <div class="container-fluid py-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <h2 class="fw-bold" style="color: var(--bs-dark);">
                    <i class="fas fa-basketball-ball me-2"></i>Manage Badminton Courts
                </h2>
                <p class="text-muted">Admin dashboard to manage badminton courts</p>
            </div>
            <div class="col-md-4 d-flex align-items-center justify-content-md-end">
                <a class="btn btn-primary-custom" href="/dashboard/courts/create">
                    <i class="fas fa-plus me-2"></i>Add Court
                </a>
            </div>
        </div>

        @if (session('add-court'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('add-court') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('delete-court'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('delete-court') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('update-court'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('update-court') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card card-custom mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Court Name</th>
                                <th>Price</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courts as $court)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="{{ Str::substr($court->image_url, 0, 12) === 'court_images' ? '/storage/' . $court->image_url : $court->image_url }}"
                                                class="court-img me-3">
                                            <span class="fw-medium">{{ $court->name }}</span>
                                        </div>
                                    </td>
                                    <td>Rp {{ number_format($court->price, 0, ',', '.') }} / 3 hours</td>
                                    <td>
                                        <a class="action-btn edit" title="Edit"
                                            href="/dashboard/courts/{{ $court->id }}/edit"><i
                                                class="fas fa-edit"></i></a>
                                        <form action="/dashboard/courts/{{ $court->id }}" method="post"
                                            onsubmit="return confirm('Yakin ingin menghapus data ini?')"
                                            class="action-btn delete">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="action-btn delete border-0" title="Delete">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</x-dashboard-layout>
