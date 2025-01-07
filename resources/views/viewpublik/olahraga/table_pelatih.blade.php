<!-- Tampilan Card -->
<div id="card-view" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4" style="display: {{ $activeView == 'card' ? 'flex' : 'none' }}">
    @foreach ($coaches as $coach)
        <div class="col-md-3">
            <div class="card coach-card">
                <img src="{{ $coach->photo ? asset($coach->photo) : 'https://via.placeholder.com/300x200' }}"
                    alt="{{ $coach->name }}" class="coach-photo">
                <div class="coach-details text-center p-3">
                    <h5 class="text-dark">{{ $coach->name }}</h5>
                    <p class="text-muted">Cabang: {{ $coach->SportCategory->sport_category }}</p>
                    <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                    data-target="#coachDetailModal{{ $coach->id }}">Detail</a>
                </div>
            </div>
        </div>
    @endforeach
</div>

<!-- Tampilan Tabel -->
<div id="table-view" class="table-responsive rounded" style="display: {{ $activeView == 'table' ? 'block' : 'none' }}">
    <table class="table table-bordered table-striped" style="min-width: 845px;">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelatih</th>
                <th>Cabang Olahraga</th>
                <th>Foto</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @php
                $no = ($coaches->currentPage() - 1) * $coaches->perPage() + 1;
            @endphp
            @foreach ($coaches as $index => $coach)
                <tr>
                    <td>{{ $no++ }}</td>
                    <td>{{ $coach->name }}</td>
                    <td>{{ $coach->SportCategory->sport_category }}</td>
                    <td>
                        <img src="{{ $coach->photo ? asset($coach->photo) : 'https://via.placeholder.com/100x100' }}"
                            alt="{{ $coach->name }}" class="img-thumbnail" width="100">
                    </td>
                    <td>
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                            data-target="#coachDetailModal{{ $coach->id }}">Detail</a>

                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<!-- Pagination -->
<div class="mt-4">
    {{ $coaches->links('layouts.pagination') }}
</div>