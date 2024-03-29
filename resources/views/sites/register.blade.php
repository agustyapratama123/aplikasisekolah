@extends('layout/frontend')

@section('content')
<section class="search-course-area relative" style="background:unset;">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-lg-3 col-md-6 search-course-left">
                <h1>
                    Pendaftaran Online <br>
                    Bergabung bersama kami
                </h1>
                <p>
                    inappropriate behavior is often laughed off as “boys will be boys,” women face higher conduct standards especially in the workplace. That’s why it’s crucial that, as women, our behavior on the job is beyond reproach.
                </p>
            </div>
            <div class="col-lg-6 col-md-6 search-course-right section-gap">
                {!! Form::open(['url' => '/postregister','class'=>'form-wrap']) !!}

                <h4 class="text-black pb-20 text-center mb-30">Formulir Pendaftaran</h4>
                {!!Form::text('nama_depan','',['class'=>'form-control','placeholder'=>'Nama Depan'])!!}
                {!!Form::text('nama_belakang','',['class'=>'form-control','placeholder'=>'Nama Belakang'])!!}
                {!!Form::text('agama','',['class'=>'form-control','placeholder'=>'Agama'])!!}
                {!!Form::textarea('alamat','',['class'=>'form-control','placeholder'=>'Alamat'])!!}
                <div class="form-select" id="service-select">
                    {!!Form::select('jenis_kelamin', [''=>'Pilih Jenis Kelamin','L' => 'Laki-laki', 'P' => 'Perempuan'],'')!!}
                </div>
                {!!Form::email('email','',['class'=>'form-control','placeholder'=>'Email'])!!}
                {!!Form::password('password',['class'=>'form-control','placeholder'=>'Password'])!!}
                <input type="submit" class="primary-btn text-uppercase" value="kirim" style="text-align:center;">
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</section>
@endsection
