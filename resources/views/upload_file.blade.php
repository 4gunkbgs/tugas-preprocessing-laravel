@extends('template')
@section('title','Upload File')
@section('content')

    <div class="content">
        <h2>Masukkan File txt</h2>
        <form action="/upload" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="input-group mb-3">
                <span class="input-group-text bg-primary" id="inputGroup-sizing-default">File 1:</span>
                <input type="file" name="file" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <div class="input-group mb-3">
                <span class="input-group-text bg-primary" id="inputGroup-sizing-default">File 2:</span>
                <input type="file" name="file2" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            <center>
                <input type="submit" class="btn btn-primary" value="Submit">
            </center>
        </form>
    </div>
    <br>
@endsection