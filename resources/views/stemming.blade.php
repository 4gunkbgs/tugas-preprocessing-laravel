@extends('template')
@section('title','Hasil Preprocessing')
@section('content')

    <br>
    <h1>Hasil</h1>
    <table class="table">
        <thead>
            <tr>
                <th scope="col"> Dokumen 1</th>
                <th scope="col"> Dokumen 2</th>
            </tr>   
        </thead>
        <tbody >
            <tr>
                <td> {{ $doc1 }} </td>
                <td> {{ $doc2 }}</td>
            </tr>
        </tbody>
    </table>

    <div class="d-flex justify-content-start">
        <table class="table mx-4 mt-2">
            <thead class="bg-dark text-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Data Filter1</th>
                    <th scope="col">Data Stemming1</th>
                </tr>
            </thead>
            
            <tbody>
            @for ($i=0; $i<$panjang_array1; $i++)
            <tr>
                <td>
                    {{$i+1}}
                </td>
                <td>
                    {{$dokumen1_no_stopword[$i]}}
                </td>
                <td>
                    {{$dokumen1_stem[$i]}}
                </td>
            </tr>
                
            @endfor
            
            </tbody>
        </table>
        <table class="table mx-4 mt-2">
            <thead class="bg-dark text-light">
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Data Filter2</th>
                    <th scope="col">Data Stemming2</th>
                </tr>
            </thead>
            
            <tbody>
            @for ($i=0; $i<$panjang_array2; $i++)
            <tr>
                <td>
                    {{$i+1}}
                </td>
                <td>
                    {{$dokumen2_no_stopword[$i]}}
                </td>
                <td>
                    {{$dokumen2_stem[$i]}}
                </td>
            </tr>
                
            @endfor
            
            </tbody>
        </table>
    </div>
    <br>
    <div class="d-flex justify-content-start">
        <table class="table mx-4 mt-2">
            <thead class="bg-dark text-light">
                <tr>
                    <th scope="col">Kata</th>
                    <th scope="col">Frekuensi</th>
                    <th scope="col">Tf</th>
                </tr>
            </thead>
            
            <tbody>
            @foreach ($term_freq1 as $kata => $freq)
            <tr>
                <td>
                    {{$kata}}
                </td>
                <td>
                    {{$freq}}
                </td>
                <td>
                    {{round(1+(log10($freq)),3)}}
                </td>
            </tr>
            @endforeach
           
            
            </tbody>
        </table>
        <table class="table mx-4 mt-2">
            <thead class="bg-dark text-light">
                <tr>
                    <th scope="col">Kata</th>
                    <th scope="col">Frekuensi</th>
                    <th scope="col">Tf</th>
                </tr>
            </thead>
            
            <tbody>
            @foreach ($term_freq2 as $kata => $freq)
            <tr>
                <td>
                    {{$kata}}
                </td>
                <td>
                    {{$freq}}
                </td>
                <td>
                    {{round(1+(log10($freq)),3)}}
                </td>
            </tr>
            @endforeach
           
            
            </tbody>
        </table>
    </div>
 @endsection