@extends('layouts.admin-main')
@php
    use Carbon\Carbon;
@endphp
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.6.4/example1/colorbox.min.css">
@endsection
@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Halaman {{ $title }}</h4>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <h6 class="card-title mb-0">{{ $title }}</h6>
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                <a class="dropdown-item d-flex align-items-center" href="/admin/mahasiswa/create">
                                    <i data-feather="edit-2" class="icon-sm me-2"></i> <span class="">Tambah</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-hover mb-0" id="dataTableExample">
                            <thead>
                                <tr>
                                    <th class="pt-0">#</th>
                                    <th class="pt-0">Nama Lengkap</th>
                                    <th class="pt-0">Alamat KTP</th>
                                    {{-- <th class="pt-0">Alamat Domisili</th> --}}
                                    {{-- <th class="pt-0">Provinsi</th> --}}
                                    {{-- <th class="pt-0">Kabupaten</th> --}}
                                    {{-- <th class="pt-0">Kecamatan</th> --}}
                                    {{-- <th class="pt-0">Nomor Telepon</th> --}}
                                    <th class="pt-0">Nomor HP</th>
                                    <th class="pt-0">Email</th>
                                    {{-- <th class="pt-0">Kewarganegaraan</th>
                                    <th class="pt-0">Asal negara</th>
                                    <th class="pt-0">Tanggal Lahir</th>
                                    <th class="pt-0">Negara Tempat Lahir</th>
                                    <th class="pt-0">Provinsi Tempat Lahir</th>
                                    <th class="pt-0">Kota Tempat Lahir</th>
                                    <th class="pt-0">Jenis Kelamin</th>
                                    <th class="pt-0">Status Menikah</th>
                                    <th class="pt-0">Agama</th>
                                    <th class="pt-0">Foto</th> --}}
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_mahasiswa as $mahasiswa)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $mahasiswa->nama_lengkap }}</td>
                                        <td>{{ $mahasiswa->alamat_ktp }}</td>
                                        {{-- <td>{{ $mahasiswa->alamat_domisili }}</td>
                                        <td>{{ $mahasiswa->kabupaten->provinsi->provinsi }}</td>
                                        <td>{{ $mahasiswa->kabupaten->kabupaten }}</td>
                                        <td>{{ $mahasiswa->kecamatan }}</td>
                                        <td>{{ $mahasiswa->nomor_telepon }}</td> --}}
                                        <td>{{ $mahasiswa->nomor_hp }}</td>
                                        <td>{{ $mahasiswa->email }}</td>
                                        {{-- <td>{{ $mahasiswa->kewarganegaraan }}</td>
                                        <td>{{ $mahasiswa->wna ?? 'Indonesia' }}</td>
                                        <td>{{ Carbon::parse($mahasiswa->tanggal_lahir)->isoFormat('LL') }}</td>
                                        <td>{{ $mahasiswa->negara_tempat_lahir ?? 'Indonesia' }}</td>
                                        <td>{{ $mahasiswa->provinsi_tempat_lahir }}</td>
                                        <td>{{ $mahasiswa->kota_tempat_lahir }}</td>
                                        <td>{{ $mahasiswa->jenis_kelamin }}</td>
                                        <td>{{ $mahasiswa->status_menikah }}</td>
                                        <td>{{ $mahasiswa->agama }}</td>
                                        <td><img src="{{ asset('storage/' . $mahasiswa->foto) }}"
                                                class="img-fluid img-thumbnail" alt=""></td> --}}
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="/admin/mahasiswa/{{ $mahasiswa->id }}/edit"
                                                    class="badge bg-primary d-inline-block">Edit</a>
                                                <form action="/admin/mahasiswa/{{ $mahasiswa->id }}" method="post">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit"
                                                        class="badge bg-danger d-inline-block ms-2 mb-1 badge-a tombol-hapus">Hapus</button>
                                                </form>
                                                @if (!$mahasiswa->user->admin_verified_at)
                                                    <form action="/admin/mahasiswa/{{ $mahasiswa->id }}/verify"
                                                        method="post">
                                                        @method('put')
                                                        @csrf
                                                        <button type="submit"
                                                            class="badge bg-info d-inline-block ms-2 mb-1 badge-a">Verifikasi</button>
                                                    </form>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection


@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.6.4/jquery.colorbox-min.js"></script>
    <script>
        $(document).ready(function() {
            // Inisialisasi Colorbox untuk gambar
            $('.img-thumbnail').colorbox({
                rel: 'gallery',
                maxWidth: '90%',
                maxHeight: '90%',
            });

            // Menangani penutupan Colorbox ketika area di luar gambar diklik
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.cboxPhoto').length && !$(e.target).closest('.cboxContent')
                    .length) {
                    $.colorbox.close();
                }
            });
        });
    </script>
    {{-- <script>
        // resources/js/lightbox.js

        import 'jquery';
        import 'colorbox';

        $(document).ready(function() {
            // Inisialisasi Colorbox untuk gambar
            $('.img-thumbnail').colorbox({
                rel: 'gallery',
                maxWidth: '90%',
                maxHeight: '90%',
            });

            // Menangani penutupan Colorbox ketika area di luar gambar diklik
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.cboxPhoto').length && !$(e.target).closest('.cboxContent')
                    .length) {
                    $.colorbox.close();
                }
            });
        });
    </script> --}}
@endsection
