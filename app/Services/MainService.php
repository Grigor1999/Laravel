<?php

namespace App\Services;

use App\Repositories\MainRepository;
use App\Helpers\Helper;
use App\Notifications\SendManage;
use Illuminate\Notifications\Notification as NotificationsNotification;
use Illuminate\Support\Facades\Auth;
use Validator;
use Notification;

class MainService
{
    /**
     * @var $mainRepository
     */
    protected $mainRepository;

    /**
     *  HomeService constuctor.
     * 
     * @param MainRepository $mainRepository
     */
    public function __construct(MainRepository $mainRepository)
    {
        $this->mainRepository = $mainRepository;
    }
    public function getRecord($id = null)
    {
        return $this->mainRepository->getAllData($id);
    }
    public function saveData($data)
    {
        if ($data['status'] == 10) {
            $next = Helper::transformTimeFormat($data['next']);
        } elseif ($data['status'] == 12) {
            $next = time() + (5 * 60 * 60);
            $next = '"' . date('Y-m-d H:i:s', $next) . '"';
        } elseif ($data['status'] == 8 || $data['status'] == 9) {
            if (strlen($data['next']) > 4) {
                $next = '"' . Helper::transformTimeFormat($data['next']) . '"';
            } else {
                $next = time() + (1.5 * 60 * 60);
                $next = '"' . date('Y-m-d H:i:s', $next) . '"';
            }
        } else {
            $next = Null;
        }
        $data['next'] = $next;
        if (strlen($data['meeting_timestamp']) > 3)
            $data['meeting_timestamp'] = '"' . Helper::transformTimeFormat($data['meeting_timestamp']) . '"';
        if (strlen($next) > 3) {
            $data['next'] = '"' . Helper::transformTimeFormat($data['next']) . '"';
            $data['lock_until'] = $data['next'];
        }
        $data['last_user'] = Auth::id();
        $data['last_update'] = date('Y-m-d H:i:s');
        $remarks = $data['remarks'];
        unset($data['_token']);
        unset($data['remarks']);
        if ($this->mainRepository->update($data)) {
            return $this->mainRepository->saveHistory($data['ID'], $remarks, $data['status'], $data);
        }
        return false;
    }
    public function getAllCallList($data = [])
    {
        return $this->mainRepository->getAllCallList($data);
    }
    public function checkPhoneNumber($tel)
    {
        $tel = Helper::getDigits($tel);
        return $this->mainRepository->findImmoByPhone($tel);
    }
    public function insertImmoData($data)
    {
        $validator = Validator::make(
            $data,
            [
                'Anrede' => 'required',
                'Firstname' => 'required',
                'Lastname' => 'required',
                'CompanyName' => 'required',
                'Email' => 'required|email',
                'Telephone' => 'required|min:11|numeric',
                'Telephone2' => 'required|min:11|numeric',
                'PropertyType' => 'required',
                'object_street' => 'required',
                'object_zip' => 'required|numeric',
                'Price' => 'required|numeric',
                'NumberOfRooms' => 'required|numeric',
                'LivingSpace' => 'required|numeric',
                'Quelle' => 'required'
            ]
        );
        if ($validator->fails()) {
            return $validator;
        }
        if (isset($data['object_zip']) && strlen(trim($data['object_zip'])) < 5) {
            $data['object_zip'] = Auth::user()->PLZ;
        }
        if (isset($data['Telephone'])) {
            $data['Telephone'] = Helper::getDigits($data['Telephone']);
        }
        if (isset($data['Telephone2'])) {
            $data['Telephone2'] = Helper::getDigits($data['Telephone2']);
        }
        $data['last_user'] = Auth::id();
        $data['status'] = 11;
        $remarks = $data['remarks'];
        unset($data['_token']);
        unset($data['remarks']);
        if ($this->mainRepository->saveData($data)) {
            $last_id = $this->mainRepository->saveData($data)->id;
            return $this->mainRepository->saveHistory($last_id, $remarks, 11, $data) ? 'success' : 'error';
        }
    }
    public function export($data)
    {
        $validator = Validator::make(
            $data,
            [
                'from' => 'required',
                'to' => 'required',

            ]
        );
        if ($validator->fails()) {
            return false;
        }
        $data['to'] = Helper::transformTimeFormat($data['to']);
        $data['from'] = Helper::transformTimeFormat($data['from']);
        return $this->mainRepository->findDatabyDate($data);
    }
    public function getCcUsers()
    {
        return $this->mainRepository->getCcUsers();
    }
    public function getPlzGroups()
    {
        return $this->mainRepository->getPlzGroups();
    }
    public function savePgMember($data)
    {
        $validator = Validator::make(
            $data,
            [
                'cc_member_id' => 'required',
                'cc_pg_name' => 'required',

            ]
        );
        if ($validator->fails()) {
            return $validator;
        }
        return $this->mainRepository->savePgMember($data);
    }
    public function getPgMembers()
    {
        return $this->mainRepository->getPgMembers();
    }
    public function getAddressCount()
    {
        return $this->mainRepository->getAddressCount();
    }
    public function deletePgMember($data)
    {
        return $this->mainRepository->deletePgMember($data);
    }
    public function refreshAddresses()
    {
        return $this->mainRepository->refreshAddresses();
    }
    public function recoverAddresses()
    {
        return $this->mainRepository->recoverAddresses();
    }
    public function getMyAgents()
    {
        return $this->mainRepository->getAgentsById(Auth::id());
    }
    public function getShootings($data)
    {
        $agent = (isset($data['filteragent']) && !empty($data['filteragent'])) ? $data['filteragent'] : false;
        $status = (isset($data['status']) && !empty($data['status'])) ? $data['status'] : false;
        return $this->mainRepository->getShootings($status, $agent);
    }
    public function getFollowers($onlyAgents = false, $onlyCC = false, $fields = '*')
    {
        return $this->mainRepository->getFollowers(true);
    }
    public function getImmoDetail($id = null)
    {
        return $this->mainRepository->getAllData($id);
    }
    public function getDetailsTilte()
    {
        $title['sho_makler'] = 'Name des ADM';
        $title['sho_eigentuemer'] = 'Name des Gesprächspartners (immer buchstabieren lassen!) "Wer ist der Eigentümer und wer kümmert sich um das Objekt (Mann, Frau, Tochter etc.)?';
        $title['sho_besichtigen'] = '"Darf unser Mitarbeiter besichtigen?"';
        $title['sho_besichtigen_diese_woche'] = 'bei "Ja": Dürfen wir diese Woche besichtigen?';
        $title['sho_bonitaet'] = 'bei Mietwohnung: "Möchten Sie auch den Bonitäts-Check durchführen lassen? Der ist kostenfrei für Sie und sichert vor Mietnomaden!"';
        $title['sho_fotos'] = '"Können wir Innenfotos schiessen & ein Expose erstellen?"';
        $title['meeting_City'] = 'In welcher Stadt steht Ihr Objekt? In meinen Unterlagen steht XY Stadt. Stimmt das?';
        $title['meeting_zip'] = 'PLZ';
        $title['sho_ortsteil'] = 'Und in welchem Ortsteil?';
        $title['meeting_street'] = 'Strasse (IMMER buchstabieren lassen!), Nummer?';
        $title['sho_bezugsfrei'] = '"Wann wird das Objekt bezugsfrei?"';
        $title['sho_preis'] = 'Kaltmiete / Preis (IMMER bestätigen lassen!):';
        $title['sho_erreichbar'] = '"VON wann BIS wann können wir Sie immer unter dieser Nr. erreichen?"';
        $title['sho_anderetel'] = '"Sind Sie auch unter einer anderen Tel.nr. (z.B. mobil) erreichbar (IMMER abfragen, falls nicht vorhanden!)?"';
        $title['sho_inseriert'] = '"WO wird das Objekt gerade überall inseriert?"';
        $title['sho_inseriert_internet'] = 'bei Internet: "WO genau (um herauszubekommen, ob Immoscout dabei ist)?"';
        $title['sho_inseriert_immoscout'] = 'Wenn Immoscout genannt wurde ((Laufzeit der Anzeige, bis (Datum))?';
        $title['sho_inseriert_zufrieden'] = '"Wie sind Sie mit der Resonanz der Werbung (auch wenn Zeitung genannt wurde) zufrieden?"';
        $title['sho_inseriert_immoscout_nein'] = 'bei Immoscout NEIN: Können wir Sie unterstützen und Immoscout gleich übernehmen?';
        $title['sho_besichtigung'] = '"Haben Sie demnächst noch eine Besichtigung?"';
        $title['sho_makler_angerufen'] = '"Haben Makler auch schon bei Ihnen angerufen?"';
        $title['sho_makler_zusammenarbeit'] = 'Arbeiten Sie bereits mit einem (Makler-)Kollegen zusammen oder nicht?" Bei "JA": Anzahl?';
        $title['sho_makler_werbung'] = '"Wird Ihre Immobilie durch den /die (Makler-) Kollegen im Internet beworben?" Bei "Ja": Wo?';
        $title['sho_makler_alleinauftrag'] = 'bei "JA": "Haben Sie einen Alleinauftrag (j / n)?"';
        $title['sho_einheiten'] = 'bei Wohnungen: "Wie viele Wohneinheiten hat das gesamte Gebäude?"';
        $title['sho_andere_objekte'] = 'Dann: Gehören Ihnen diese Einheiten oder haben Sie noch andere Objekte?';
        $title['sho_bestaetigung'] = 'Unser ADM wird sich kurzfristig melden, Fotos aufnehmen und aktiv, auch im INTERNET, werben. Sie sind damit einverstanden?';
        return $title;
    }
    public function updateImmoData($data)
    {
        $orig_immo = $this->mainRepository->getAllData($data['ID']);
        $orig_meeting_user = $orig_immo->meeting_user;
        if ($data['status'] == 23) {
            $data['meeting_user'] = $orig_immo->meetingUser->leader;
        }
        if (date('d.m.Y H:i', strtotime($orig_immo->meeting_timestamp)) != $data['meeting_timestamp'] && strtotime($data['meeting_timestamp']) < time()) {
            return 'Meeting Datum/Zeit verändert und neuer Zeitpunkt liegt in der Vergangenheit. ';
        } elseif (($data['status'] == 21 || $data['status'] == 23 || $data['status'] == 26 || $data['status'] == 27) && strlen(trim($data['remarks'])) < 5) {
            // Diese Stati verlangen nach einem Kommentar.
            return 'Dieser Status verlangt nach einem Kommentar / Grund.';
        }
        $remarks = str_replace("'", '', $data['remarks']);
        unset($data['_token']);
        unset($data['remarks']);
        if ($data['status'] == 80 || $data['status'] == 81) {
            $data['next'] = date('Y-m-d H:i:s', time());
        }
        if (strlen($data['meeting_timestamp']) > 3) {
            $data['meeting_timestamp'] = '"' . Helper::transformTimeFormat($data['meeting_timestamp']) . '"';
        }
        if ($this->mainRepository->update($data)) {
            $immo = $this->mainRepository->getAllData($data['ID']);
            // $this->sendManageEmails($immo,$orig_meeting_user);
            return 'success';
        };
    }
    public function sendManageEmails($data, $orig_meeting_user)
    {
        $email = 'christian.ammann@century21.de, nalan.keles@century21.de';

        if ($data->meeting_user != $orig_meeting_user) {
        }

        $when = now()->addSecond(1);
        Notification::route('mail', 'taylor@example.com')
            ->notify((new SendManage())->delay($when));
    }
    public function getReport($days = 14)
    {
        $result = $this->mainRepository->getReport($days);
        $arr = array();
        foreach ($result as $key => $item) {
            $arr[$item->date][$item->member_id] = $item;
        }
        return $arr;
    }
    public function getDataByIdStatus($data)
    {
        return $this->mainRepository->getDataByIdStatus($data);
    }
    public function updateHistory($data){
        unset($data['_token']);
        $data['status'] = 11;  
        if($this->mainRepository->update($data)){
           return $this->mainRepository->saveHistory($data['ID'], 'Adresse NEU', 11, array());
        }
        return 0;
    }
    public function getUserZipList(){
        return $this->mainRepository->getUserZipList(Auth::id());
    }
    public function getAllAgents(){
        return $this->mainRepository->getAllAgents();
    }
    public function savePlzUser($data){
        $sho_members = $data['agent'];
        foreach($data['plzlist'] as $this_plz) {
			if (array_key_exists($this_plz, $data['active']))
				$active = 1;
			else
                $active = 0;
            if(!$this->mainRepository->saveMemberPlzActive(Auth::id(), $this_plz, $active, $sho_members[$this_plz])){
                return false;
            }    
			
        }
        return true;
    }
}
