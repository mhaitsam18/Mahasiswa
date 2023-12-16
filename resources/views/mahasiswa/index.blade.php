@extends('layouts.admin-main')
@php
    use Carbon\Carbon;
@endphp
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.colorbox/1.6.4/example1/colorbox.min.css">
    <style type="text/css" media="print">
        /* Gaya CSS khusus untuk mode cetak */
        /* Misalnya, menyembunyikan elemen yang tidak ingin dicetak */
        body {
            background-color: white;
        }

        /* ... tambahkan aturan CSS khusus cetak lainnya ... */
    </style>
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
                        <div class="row">
                            <div class="col-md-3">
                                <img src="/assets/img/logos/ui.png" class="img-fluid" style="max-width: 100px;"
                                    alt="">
                            </div>
                            <div class="col-md-9">
                                <h6 class="card-title mb-0">SELAMAT ANDA DITERIMA DI UNIVERSITAS INDONESIA</h6>
                            </div>
                        </div>
                        <div class="dropdown mb-2">
                            <button class="btn p-0" type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                            </button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton7">
                                <a class="dropdown-item d-flex align-items-center" href="#" id="printButton">
                                    <i data-feather="edit-2" class="icon-sm me-2"></i>
                                    <span class="">Print</span>
                                </a>

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-9">
                            <form action="/mahasiswa/{{ $mahasiswa->id }}" method="post" enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <div class="mb-3 p-2 row">
                                    <div class="col">
                                        <label class="form-label" for="email">
                                            Email <span class="text-danger">*</span>
                                        </label>
                                        <input type="email" class="form-control @error('email') is-invalid @enderror"
                                            id="email" name="email" autofocus
                                            value="{{ old('email', $mahasiswa->email) }}">
                                        @error('email')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="nama_lengkap">
                                            Nama Lengkap <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('nama_lengkap') is-invalid @enderror"
                                            id="nama_lengkap" name="nama_lengkap"
                                            value="{{ old('nama_lengkap', $mahasiswa->nama_lengkap) }}">
                                        @error('nama_lengkap')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 p-2 row">
                                    <div class="col">
                                        <label class="form-label" for="alamat_ktp">
                                            Alamat KTP<span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control @error('alamat_ktp') is-invalid @enderror" id="alamat_ktp" name="alamat_ktp">{{ old('alamat_ktp', $mahasiswa->alamat_ktp) }}</textarea>
                                        @error('alamat_ktp')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="alamat_domisili">
                                            Alamat Saat Ini<span class="text-danger">*</span>
                                        </label>
                                        <textarea class="form-control @error('alamat_domisili') is-invalid @enderror" id="alamat_domisili"
                                            name="alamat_domisili">{{ old('alamat_domisili', $mahasiswa->alamat_domisili) }}</textarea>
                                        @error('alamat_domisili')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 p-2 row">
                                    <div class="col">
                                        <label class="form-label" for="provinsi_id">Provinsi<span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('provinsi_id') is-invalid @enderror"
                                            id="provinsi_id" name="provinsi_id">
                                            <option value="" selected disabled>Pilih Provinsi</option>
                                            @foreach ($data_provinsi as $provinsi)
                                                <option value="{{ $provinsi->id }}" @selected($provinsi->id == old('provinsi_id', $mahasiswa->kabupaten->provinsi_id))>
                                                    {{ $provinsi->provinsi }}</option>
                                            @endforeach
                                        </select>
                                        @error('provinsi_id')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="kabupaten_id">Kabupaten <span
                                                class="text-danger">*</span></label>
                                        <select class="form-select @error('kabupaten_id') is-invalid @enderror"
                                            id="kabupaten_id" name="kabupaten_id">
                                            <option value="" disabled>Pilih kabupaten
                                            </option>
                                            <option value="{{ old('provinsi_id', $mahasiswa->kabupaten->provinsi_id) }}">
                                                {{ old('provinsi_id', $mahasiswa->kabupaten->provinsi->provinsi) }}
                                            </option>
                                        </select>
                                        @error('kabupaten_id')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 p-2 row">
                                    <div class="col">
                                        <label class="form-label" for="kecamatan">
                                            kecamatan <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('kecamatan') is-invalid @enderror" id="kecamatan"
                                            name="kecamatan" autofocus
                                            value="{{ old('kecamatan', $mahasiswa->kecamatan) }}">
                                        @error('kecamatan')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="jenis_kelamin">
                                            jenis_kelamin <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-select @error('jenis_kelamin') is-invalid @enderror"
                                            id="jenis_kelamin" name="jenis_kelamin">
                                            <option value="" selected disabled>Pilih jenis kelamin
                                            </option>
                                            <option value="Pria" @selected('Pria' == old('jenis_kelamin', $mahasiswa->jenis_kelamin))>Pria
                                            </option>
                                            <option value="Wanita" @selected('Wanita' == old('jenis_kelamin', $mahasiswa->jenis_kelamin))>Wanita
                                            </option>
                                        </select>
                                        @error('jenis_kelamin')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 p-2 row">
                                    <div class="col">
                                        <label class="form-label" for="nomor_telepon">
                                            Nomor Telepon <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('nomor_telepon') is-invalid @enderror"
                                            id="nomor_telepon" name="nomor_telepon" autofocus
                                            value="{{ old('nomor_telepon', $mahasiswa->nomor_telepon) }}">
                                        @error('nomor_telepon')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="nomor_hp">
                                            Nomor HP <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control @error('nomor_hp') is-invalid @enderror"
                                            id="nomor_hp" name="nomor_hp"
                                            value="{{ old('nomor_hp', $mahasiswa->nomor_hp) }}">
                                        @error('nomor_hp')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 p-2">
                                    <label class="form-label" for="kewarganegaraan">Kewarganegaraan <span
                                            class="text-danger">*</span></label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kewarganegaraan"
                                            id="radio_wni" value="WNI Asli" @checked('WNI Asli' == old('kewarganegaraan', $mahasiswa->kewarganegaraan))>
                                        <label class="form-check-label" for="radio_wni">WNI Asli</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kewarganegaraan"
                                            id="radio_wni_keturunan" value="WNI Keturunan" @checked('WNI Keturunan' == old('kewarganegaraan', $mahasiswa->kewarganegaraan))>
                                        <label class="form-check-label" for="radio_wni_keturunan">WNI
                                            Keturunan</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kewarganegaraan"
                                            id="radio_wna" value="WNA" @checked('WNA' == old('kewarganegaraan', $mahasiswa->kewarganegaraan))>
                                        <label class="form-check-label" for="radio_wna">WNA</label>
                                    </div>

                                    <div id="wna-input" style="display: none;" class="mt-2">
                                        <label class="form-label" for="wna">Nama Negara <span
                                                class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="wna" name="wna">
                                    </div>
                                    @error('kewarganegaraan')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="mb-3 p-2 row">
                                    <div class="col">
                                        <label class="form-label" for="tanggal_lahir">
                                            Tanggal Lahir <span class="text-danger">*</span>
                                        </label>
                                        <input type="date"
                                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                                            id="tanggal_lahir" name="tanggal_lahir" autofocus
                                            value="{{ old('tanggal_lahir', $mahasiswa->tanggal_lahir) }}">
                                        @error('tanggal_lahir')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="kota_tempat_lahir">
                                            Kota Tempat Lahir <span class="text-danger">*</span>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('kota_tempat_lahir') is-invalid @enderror"
                                            id="kota_tempat_lahir" name="kota_tempat_lahir"
                                            value="{{ old('kota_tempat_lahir', $mahasiswa->kota_tempat_lahir) }}">
                                        @error('kota_tempat_lahir')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 p-2 row">
                                    <div class="col">
                                        <label class="form-label" for="provinsi_tempat_lahir">
                                            Provinsi Tempat Lahir <span class="text-danger"></span>
                                        </label>

                                        <select class="form-select @error('provinsi_tempat_lahir') is-invalid @enderror"
                                            id="provinsi_tempat_lahir" name="provinsi_tempat_lahir">
                                            <option value="" selected disabled>Pilih Provinsi</option>
                                            @foreach ($data_provinsi as $provinsi)
                                                <option value="{{ $provinsi->provinsi }}" @selected($provinsi->provinsi == old('provinsi_tempat_lahir', $mahasiswa->provinsi_tempat_lahir))>
                                                    {{ $provinsi->provinsi }}</option>
                                            @endforeach
                                        </select>
                                        @error('provinsi_tempat_lahir')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="negara_tempat_lahir">
                                            Negara Tempat Lahir <span class="text-danger"></span>
                                        </label>
                                        <input type="text"
                                            class="form-control @error('negara_tempat_lahir') is-invalid @enderror"
                                            id="negara_tempat_lahir" name="negara_tempat_lahir"
                                            value="{{ old('negara_tempat_lahir', $mahasiswa->negara_tempat_lahir) }}">
                                        @error('negara_tempat_lahir')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="mb-3 p-2">
                                    <label class="form-label" for="status_menikah">
                                        Status Menikah <span class="text-danger">*</span>
                                    </label><br>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status_menikah"
                                            id="radio_belum_menikah" value="Belum Menikah" @checked('Belum Menikah' == old('status_menikah', $mahasiswa->status_menikah))>
                                        <label class="form-check-label" for="radio_belum_menikah">Belum
                                            Menikah</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status_menikah"
                                            id="radio_menikah" value="Menikah" @checked('Menikah' == old('status_menikah', $mahasiswa->status_menikah))>
                                        <label class="form-check-label" for="radio_menikah">Menikah</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="status_menikah"
                                            id="radio_lain_lain" value="Lain-lain (Janda/Duda)"
                                            @checked('Lain-lain (Janda/Duda)' == old('status_menikah', $mahasiswa->status_menikah))>
                                        <label class="form-check-label" for="radio_lain_lain">Lain-lain
                                            (Janda/Duda)</label>
                                    </div>
                                    @error('status_menikah')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="mb-3 p-2">
                                    <label class="form-label">Agama <span class="text-danger">*</span></label><br>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="agama" id="agama_islam"
                                            value="Islam" @checked('Islam' == old('agama', $mahasiswa->agama))>
                                        <label class="form-check-label" for="agama_islam">Islam</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="agama" id="agama_katolik"
                                            value="Katolik" @checked('Katolik' == old('agama', $mahasiswa->agama))>
                                        <label class="form-check-label" for="agama_katolik">Katolik</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="agama" id="agama_kristen"
                                            value="Kristen" @checked('Kristen' == old('agama', $mahasiswa->agama))>
                                        <label class="form-check-label" for="agama_kristen">Kristen</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="agama" id="agama_hindu"
                                            value="Hindu" @checked('Hindu' == old('agama', $mahasiswa->agama))>
                                        <label class="form-check-label" for="agama_hindu">Hindu</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="agama" id="agama_budha"
                                            value="Budha" @checked('Budha' == old('agama', $mahasiswa->agama))>
                                        <label class="form-check-label" for="agama_budha">Budha</label>
                                    </div>

                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="agama"
                                            id="agama_lainlain" value="Lain-lain" @checked('Lain-lain' == old('agama', $mahasiswa->agama))>
                                        <label class="form-check-label" for="agama_lainlain">Lain-lain</label>
                                    </div>

                                    @error('agama')
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>



                                <div class="mb-3 p-2 row">
                                    <div class="col">
                                        <label class="form-label" for="foto">
                                            Foto <span class="text-danger">*</span>
                                        </label>
                                        <input type="file"
                                            class="form-control img-input @error('foto') is-invalid @enderror"
                                            id="foto" name="foto" value="{{ old('foto', $mahasiswa->foto) }}"
                                            onchange="previewImg()">
                                        <p class="text-left">Format file: jpg, jpeg, png</p>
                                        @error('foto')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <div class="col-sm-3">
                                            <img src="{{ asset('storage/' . $mahasiswa->foto) }}"
                                                class="img-thumbnail img-preview">
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="mb-3 p-2 row mt-4">
                                    <div class="col">
                                        <label class="form-label" for="password">
                                            Kata Sandi <span class="text-danger">*</span>
                                        </label>
                                        <input type="password" autocomplete="current-password"
                                            class="form-control @error('password') is-invalid @enderror" id="password"
                                            name="password">
                                        @error('password')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="col">
                                        <label class="form-label" for="password_confirmation">
                                            Konfirmasi Kata Sandi <span class="text-danger">*</span>
                                        </label>
                                        <input type="password"
                                            class="form-control @error('password_confirmation') is-invalid @enderror"
                                            id="password_confirmation" name="password_confirmation">
                                        @error('password_confirmation')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div> --}}
                                <div class="p-2">
                                    <button type="submit" class="btn btn-primary float-end">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- row -->
@endsection
@section('script')
    @parent
    <script>
        $(document).ready(function() {
            $('#printButton').click(function() {
                window.print();
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.img-input').change(function() {
                const picture = this;
                const imgPreview = $('.img-preview');
                imgPreview.css('display', 'block');

                const oFReader = new FileReader();
                oFReader.readAsDataURL(picture.files[0]);

                oFReader.onload = function(oFREvent) {
                    imgPreview.attr('src', oFREvent.target.result);
                };
            });
        });
        $(document).ready(function() {
            $('#provinsi_id').change(function() {
                var provinsiId = $(this).val();
                if (provinsiId) {
                    $.ajax({
                        url: '/getKabupaten/' + provinsiId,
                        type: 'GET',
                        dataType: 'json',
                        success: function(data) {
                            $('#kabupaten_id').empty();
                            $('#kabupaten_id').append(
                                '<option value="" selected disabled>Pilih kabupaten</option>'
                            );
                            $.each(data, function(key, value) {
                                $('#kabupaten_id').append('<option value="' + value.id +
                                    '" @selected(' + value.id + ' == old('kabupaten_id'))>' + value
                                    .kabupaten + '</option>');
                            });
                        }
                    });
                } else {
                    $('#kabupaten_id').empty();
                    $('#kabupaten_id').append(
                        '<option value="" selected disabled>Pilih kabupaten</option>');
                }
            });
        });
        $(document).ready(function() {
            $('input[name="kewarganegaraan"]').change(function() {
                if ($(this).val() === 'WNA') {
                    $('#wna-input').show();
                } else {
                    $('#wna-input').hide();
                }
            });
        });
    </script>
@endsection
