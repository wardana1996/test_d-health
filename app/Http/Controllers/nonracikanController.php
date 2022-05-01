<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\NonRacikan;
use App\Models\Obatalkes_m;
use App\Models\Signa_m;
use App\Http\Requests\nonracikanRequest;
use DataTables;
use DB;
use PDF;

class nonracikanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = NonRacikan::join('obatalkes_m', 'non_racikan.obat_id','obatalkes_m.obatalkes_id')
            ->join('signa_m', 'non_racikan.resep_id','signa_m.signa_id');
            return Datatables::eloquent($data)
            ->addIndexColumn()
            ->addColumn('action', function($row) {
                $btn = '<a class="btn btn-outline-danger rounded-pill" href="/non_racikan/pdf/'.$row->id.'" target="_blank" data-id='.$row->id.'><i class="fa fa-file-pdf-o" aria-hidden="true"></i> Cetak Resep</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }
        return view('non_racikan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

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

    public function getQty(Request $request, $obat_id){
        $qty = Obatalkes_m::where('obatalkes_id', $obat_id)->first();
    
        return response()->json($qty); 
    } 

    public function create(nonracikanRequest $request)
    {
        DB::beginTransaction();
        
        $nonracikan = new NonRacikan();
        $nonracikan->obat_id =  $request->obat_id;
        $nonracikan->resep_id =  $request->resep_id;
        $nonracikan->qty =  $request->qty;
        $nonracikan->save();

        if (!$nonracikan) {
            DB::rollback();
        }

        $stockMaster = Obatalkes_m::where('obatalkes_id',$request->obat_id)->first();

        $stock = Obatalkes_m::where('obatalkes_id',$request->obat_id)->update([
            'stok' => intval($stockMaster['stok']) - $request->qty
        ]);

        if (!$stock) {
            DB::rollback();
        }

        DB::commit();
        return response()->json(['message'=>'success !']);
    }

    public function pdf($id)
    {
        $obat = NonRacikan::join('obatalkes_m', 'non_racikan.obat_id','obatalkes_m.obatalkes_id')
        ->join('signa_m', 'non_racikan.resep_id','signa_m.signa_id')
        ->find($id);

 
    	$pdf = PDF::loadview('resep_non_racikan',['obat'=>$obat]);
    	return $pdf->download('resep-non-racikan-pdf');
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
