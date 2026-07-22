<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Http\Requests;

class QueryController extends Controller
{
    public function search(Request $request)
    {
        // Gets the query string from our form submission
        $query = trim((string) $request->input('search', ''));
        // Returns an array of articles that have the query string located somewhere within
        // our articles titles. Paginates them so we can break up lots of search results.
        $articles = DB::table('offres')
            ->when($query !== '', function ($q) use ($query) {
                $q->where('titre_offre', 'LIKE', '%' . $query . '%');
            })
            ->paginate(10);

        // returns a view and passes the view the list of articles and the original query.
        return view('search', compact('articles', 'query'));
    }
}
