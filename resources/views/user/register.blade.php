@extends('layouts.user')

@section('title','  Registrasi')

@section('content')


<div class="container">
    <div class="row justify-content-center mt-3">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">Registrasi</h2>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="provinsi">Provinsi Sesuai Tempat Tinggal</label>
                        <select class="form-select @error('province_id') is-invalid @enderror" id="provinsi" name="province_id" required>
                            <option value="">-- Pilih Provinsi --</option>
                            @foreach($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                        @error('province_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="regencies">Kota/Kabupaten Sesuai Tempat Tinggal</label>
                        <select class="form-select @error('regency_id') is-invalid @enderror" id="regencies" name="regency_id" required>
                            <option value="">-- Pilih Kota/Kabupaten --</option>
                        </select>
                        @error('regency_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="districts">Kecamatan Sesuai Tempat Tinggal</label>
                        <select class="form-select @error('district_id') is-invalid @enderror" id="districts" name="district_id" required>
                            <option value="">-- Pilih Kecamatan --</option>
                        </select>
                        @error('district_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="villages">Desa/Kelurahan Sesuai Tempat Tinggal</label>
                        <select class="form-select @error('village_id') is-invalid @enderror" id="villages" name="village_id" required>
                            <option value="">-- Pilih Desa/Kelurahan --</option>
                        </select>
                        @error('village_id')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.3.min.js" integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>
<script> 
   $(function() {
       $.ajaxSetup({
           headers: {
               'X-CSRF-TOKEN' : jQuery('meta[name="csrf-token"]').attr('content')
           }
       });

        $(function(){
            $('#provinsi').on('change',function(){
                $.ajax({
                    type:'POST',
                    url:"{{ route('getkota') }}",
                    data: {
                        province_id: province_id
                    },
                    cache: false,
                    success: function(message){
                        $('#regencies').html(message);
                        $('#districts').html('');
                        $('#villages').html('');
                    },
                    error: function(data){
                        console.log('Error on ${data}');
                    }
                });
            });

        $('#districts').on('change', function(){
            let district_id = $('#districts').val();
            $.ajax({
                type: 'POST',
                url: "{{ route('getdesa') }}",
                data: {
                    district_id: district_id
                },
                cache: false,
                success: function(message){
                    $('#villages').html('');
                },
                error: function(data){
                    console.log('Error on ${data}');
                }
            });
        });
    });
   });
</script>
    <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')){
        var options = {
            damping: '0,5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
    </script>

@endsection
