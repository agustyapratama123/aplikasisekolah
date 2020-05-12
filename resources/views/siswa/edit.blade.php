@extends('layout.main')
    <title>@section('title','Edit')</title>
@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form action="/siswa/{{$siswa->id}}/update" method="post" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <label for="nama_depan">Nama Depan</label>
                            <input class="form-control" id="nama_depan" placeholder="Nama Depan" name="nama_depan" value="{{$siswa->nama_depan}}">
                        </div>

                        <div class="form-group">
                            <label for="nama_belakang">Nama Belakang</label>
                            <input class="form-control" id="nama_belakang" placeholder="Nama Belakang" name="nama_belakang" value="{{$siswa->nama_belakang}}">
                        </div>

                        <div class="form-group">
                            <label for="jenis_kelamin">Jenis Kelamin</label>
                            <select class="form-control" id="jenis_kelamin" name="jenis_kelamin">
                                <option value="L" @if ($siswa->jenis_kelamin == 'L') selected @endif>Laki-laki</option>
                                <option value="P" @if ($siswa->jenis_kelamin == 'P') selected @endif>Perempuan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="agama">Agama</label>
                            <input class="form-control" id="agama" placeholder="Agama" name="agama" value="{{$siswa->agama}}">
                        </div>

                        <div class="form-group">
                            <label for="alamat">Alamat</label>
                            <textarea name="alamat" class="form-control" id="alamat" rows="3">{{$siswa->alamat}}</textarea>
                        </div>
                        
                        <div class="form-group">
                            <label for="avatar">Avatar</label>
                            <input type="file" name="avatar" id="avatar" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-warning">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
