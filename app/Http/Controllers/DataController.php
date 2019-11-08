<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\authors;
use App\books;

class DataController extends Controller
{
    public function getData(){
        $authors = authors::all();
        $with_books = array();
        foreach ($authors as $author){
            $author['books'] = books::all()->where('author_id', $author->id);
            array_push($with_books, $author);
        }
        return response()->json($with_books);
    }
}
