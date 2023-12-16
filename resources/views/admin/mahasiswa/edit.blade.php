@extends('layouts.admin-main')

@section('content')
    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
            <h4 class="mb-3 mb-md-0">Detail mahasiswa</h4>
        </div>

    </div>

    <div class="row">
        <div class="col-lg-12 col-xl-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="mb-3 mb-md-0">Detail mahasiswa</h4>
                            <form action="/admin/mahasiswa/{{ $mahasiswa->id }}" method="post"
                                enctype="multipart/form-data">
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
                                        <input type="text" class="form-control @error('kecamatan') is-invalid @enderror"
                                            id="kecamatan" name="kecamatan" autofocus
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
                                        <input type="text"
                                            class="form-control @error('provinsi_tempat_lahir') is-invalid @enderror"
                                            id="provinsi_tempat_lahir" name="provinsi_tempat_lahir"
                                            value="{{ old('provinsi_tempat_lahir', $mahasiswa->provinsi_tempat_lahir) }}">
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



                                <div class="mb-3 p-2">
                                    <div class="col">
                                        <label class="form-label" for="foto">
                                            Foto <span class="text-danger">*</span>
                                        </label>
                                        <input type="file" class="form-control @error('foto') is-invalid @enderror"
                                            id="foto" name="foto" value="{{ old('foto', $mahasiswa->foto) }}">
                                        <p class="text-left">Format file: jpg, jpeg, png</p>
                                        @error('foto')
                                            <div class="text-danger">
                                                {{ $message }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="mb-3 p-2 row mt-4">
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
                                </div>
                                <div class="p-2 row">
                                    <button type="submit"
                                        class="btn btn-primary me-2 mb-2 mb-md-0 text-white">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tanggalLahirInput = document.getElementById("tanggal_lahir");

            tanggalLahirInput.addEventListener("change", function() {
                // Mendapatkan tanggal lahir yang dipilih oleh pengguna
                const tanggalLahir = new Date(this.value);

                // Mendapatkan tanggal saat ini
                const tanggalSaatIni = new Date();

                // Menghitung usia berdasarkan perbedaan tahun
                const usia = tanggalSaatIni.getFullYear() - tanggalLahir.getFullYear();

                // Memeriksa apakah usia kurang dari 17 tahun
                if (usia < 17) {
                    // Menggunakan SweetAlert2 untuk menampilkan pesan peringatan
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Usia minimal harus 17 tahun.',
                    });

                    this.value = ""; // Mengosongkan input tanggal lahir
                }
            });
        });
    </script>
    <script>
        function previewFoto() {
            var namaFoto = $('#nama_foto').val();
            var imagePath = '{{ asset('storage/') }}' + '/' + namaFoto;
            $('.img-preview').attr('src', imagePath);
        }


        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginImageExifOrientation,
            FilePondPluginFileValidateSize,
            FilePondPluginImageEdit,
        );

        FilePond.create(
            document.querySelector('.filepond')
        );
        FilePond.setOptions({
            server: {
                process: {
                    url: '/file/tmp-upload',
                    method: 'POST',
                    withCredentials: false,
                    onload: (response) => {
                        console.log(response);
                        $('#nama_foto').val(response);
                        var namaFoto = $('#nama_foto').val();
                        var imagePath = '{{ asset('storage/') }}' + '/' + namaFoto;
                        $('.img-preview').attr('src', imagePath);
                    },
                    ondata: (formData) => {
                        formData.append('folder', 'foto-profil');
                        return formData;
                    },
                },
                revert: {
                    url: '/file/tmp-delete',
                    method: 'DELETE',
                    onload: (response) => {
                        console.log(response);
                        $('#nama_foto').val(response);
                        var imagePath = '{{ asset('storage/' . $mahasiswa->user->foto) }}';
                        $('.img-preview').attr('src', imagePath);
                    },
                },
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },

            },
            labelIdle: 'Seret & Lepaskan file Anda atau <span class="filepond--label-action"> Jelajahi </span>'
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
