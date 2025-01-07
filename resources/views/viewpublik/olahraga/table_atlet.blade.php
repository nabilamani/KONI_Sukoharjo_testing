<div id="data-wrapper">
    <!-- Tampilan Card -->
    <div id="card-view" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4"
        style="display: {{ $activeView == 'card' ? 'flex' : 'none' }}">
        @forelse ($athletes as $athlete)
            <div class="col-md-3">
                <div class="card athlete-card">
                    <!-- Foto Atlet (Gunakan placeholder jika tidak ada gambar) -->
                    <img src="{{ $athlete->photo ? asset($athlete->photo) : 'https://via.placeholder.com/300x200' }}"
                        alt="{{ $athlete->name }}" class="athlete-photo">
                    <div class="athlete-details text-center p-3">
                        <h5 class="text-dark">{{ $athlete->name }}</h5>
                        <p class="text-muted">Cabang: {{ $athlete->SportCategory->sport_category }}</p>
                        <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                        data-target="#athleteDetailModal{{ $athlete->id }}">Detail</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-dark text-center p-4">
                    <div class="d-flex align-items-center justify-content-center mb-2">
                        <i class="mdi mdi-account-alert me-2 fs-4"></i>
                        <strong>Hasil pencarian atau filter tidak ditemukan.</strong>
                    </div>
                    <p class="mt-2">Coba ubah kata kunci pencarian atau pilih kategori olahraga yang berbeda.</p>
                </div>
            </div>
        @endforelse
    </div>

    <!-- Tampilan Tabel -->
    <div id="table-view" class="table-responsive rounded"
        style="display: {{ $activeView == 'table' ? 'block' : 'none' }}">
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Atlet</th>
                    <th>Cabang Olahraga</th>
                    <th>Foto</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = ($athletes->currentPage() - 1) * $athletes->perPage() + 1;
                @endphp
                @forelse ($athletes as $index => $athlete)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $athlete->name }}</td>
                        <td>{{ $athlete->SportCategory->sport_category }}</td>
                        <td>
                            <img src="{{ $athlete->photo ? asset($athlete->photo) : 'https://via.placeholder.com/100x100' }}"
                                alt="{{ $athlete->name }}" class="img-thumbnail" width="100">
                        </td>
                        <td>
                            <a href="#" class="btn btn-primary btn-sm" data-toggle="modal"
                                data-target="#athleteDetailModal{{ $athlete->id }}">Detail</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center">
                            <div class="d-flex justify-content-center align-items-center my-2">
                                <i class="mdi mdi-alert-circle-outline me-2" style="font-size: 20px;"></i>
                                <span class="fs-8">Tidak ada data atlet yang sesuai dengan pencarian atau filter Anda.</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- Pagination -->
    <div class="mt-4">
        {{ $athletes->links('layouts.pagination') }}
    </div>
</div>
