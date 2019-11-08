<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\authors;
use App\books;

class AddAuthorController extends Controller
{
    public function addAuthor(Request $req){
        $author = new authors();
        $author->name = $req->input('authorName');
        $author->age = $req->input('authorAge');
        $author->address = $req->input('authorAddress');

        $book = new books();
        $book->name = $req->input('bookName');
        $book->releaseDate = $req->input('bookRelease');

        $author->save();

        $book->author_id = $author->id;
        $book->save();

        return response('<h1>Added author successfully</h1><a href="/">&lt;&lt; Back</a>', 200)
            ->header('Content-Type', 'text/html');
    }
}
