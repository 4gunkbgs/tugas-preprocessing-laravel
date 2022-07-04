<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\File;
use Sastrawi\Stemmer\StemmerFactory;

class FileController extends Controller
{
    public function index()
    {
        return view('upload_file');
    }
    public function upload(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
            'file2' => 'required|file',
        ]);

        // dd($request->file);
        $fileName = time() . '-' . $request->file->getClientOriginalName();

        $fileName2 = time() . '-' . $request->file2->getClientOriginalName();

        File::create([
            'file' => $fileName,
            'file2' => $fileName2,
        ]);

        Storage::putFileAs('public/dokumen', $request->file, $fileName);
        Storage::putFileAs('public/dokumen', $request->file2, $fileName2);

        File::create([
            'file' => $fileName,
            'file2' => $fileName2,
        ]);

        return redirect('/result');
    }

    public function result()
    {
        function tokenize($path)
        {
            $text = Storage::get($path);
            $lowStr = strtolower($text);
            $stringClean = preg_replace('/[^a-z0-9]+/i', ' ', $lowStr);
            $token = explode(' ', $stringClean);
            return $token;
        }

        function removeStopword($words)
        {
            $stopword = Storage::get('public/stopword/stopwords_id.txt');
            $stopword = explode("\r\n", $stopword);
            $filtered = array_diff($words, $stopword);

            return $filtered;
        }

        function stemming($text)
        {
            $stemmerFactory = new StemmerFactory();
            $stemmer = $stemmerFactory->createStemmer();
            $stemmed   = $stemmer->stem($text);
            $token = explode(' ', $stemmed);
            return $token;
        }

        function pecahUlang($text)
        {
            $text = explode(' ', $text);
            return ($text);
        }

        $file_path = File::orderBy('created_at', 'desc')->first();
        $path = 'public/dokumen/' . $file_path->file;
        $path2 = 'public/dokumen/' . $file_path->file2;

        $text1 = Storage::get($path);
        $text2 = Storage::get($path2);

        //tokenize 2 dokumen
        $dokumen1_token = tokenize($path);
        $dokumen2_token = tokenize($path2);

        //removing stopword
        $dokumen1_no_stopword = removeStopword($dokumen1_token);

        //file dokumen1 no stopword
        $dokumen1_no_stopword_text = '';
        foreach ($dokumen1_no_stopword as $doc) {
            $dokumen1_no_stopword_text .= $doc . " ";
        }
        $dokumen1_no_stopword_text = substr($dokumen1_no_stopword_text, 0, -1);

        $new1 = pecahUlang($dokumen1_no_stopword_text);
        $dokumen1_no_stopword_text = '';
        foreach ($new1 as $doc1) {
            $dokumen1_no_stopword_text .= $doc1 . " ";
        }

        //file dokumen2 no stopword
        $dokumen2_no_stopword = removeStopword($dokumen2_token);

        $dokumen2_no_stopword_text = '';
        foreach ($dokumen2_no_stopword as $doc) {
            $dokumen2_no_stopword_text .= $doc . " ";
        }
        $dokumen2_no_stopword_text = substr($dokumen2_no_stopword_text, 0, -1);

        $new2 = pecahUlang($dokumen2_no_stopword_text);
        $dokumen2_no_stopword_text = '';
        foreach ($new2 as $doc2) {
            $dokumen2_no_stopword_text .= $doc2 . " ";
        }

        //stemming
        $dokumen1_stem = stemming($dokumen1_no_stopword_text);
        $dokumen2_stem = stemming($dokumen2_no_stopword_text);

        //panjang array
        $panjang_array1 = count($dokumen1_stem);
        $panjang_array2 = count($dokumen2_stem);
        // dd($panjang_array);  

        //menghitung frekuensi tiap kata 
        $term_freq1 = array_count_values($dokumen1_stem);
        // dd($term_freq1);
        $term_freq2 = array_count_values($dokumen2_stem);

        return view('stemming', [
            'files' => $file_path,
            'doc1' => $text1,
            'doc2' => $text2,
            'dokumen1_no_stopword' => $new1,
            'dokumen2_no_stopword' => $new2,
            'dokumen1_stem' => $dokumen1_stem,
            'dokumen2_stem' => $dokumen2_stem,
            'term_freq1' => $term_freq1,
            'term_freq2' => $term_freq2,
            'panjang_array1' => $panjang_array1,
            'panjang_array2' => $panjang_array2,
        ]);
    }
}
