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
        $this->middleware('auth'); // effectuer la vérification de connexion (login)
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
        $timestart=microtime(true); // temps de démarrage de l'importation du csv

        $path = $request->file('file')->getRealPath(); // recupération du fichier csv à importer
        $data = Excel::load($path, function($reader) {})->get()->toArray(); // lecture du fichier csv
        $surveys = $request->id_survey; // recupération de l'id de l'enquête
        $group = $request->group; // recupération du groupe de l'enquête
        $year = $request->year; // recupération de l'année de l'enquête

        $csv_header_fields = []; // tableau qui va contenir les entêtes (indicateurs)
        foreach ($data[0] as $key => $value) { // lire un à un la 1ère ligne pour recupérer les indicateurs, $data[0] c'est la première ligne
            $csv_header_fields[] = $key;
        }

        $indicatorIds = array(); // création d'un tableau pour stoquer l'id des indicateurs pour les futurs enregistrements dans le database
        for ($i = 0; $i < sizeof($csv_header_fields); $i++) { // boucler suivant le nombre des colonnes
            if ($i == 0) {
                $indicatorIds[$csv_header_fields[$i]] = $csv_header_fields[$i]; // mettre le nom du champ en tant que id car on n'a pas besoin de l'envoyer à la database mais on l'a besoin plutard
            }
            else {
                $Indicator = Indicator::firstOrCreate(['title' => $csv_header_fields[$i], 'id_survey' => $surveys]); // vérifier si l'indicateur existe, si il existe on recupère l'enregistrement sinon on l'insère dans le database
                $indicatorIds[$Indicator->title] = $Indicator->id; // ajout de l'id de l'indicateur dans le tableau
            }
        }
        
        $csv_data = array_slice($data, 0, 1000); // récupération de toutes les lignes du fichier csv
                
        for ($i = 1; $i < sizeof($csv_header_fields); $i++) { // boucler suivant le nombre des colonnes pour récuperer un à les résultats globals
            $resultGlobal = ResultGlobal::firstOrCreate([ // vérifier si le résultat global existe si n'existe pas on l'insère dans le database
                'id_indicator' => $indicatorIds[$csv_header_fields[$i]], // recupération de l'id de l'indicateur
                'ensemble' => str_replace(",",".",$csv_data[0][$csv_header_fields[$i]]),  // récupération de la valeur de l'indicateur pour l'ensemble et on remplace les "," par un "."
                'urbain' => str_replace(",",".",$csv_data[1][$csv_header_fields[$i]]), // récupération de la valeur de l'indicateur pour l'urbain et on remplace les "," par un "."
                'rural' => str_replace(",",".",$csv_data[2][$csv_header_fields[$i]]), // récupération de la valeur de l'indicateur pour rural et on remplace les "," par un "."
                'year' => $year // récupération de l'année en cours
            ]);  
            
        }
        
        for ($i=3; $i < sizeof($csv_data); $i++) { // parcours des enregistrements des régions lignes par lignes depuis le 5 ème ligne -> fin 
            $name = $csv_data[$i][$csv_header_fields[0]]; // récupération du nom de région
            
            $reg = Region::where('name', $name)->first(); // requette pour récupérer la région à partir du table région
            $region = $reg->id; // récupération de l'id du région
            
            for ($j=1; $j < sizeof($csv_header_fields); $j++) { // boucler suivant le nombre de la colonne pour recupérer les valeurs pour l'insertion des données dans le resultat région
                $resultRegion = ResultRegion::firstOrCreate([
                    'id_region' => $region,
                    'id_indicator' => $indicatorIds[$csv_header_fields[$j]],
                    'value' => str_replace(",",".",$csv_data[$i][$csv_header_fields[$j]]),
                    'year' => $year
                ]); // vérification si le résultat région existe déjà sinon insérer dans le database
                
            }
        }

        $timeend=microtime(true); // temps de fin de l'importation du csv
        $time=$timeend-$timestart; // calcul du temps total
        $page_load_time = number_format($time, 3); // arrondir le temps total avec trois chiffer après virgule 

        echo "<p class='text-primary' style='font-weight: bold'>Importation effectuée avec succès! (" . (sizeof($csv_data) + 1) . " lignes au total, la requête a pris " . $page_load_time . " secondes.)</p>"; // affichage du message de succès
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
