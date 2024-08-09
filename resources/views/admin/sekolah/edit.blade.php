@extends('layouts.backend')

@section('content')
    <x-app-layout>
        <div class="col-md-12">
            <div class="card card-outline card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit Data {{ $title }}</h3>
                </div>
                <!-- /.card-header -->
                <form action="/sekolah/update/{{ $sekolah->id_sekolah }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">

                        <div class="row">
                            <div class="col-sm-6">
                                <!-- text input -->
                                <div class="form-group">
                                    <label>Nama Sekolah</label>
                                    <input name="nama_sekolah" value="{{ $sekolah->nama_sekolah }}" type="text" class="form-control" placeholder="Enter ...">
                                    <div class="text-danger">
                                        @error('nama_sekolah')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Alamat</label>
                                    <input name="alamat" type="text" value="{{ $sekolah->alamat }}" class="form-control" placeholder="Enter ...">
                                    <div class="text-danger">
                                        @error('alamat')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Kecamatan</label>
                                    <input name="kecamatan" type="text" value="{{ $sekolah->kecamatan }}" class="form-control" placeholder="Enter ...">
                                    <div class="text-danger">
                                        @error('kecamatan')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Posisi Sekolah</label>
                                    <input name="posisi" type="text" value="{{ $sekolah->posisi }}" class="form-control" placeholder="Enter ...">
                                    <div class="text-danger">
                                        @error('kecamatan')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Foto Sekolah</label>
                                    <input name="foto" type="file" class="form-control" accept="image/jpeg,image/png">
                                    <div class="text-danger">
                                        @error('foto')
                                            {{ $message }}
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <label for="">Map</label>
                                <div id="map" style="width: 100%; height: 300px;"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-info">Simpan</button>
                            <a href="/sekolah" type="submit" class="btn btn-warning float-right">Cancel</a>
                        </div>

                    </div>
                </form>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <script>
            var peta1 = L.tileLayer(
                'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/streets-v11'
                });

            var peta2 = L.tileLayer(
                'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/satellite-v9'
                });


            var peta3 = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            });

            var peta4 = L.tileLayer(
                'https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
                    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
                        '<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
                        'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                    id: 'mapbox/dark-v10'
                });



            var map = L.map('map', {
                center: [{{$sekolah->posisi}}],
                zoom: 11,
                layers: [peta3],

            });


            var baseMaps = {
                "Grayscale": peta1,
                "Satellite": peta2,
                "Streets": peta3,
                "Dark": peta4,

            };

            var layerControl = L.control.layers(baseMaps).addTo(map);

            var curLocation = [{{$sekolah->posisi}}];
            map.attributionControl.setPrefix(false);

            var marker = new L.marker(curLocation, {
                draggable: 'true',
            });

            map.addLayer(marker);

            marker.on('dragend', function(event) {
                var position = marker.getLatLng();
                marker.setLatLng(position, {
                    draggable: 'true',
                }).bindPopup(position).update();
                $("#posisi").val(position.lat + "," + position.lng).keyup();

            });

            var posisi = document.querySelector("[name=posisi]");
            map.on("click", function(event) {
                var lat = event.latlng.lat;
                var lng = event.latlng.lng;

                if (!marker) {
                    marker = L.marker(event.latlng).addTo(map);
                }else{
                    marker.setLatLng(event.latlng);
                }
                posisi.value = lat + "," + lng;
            });
        </script>
    </x-app-layout>
@endsection
