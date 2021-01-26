<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MainService;
use Alert;
use Session;
use App\Models\Members;
use Excel;
use Illuminate\Support\Facades\Redirect;
use Rap2hpoutre\FastExcel\FastExcel;

class MainController extends Controller
{
     /**
     * @var $mainService
     */
    protected $mainService;

    /**
     *  MainController constuctor.
     * 
     * @param MainService $mainService
     */
    public function __construct(MainService $mainService)
    {
        $this->mainService = $mainService;
    }

    public function home(Request $request){
        $immo_list = $this->mainService->getRecord();
        return view('home')->with('immo_list',$immo_list);
    }
    public function saveData(Request $request)
    {
        if($this->mainService->saveData($request->all())){
            alert()->success('Success', 'Data Saved Successfully');
        }
        else{
            alert()->warning('Warning','Data not Saved Successfully');
        }
        return back();
    }
    public function history(){
        // dd($data);
        $call_list = $this->mainService->getAllCallList();
        return view('history')->with('call_list',$call_list);
    }
    public function call($id){
        $immo_list = $this->mainService->getRecord($id);
        return view('home')->with('immo_list',$immo_list);
    }
    public function searchCall(Request $request){
        $call_list = $this->mainService->getAllCallList($request->all());
        return view('history')->with('call_list',$call_list);
    }
    public function checkPhonePage(){
        return view('checkPhoneNumber');
    }
    public function checkPhoneNumber(Request $request){
        if(!empty($this->mainService->checkPhoneNumber($request->tel))){
            alert()->warning('Warning',"Doppelter Eintrag: Nummer bereits in Datenbank erfasst.");
            return back();
        } 
        return back()->with( [ 'phone' => $request->tel ] );  
    }
    public function insertImmoData(Request $request){
        $result = $this->mainService->insertImmoData($request->all());
        if($result=="success"){
            alert()->success('Success', 'Ok: Nummer in Datenbank gespeichert.');
            return back();
        }
        return back()->withErrors($result)->with( [ 'validate' => true ] )->withInput();
    }
    public function exportPage(){
        return view('exportPage');
    }
    public function exportXls(Request $request)
    {
        $result = $this->mainService->export($request->all());
        if(!$result){
            return back();
        }
        return Excel::download($result, 'list.xls');
    }
    public function plzgroup(){
        $cc_users = $this->mainService->getCcUsers();
        $plz_groups = $this->mainService->getPlzGroups();
        $pg_members = $this->mainService->getPgMembers();
        $addr_count = $this->mainService->getAddressCount();
        return view('plzgroup')->with('cc_users',$cc_users)->with('plz_groups',$plz_groups)->with('pg_members',$pg_members)->with('addr_count',$addr_count);
    }
    public function savePgMember(Request $request){
        $result = $this->mainService->savePgMember($request->all());
        if($result=="success"){
            alert()->success('success','User zur PLZ Gruppe hinzugefügt.');
            return back();
        }
        $errorMess = '';
        foreach($result->errors()->toArray() as $item){
            $errorMess.=$item[0];
        }
        alert()->warning('warning',$errorMess);
        return back();
    }
    public function delPgMember(Request $request){
        return $this->mainService->deletePgMember($request->all());
    }
    public function refreshAddresses(){
        return $this->mainService->refreshAddresses();
    }
    public function recoverAddresses(){
        return $this->mainService->recoverAddresses();
    }
    public function manage(Request $request){
        $myAgents = $this->mainService->getMyAgents();
        $shootings = $this->mainService->getShootings($request->all());
        $estateAgents = $this->mainService->getFollowers(true);
        $status = [
            "20" => 'neu',
            "21" => 'abgesagt',
            "22" => 'bestätigt',
            "23" => 'zurückgewiesen',
            "25" => 'Objekt ja',
            "26" => 'Objekt offen',
            "27" => 'Objekt nein'
        ];
        $colors[20] = 'F2F5A9';
	    $colors[21] = 'FFDDDD';
        $colors[22] = '81F79F';
        $colors[23] = 'FFDDDD';
        $colors[25] = '00FF40';
        $colors[26] = 'FFFF00';
        $colors[27] = 'FF0040';
        $colors[8] = 'CCCCCC';
        $colors[9] = '999999';
        $filteragent = isset($request->filteragent) ? $request->filteragent : '';
        $selectedStatus = isset($request->status) ? $request->status : '';
        return view('manage',['myAgents'=>$myAgents,'status'=>$status,'shootings'=>$shootings,'estateAgents'=>$estateAgents,'colors'=>$colors,'filteragent'=>$filteragent,'selectedStatus'=>$selectedStatus]);
    }
    public function details($id){
        $result = $this->mainService->getImmoDetail($id);
        if(empty($result)){
            return Redirect::to('/');
        }
        $title = $this->mainService->getDetailsTilte();
        return view('details',['details'=>$result,'title'=>$title]);    
    }
    public function updateImmoData(Request $request){
        $result = $this->mainService->updateImmoData($request->all());
        if($result =='success'){
            return 'success';
        }
        return response()->json(['error' => $result]);
    }
    public function adminPage(){
        $result = $this->mainService->getReport();
        return view('adminPage',['report'=>$result]);
    }
    public function report(Request $request){
        $result = $this->mainService->getDataByIdStatus($request->all());
        return view('report',['report'=>$result]);
    }
    public function updateHistory(Request $request){
        return $this->mainService->updateHistory($request->all());
    }
    public function region(){
        $result = $this->mainService->getUserZipList();
        $agents = $this->mainService->getAllAgents();
        return view('region',['data'=>$result,'agents'=>$agents]);
    }
    public function savePlzUser(Request $request){
        if($this->mainService->savePlzUser($request->all())){
            alert()->success('success','success');
        }
        else{
            alert()->warning('warning','warning');
        }
        return back();
    }
}
