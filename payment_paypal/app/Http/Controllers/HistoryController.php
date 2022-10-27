<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\History;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    public function show(){
        $data=History::all();
        return view('history.history',compact('data'));
    }



    function action(Request $request)
    {
        if($request->ajax())
        {
            $output = '';
            $query = $request->get('query');
                if($query != '')
                {
                    $data = DB::table('histories')
                        ->where('amount', 'like', '%'.$query.'%')
                        ->orWhere('currency', 'like', '%'.$query.'%')
                        ->orWhere('created_at', 'like', '%'.$query.'%')
                        ->orderBy('id', 'desc')
                        ->get();

                }
                else
                {
                    $data = DB::table('histories')
                        ->orderBy('id', 'desc')
                        ->get();
                }

                $total_row = $data->count();

                if($total_row > 0)
                {
                    $i=0;
                    foreach($data as $row)
                    {
                        $i++;
                        $output .= '
                        <tr>
                        <td>'.$i.'</td>
                        <td>'.$row->amount.'</td>
                        <td>'.$row->currency.'</td>
                        <td>'.$row->created_at.'</td>

                        </tr>
                        ';
                    }
                }
                else
                {
                    $output = '
                    <tr>
                        <td align="center" colspan="5">No Data Found</td>
                    </tr>
                    ';
                }

                $data = array(
                'table_data'  => $output,
                'total_data'  => $total_row
                );

                echo json_encode($data);
        }
    }

}
