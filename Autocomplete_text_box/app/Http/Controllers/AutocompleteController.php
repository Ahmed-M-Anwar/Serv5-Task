<?php

namespace App\Http\Controllers;

use App\Models\Autocomplete;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AutocompleteController extends Controller
{

    public function index(){
        return view('autocomplete');
    }

    function fetch(Request $request)
    {
        if($request->ajax())
        {
         $output = '';
         $query = $request->get('query');
         if($query != '')
         {
          $data = DB::table('autocompletes')
            ->where('autocomplete_text', 'like', '%'.$query.'%')
            ->orderBy('id', 'desc')
            ->get();

         }
         $total_row = $data->count();
         if($total_row > 0)
         {
            $output .= '<ul class="dropdown-menu" style="display:block; position:relative; width:100%;">';
            foreach($data as $row)
            {
            $output .= '
            <li><a class="dropdown-item" href="#">'.$row->autocomplete_text.'</li>
            ';
            }
            $output .= '</ul>';
         }

         $data = array(
          'table_data'  => $output,
         );

         echo json_encode($data);
        }
    }

    public function store(Request $request){
        $validated = $request->validate([
            'autocomplete_text' => 'required',
        ]);
        Autocomplete::create([
            'autocomplete_text'=>$request->autocomplete_text,
        ]);
        return true;
    }
}
