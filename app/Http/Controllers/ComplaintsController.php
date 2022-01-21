<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Complaint;
use App\Models\User;
use App\Jobs\SendEmailJob;
use Datatables;

 
class ComplaintsController extends Controller
{

    public function index()
    {
        $csrs = User::where('role_id' , 2)->get();

        if(request()->ajax()) {
            return datatables()->of(Complaint::select('*'))
            ->addColumn('action', 'listings.admin_action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('listings.get_all_complaints', compact('csrs'));
    }
    public function CsrActiveComplaints()
    {
        if(request()->ajax()) {
            return datatables()->of(Complaint::where(['status' => 'active' , 'assigned_to' => auth()->user()->id])->get())
            ->addColumn('action', 'listings.csr_action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('listings.assigned_complaints');
    }

    public function CsrResolvedComplaints()
    {
        if(request()->ajax()) {
            return datatables()->of(Complaint::where(['status' => 'resolved' , 'assigned_to' => auth()->user()->id])->get())
            ->addColumn('action', 'listings.csr_action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }
        return view('listings.assigned_complaints');
    }

    public function store(Request $request)
    {  
        $user = User::find($request->assigned_to);
        $conmlaintId = $request->id;
        $complaint = Complaint::updateOrCreate(
            [
                'id' => $conmlaintId
            ],
            [
            'assigned_by' => auth()->user()->id,
            'status' => 'active', 
            'assigned_to' => $request->assigned_to,
            ]); 

        dispatch(new SendEmailJob($user,'Yours havebeen assigned a Complaint'));                 
        return Response()->json($complaint);
 
    }

    public function edit(Request $request)
    {   
        $where = array('id' => $request->id);
        $complaint  = Complaint::where($where)->first();
        return Response()->json($complaint);
    }

    public function resolved(Request $request)
    {   
        $user = User::find(2);
        $conmlaintId = $request->id;
        $complaint = Complaint::updateOrCreate(
            [
                'id' => $conmlaintId
            ],
            [
                'status' => 'resolved', 
            ]); 
               
        dispatch(new SendEmailJob($user,'Yours complaint Has been Resolved'));                 
        return Response()->json($complaint);
    }

    public function destroy(Request $request)
    {
        $complaint = Complaint::where('id',$request->id)->delete();
        return Response()->json($complaint);
    }
}