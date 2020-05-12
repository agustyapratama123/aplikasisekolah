@extends('layout.main')

@section('container')
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="panel">

                        <!-- Heading -->
                        <div class="panel-heading">
                            <h3 class="panel-title">Ranking Siswa</h3>
                        </div>
                        <!-- End Heading -->
                        <div class="panel-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Ranking</th>
                                        <th>Nama</th>
                                        <th>Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                    $Ranking=1;
                                    @endphp
                                    @foreach(rangking5Besar() as $s)
                                    <tr>
                                        <td>{{$Ranking}}</td>
                                        <td>{{$s->namaLengkap()}}</td>
                                        <td>{{$s->rataRataNilai}}</td>
                                    </tr>
                                    @php
                                    $Ranking++;
                                    @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {{-- total Siswa --}}
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-user"></i></span>
                        <p>
                            <span class="number">{{totalSiswa()}}</span>
                            <span class="title">Total Siswa</span>
                        </p>
                    </div>
                </div>
                {{-- End total Siswa --}}

                {{-- total Guru --}}
                <div class="col-md-3">
                    <div class="metric">
                        <span class="icon"><i class="fa fa-user"></i></span>
                        <p>
                            <span class="number">{{totalGuru()}}</span>
                            <span class="title">Total Guru</span>
                        </p>
                    </div>
                </div>
                {{-- End total Guru --}}
            </div>
        </div>
    </div>
</div>
@endsection
