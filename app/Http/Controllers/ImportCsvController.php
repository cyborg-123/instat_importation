<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Session;
use App\Survey;
use App\ResultGlobal;
use App\ResultRegion;
use App\Region;
use App\Indicator;
use Maatwebsite\Excel\Facades\Excel;
use Input;
use DB;

class ImportCsvController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $surveys = Survey::orderBy('name')->get();
        
            $indicators = Indicator::all();
            $groups = [
                "region"=>"region",
                "district"=>"district",
                "sexe"=>"sexe"
            ];

            $years = [
            "2018"=>"2018",
            "2019"=>"2019"
            ];

            $data = [
            'surveys' => $surveys,
            'groups'=>$groups,
            'years' =>$years
            ];
            
            return view('admin.import.importfile',compact('indicators'))->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $timestart=microtime(true);

        $path = $request->file('file')->getRealPath();
        $data = Excel::load($path, function($reader) {})->get()->toArray();
        $surveys = $request->id_survey;
        $group = $request->group;
        $year = $request->year;

        $csv_header_fields = [];
        foreach ($data[0] as $key => $value) {
            $csv_header_fields[] = $key;
        }

        $indicatorIds = array();
        for ($i = 0; $i < sizeof($csv_header_fields); $i++) {
            if ($i == 0) {
                $indicatorIds[$csv_header_fields[$i]] = $csv_header_fields[$i];
            }
            else {
                $Indicator = Indicator::firstOrCreate(['title' => $csv_header_fields[$i], 'id_survey' => $surveys]);
                $indicatorIds[$Indicator->title] = $Indicator->id;
            }
        }
        
        $csv_data = array_slice($data, 0, 1000);
                
        for ($i = 1; $i < sizeof($csv_header_fields); $i++) {
            $resultGlobal = ResultGlobal::firstOrCreate([
                'id_indicator' => $indicatorIds[$csv_header_fields[$i]],
                'ensemble' => str_replace(",",".",$csv_data[0][$csv_header_fields[$i]]), 
                'urbain' => str_replace(",",".",$csv_data[1][$csv_header_fields[$i]]), 
                'rural' => str_replace(",",".",$csv_data[2][$csv_header_fields[$i]]), 
                'year' => $year
            ]);  
            
        }
        
        for ($i=3; $i < sizeof($csv_data); $i++) {
            $name = $csv_data[$i][$csv_header_fields[0]];
            
            $reg = Region::where('name', $name)->first();
            $region = $reg->id;
            
            for ($j=1; $j < sizeof($csv_header_fields); $j++) {
                $resultRegion = ResultRegion::firstOrCreate([
                    'id_region' => $region,
                    'id_indicator' => $indicatorIds[$csv_header_fields[$j]],
                    'value' => str_replace(",",".",$csv_data[$i][$csv_header_fields[$j]]),
                    'year' => $year
                ]);
                
            }
        }

        $timeend=microtime(true);
        $time=$timeend-$timestart;
        $page_load_time = number_format($time, 3);

        echo "<p class='text-primary' style='font-weight: bold'>Importation effectuée avec succès! (" . (sizeof($csv_data) + 1) . " lignes au total, la requête a pris " . $page_load_time . " secondes.)</p>";
    }

    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
