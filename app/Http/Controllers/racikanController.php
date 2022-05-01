<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Racikan;
use App\Models\Obatalkes_m;
use App\Models\Signa_m;
use App\Http\Requests\racikanRequest;
use DataTables;
use DB;
use PDF;

class racikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Racikan::join('signa_m', 'racikan.resep_id','signa_m.signa_id');
            return Datatables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a class="btn btn-outline-danger rounded-pill" href="/racikan/pdf/'.$row->id.'" target="_blank" data-id='.$row->id.'><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Cetak Resep</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('racikan');
    }

    public function getObat(Request $request){
        $data = [];

        $search = $request->search;
        if($search == ''){
            $data =Obatalkes_m::select("obatalkes_id","obatalkes_nama","stok") ->get();
        }else{
           $data = Obatalkes_m::where('obatalkes_nama', 'like', '%' .$search . '%')->get();
        }

        return response()->json($data);
    } 

    public function getResep(Request $request){
        $data = [];

        $search = $request->search;
        if($search == ''){
            $data =Signa_m::select("signa_id","signa_nama") ->get();
        }else{
           $data = Signa_m::where('signa_nama', 'like', '%' .$search . '%')->get();
        }

        return response()->json($data);
    } 

    public function getQty(Request $request, $obat_racikan){
        $qty = Obatalkes_m::where('obatalkes_nama', $obat_racikan)->first();
    
        return response()->json($qty); 
    } 

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(racikanRequest $request)
    {
        $sum = 0;
        $racikan = new Racikan();
        $racikan->obat_racikan = implode(', ', $request['obat_racikan']);
        $racikan->racikan_name =  $request->racikan_name;
        $racikan->resep_id =  $request->resep_id;
        foreach ($request['qty'] as $qtys) {
            $racikan->qty = $sum += $qtys;
        }
        $racikan->save();

        $myArray = explode(',', $racikan->obat_racikan);

        $stockMasters = Obatalkes_m::whereIn('obatalkes_nama', $myArray)->get();

        foreach ($stockMasters as $stockMaster) {
            foreach ($request['qty'] as $qtys) {
                $stock = Obatalkes_m::whereIn('obatalkes_nama', $myArray)->update([
                    'stok' => intval($stockMaster->stok) - (int)$qtys
                ]);
            }
        }
       
        return response()->json(['message'=>'success !']);
    }

    public function pdf($id)
    {
        $obat = Racikan::join('signa_m', 'racikan.resep_id','signa_m.signa_id')
        ->find($id);

    	$pdf = PDF::loadview('resep_racikan',['obat'=>$obat]);
    	return $pdf->download('resep-racikan-pdf');
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
