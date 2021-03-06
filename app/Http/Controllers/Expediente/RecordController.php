<?php

namespace App\Http\Controllers\Expediente;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Models\Administracion\Employee;
use App\Models\Administracion\JobPosition;
use App\Models\Expediente\Record;
use App\Models\Expediente\RecordFormation;
use App\Models\Expediente\RecordLastJobs;
use App\Models\Expediente\RecordReferences;
use App\Models\Expediente\RecordFamilyEnterprise;
use App\Models\Expediente\RecordOrganizationSyndicate;
use App\Models\Expediente\RecordFilesRegister;
use App\Models\Expediente\RecordPolicy;
use App\Models\Expediente\RecordMedical;
use DB;
use Redirect;

class RecordController extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
        $this->middleware('auth');
        $this->folderImageUser = 'users';
        $this->folderFileProofAddress = 'employees_proof';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $user = Auth::user();
        $employee_info = "";
        $data_family_enterprise = array();

        $records_info = "";
        $record_formation_info = "";
        $record_lastJob_info = "";
        $record_references_info = "";
        $record_family_enterprise_info = "";
        $record_syndicate_info = "";
        $record_files_register = "";
        $record_info_jobposition = "";
        $record_info_policies = "";
        $record_info_medicals = "";

        $all_employee = Employee::orderBy('Nombre', 'ASC')->get();

        if(! is_null($user->id_employee)) {
            $employee_info = Employee::withTrashed()->where('id', $user->id_employee)->get();
            $records_info = Record::withTrashed()->where('id_employee', $user->id_employee)->get();
            $record_formation_info = RecordFormation::where('id_record', $records_info[0]->id)->get();
            $record_lastJob_info = RecordLastJobs::where('id_record', $records_info[0]->id)->get();
            $record_references_info = RecordReferences::where('id_record', $records_info[0]->id)->get();
            $record_family_enterprise_info = RecordFamilyEnterprise::where('id_record', $records_info[0]->id)->get();
            $record_syndicate_info = RecordOrganizationSyndicate::where('id_record', $records_info[0]->id)->get();

            $data_family_enterprise = array();
            foreach($record_family_enterprise_info as $dato){
                $array = array();
                $array['id'] = $dato['id_family'];
                $array['name'] = $dato->employee->nombre . ' ' . $dato->employee->paterno . ' ' . $dato->employee->materno;
                $array['family_type'] = $dato['family_type'];
                array_push($data_family_enterprise, $array);
            }

            $record_files_register = RecordFilesRegister::where('id_record', $records_info[0]->id)->get();
            $record_info_jobposition = JobPosition::where('name', $employee_info[0]->puesto)->get();
            $record_info_policies = RecordPolicy::where('id_record', $records_info[0]->id)->get();
            $record_info_medicals = RecordMedical::where('id_record', $records_info[0]->id)->get();
        }
        //dd($record_info_medicals);
        $data = [
            'employee_info' => $employee_info,
            'records_info' => $records_info,
            'all_employee' => $all_employee,
            'record_formation_info' => $record_formation_info,
            'record_lastJob_info' => $record_lastJob_info,
            'record_references_info' => $record_references_info,
            'data_family_enterprise' => $data_family_enterprise,
            'record_syndicate_info' => $record_syndicate_info,
            'record_files_register' => $record_files_register,
            'record_info_jobposition' => $record_info_jobposition,
            'record_info_policies' => $record_info_policies,
            'record_info_medicals' => $record_info_medicals,
        ];
        return view('expediente.index', compact(['data']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function show(Record $record){
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function edit(Record $record){
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){
        $data = request()->except(['_token', '_method']);
        $data1 = request()->only(['street', 'external_number', 'internal_number', 'postal_code', 'city', 'government', 'myLanguage', 'myTools', 'mySistems', 'myFunctions', 'availability']);
        $data2 = request()->only(['especiality', 'level', 'status', 'center', 'period', 'file_proof', 'proofEducation']);
        $data3 = request()->only(['last_jobPosition', 'last_enterprise', 'last_period', 'last_salary', 'last_separation', 'last_myActivities']);
        $data4 = request()->only(['referenceName', 'referenceTel', 'referenceTime', 'referenceOcupation']);
        $data5 = request()->only(['familyID', 'familyType']);
        $data6 = request()->only(['organizationName']);
        //dd($data6);
        try {
            DB::beginTransaction();

                Record::withTrashed()->where('id_employee', $id)->update($data1);
                $record = Record::withTrashed()->where('id_employee', $id)->get();
                if($request->hasFile('filesImport')){
                    $path = $request->filesImport->store($this->folderFileProofAddress);
                    try {
                        Record::withTrashed()->where('id_employee', $id)->update(array(
                            'proof_address' => $path,
                        ));
                    } catch (\PDOException $e) {
                        DB::rollBack();
                        $errorsMessage = [
                            'fullMessage' => $e->getMessage(),
                        ];
                        return Redirect::back()->withErrors($errorsMessage);
                    }
                }

                if(!empty($data2['file_proof'])){
                    $lastRecordFormation = RecordFormation::where('id_record', $record[0]->id)->whereNotIn('proof', $data2['file_proof']);
                    $lastRecordFormation->delete();
                } else {
                    $lastRecordFormation = RecordFormation::where('id_record', $record[0]->id);
                    $lastRecordFormation->delete();
                }

                if(!empty($data2['especiality']) and !empty($data2['proofEducation'])){
                    foreach ($data2['especiality'] as $indice => $studio) {
                        $period = explode(' a ', $data2['period'][$indice]);

                        $formation = new RecordFormation;
                        $formation->id_employee = $id;
                        $formation->id_record = $record[0]->id;
                        $formation->especialization_area = $data2['especiality'][$indice];
                        $formation->level = $data2['level'][$indice];
                        $formation->status = $data2['status'][$indice];
                        $formation->center = $data2['center'][$indice];
                        $formation->period_init = $period[0];
                        $formation->period_end = $period[1];
                        if (isset($data2['proofEducation'][$indice+1])) {
                            if($path = $data2['proofEducation'][$indice+1]->store($this->folderFileProofAddress)){
                                $formation->proof = $path;
                            }
                        }
                        $formation->save();
                    }
                }

                if(!empty($data3['last_jobPosition'])){
                    $lastJobsPosition = RecordLastJobs::where('id_record', $record[0]->id)
                                                        ->whereNotIn('last_jobPosition', $data3['last_jobPosition'])
                                                        ->whereNotIn('last_enterprise', $data3['last_enterprise']);
                    $lastJobsPosition->delete();

                    foreach ($data3['last_jobPosition'] as $indice => $studio) {
                        $last_period = explode(' a ', $data3['last_period'][$indice]);

                        if(! RecordLastJobs::where('id_record', $record[0]->id)
                                            ->where('last_jobPosition', $data3['last_jobPosition'][$indice])
                                            ->where('last_enterprise', $data3['last_enterprise'][$indice])
                                            ->exists()) {
                            $lastJobs = new RecordLastJobs;
                            $lastJobs->id_employee = $id;
                            $lastJobs->id_record = $record[0]->id;
                            $lastJobs->last_jobPosition = $data3['last_jobPosition'][$indice];
                            $lastJobs->last_enterprise = $data3['last_enterprise'][$indice];
                            $lastJobs->period_init = $last_period[0];
                            $lastJobs->period_end = $last_period[1];
                            $lastJobs->salary = $data3['last_salary'][$indice];
                            $lastJobs->reason_separation = $data3['last_separation'][$indice];
                            $lastJobs->activities = $data3['last_myActivities'][$indice];
                            $lastJobs->save();
                        }
                    }
                } else {
                    $lastJobsPosition = RecordLastJobs::where('id_record', $record[0]->id);
                    $lastJobsPosition->delete();
                }

                if(!empty($data4['referenceName'])){
                    $recordReferences = RecordReferences::where('id_record', $record[0]->id)
                                                        ->whereNotIn('references_name', $data4['referenceName']);
                    $recordReferences->delete();

                    foreach ($data4['referenceName'] as $indice => $studio) {

                        if(! RecordReferences::where('id_record', $record[0]->id)
                                            ->where('references_name', $data4['referenceName'][$indice])
                                            ->exists()) {
                            $recordReferences = new RecordReferences;
                            $recordReferences->id_employee = $id;
                            $recordReferences->id_record = $record[0]->id;
                            $recordReferences->references_name = $data4['referenceName'][$indice];
                            $recordReferences->references_phone = $data4['referenceTel'][$indice];
                            $recordReferences->references_time = $data4['referenceTime'][$indice];
                            $recordReferences->references_ocupation = $data4['referenceOcupation'][$indice];
                            $recordReferences->save();
                        }
                    }
                } else {
                    $recordReferences = RecordReferences::where('id_record', $record[0]->id);
                    $recordReferences->delete();
                }

                if(!empty($data5['familyID'])){

                    $recordFamilyEnterprise = RecordFamilyEnterprise::where('id_record', $record[0]->id)
                                                        ->whereNotIn('id_family', $data5['familyID']);
                    $recordFamilyEnterprise->delete();

                    foreach ($data5['familyID'] as $indice => $studio) {

                        if(! RecordFamilyEnterprise::where('id_record', $record[0]->id)
                                            ->where('id_family', $data5['familyID'][$indice])
                                            ->exists()) {
                            $recordFamily = new RecordFamilyEnterprise;
                            $recordFamily->id_employee = $id;
                            $recordFamily->id_record = $record[0]->id;
                            $recordFamily->id_family = $data5['familyID'][$indice];
                            $recordFamily->family_type = $data5['familyType'][$indice];
                            $recordFamily->save();
                        }
                    }
                } else {
                    $recordFamily = RecordFamilyEnterprise::where('id_record', $record[0]->id);
                    $recordFamily->delete();
                }

                if(!empty($data6['organizationName'])){

                    $recordOrganizations = RecordOrganizationSyndicate::where('id_record', $record[0]->id)
                                                        ->whereNotIn('name', $data6['organizationName']);
                    $recordOrganizations->delete();

                    foreach ($data6['organizationName'] as $indice => $studio) {

                        if(! RecordOrganizationSyndicate::where('id_record', $record[0]->id)
                                            ->where('name', $data6['organizationName'][$indice])
                                            ->exists()) {
                            $recordSyndicate = new RecordOrganizationSyndicate;
                            $recordSyndicate->id_employee = $id;
                            $recordSyndicate->id_record = $record[0]->id;
                            $recordSyndicate->name = $data6['organizationName'][$indice];
                            $recordSyndicate->save();
                        }
                    }
                } else {
                    $recordSyndicate = RecordOrganizationSyndicate::where('id_record', $record[0]->id);
                    $recordSyndicate->delete();
                }
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }

       return redirect('records')->with('success','Ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Record  $record
     * @return \Illuminate\Http\Response
     */
    public function destroy(Record $record){
        //
    }

    public function updateUserProfilePicture(Request $request, int $id) {
        try {
            DB::beginTransaction();
            if($request->hasFile('image')){
                $path = $request->image->store($this->folderImageUser);
                try {
                    Record::withTrashed()->where('id_employee', $id)->update(array(
                        'picture' => $path,
                    ));

                    User::withTrashed()->where('id_employee', $id)->update(array(
                        'picture' => $path,
                    ));
                } catch (\PDOException $e) {
                    DB::rollBack();
                    $errorsMessage = [
                        'fullMessage' => $e->getMessage(),
                    ];
                    return Redirect::back()->withErrors($errorsMessage);
                }
            }
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];
            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect('records')->with('success','Ok');
    }

    public function updateFilesProfile(Request $request, int $id) {
        $data = request()->except(['_token', '_method', 'type_file_c', 'text_file_c', 'expiration_date_c']);
        try {
            DB::beginTransaction();

                $record = Record::withTrashed()->where('id_employee', $id)->get();

                if(!empty($data['file_record'])){
                    $lastRecordFormation = RecordFilesRegister::where('id_record', $record[0]->id)->whereNotIn('proof', $data['file_record']);
                    $lastRecordFormation->delete();
                } else {
                    $lastRecordFormation = RecordFilesRegister::where('id_record', $record[0]->id);
                    $lastRecordFormation->delete();
                }

                if(!empty($data['proofRecord'])){
                    foreach ($data['type_record'] as $indice => $studio) {

                        $formation = new RecordFilesRegister;
                        $formation->id_employee = $id;
                        $formation->id_record = $record[0]->id;
                        $formation->type = $data['type_record'][$indice];
                        $formation->description = $data['text_record'][$indice];
                        $formation->expiration_date = $data['period_record'][$indice];
                        if (isset($data['proofRecord'][$indice+1])) {
                            if($path = $data['proofRecord'][$indice+1]->store($this->folderFileProofAddress)){
                                $formation->proof = $path;
                            }
                        }
                        $formation->save();
                    }
                }

            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }

        return redirect('records')->with('success','Ok');
    }

    public function updateHealth(Request $request, int $id) {
        $data = request()->except(['_token', '_method']);
        $data2 = request()->only(['last_policyType', 'last_policyCompany', 'last_policyNumber']);
        $data3 = request()->only(['medical_reason', 'medical_date', 'medicalExamFile', 'medicals_name']);
        //dd($data);
        try {
            DB::beginTransaction();
                $record = Record::withTrashed()->where('id_employee', $id)->get();

                Record::withTrashed()->where('id_employee', $id)->update(array(
                    'nss' => $data['health_nss_c'],
                    'blood' => $data['health_blood_c'],
                    'diseases' => $data['health_diseases_c'],
                    'allergy' => $data['health_allergy_c'],

                    'contact_name1' => $data['emergency_contact_name'],
                    'contact_phone1' => $data['emergency_contact_phone'],
                    'contact_patent1' => $data['emergency_contact_parent'],

                    'contact_name2' => $data['emergency_contact_name2'],
                    'contact_phone2' => $data['emergency_contact_phone2'],
                    'contact_patent2' => $data['emergency_contact_parent2'],

                ));

                if(!empty($data['last_policyType'])){
                    $lastPolicies = RecordPolicy::where('id_record', $record[0]->id)
                                                        ->whereNotIn('company', $data2['last_policyCompany'])
                                                        ->whereNotIn('number', $data2['last_policyNumber']);
                    $lastPolicies->delete();

                    foreach ($data['last_policyType'] as $indice => $studio) {

                        if(! RecordPolicy::where('id_record', $record[0]->id)
                                            ->where('type', $data2['last_policyType'][$indice])
                                            ->where('company', $data2['last_policyCompany'][$indice])
                                            ->where('number', $data2['last_policyNumber'][$indice])
                                            ->exists()) {
                            $policy = new RecordPolicy;
                            $policy->id_employee = $id;
                            $policy->id_record = $record[0]->id;
                            $policy->type = $data2['last_policyType'][$indice];
                            $policy->company = $data2['last_policyCompany'][$indice];
                            $policy->number = $data2['last_policyNumber'][$indice];
                            $policy->save();
                        }
                    }
                } else {
                    $lastPolicies = RecordPolicy::where('id_record', $record[0]->id);
                    $lastPolicies->delete();
                }

                if(!empty($data3['medicals_name'])){
                    $lastRecordMedical = RecordMedical::where('id_record', $record[0]->id)->whereNotIn('proof', $data3['medicals_name']);
                    $lastRecordMedical->delete();
                } else {
                    $lastRecordMedical = RecordMedical::where('id_record', $record[0]->id);
                    $lastRecordMedical->delete();
                }

                if(!empty($data3['medical_reason']) and !empty($data3['medicalExamFile'])){
                    foreach ($data3['medical_reason'] as $indice => $studio) {
                        $medical = new RecordMedical;
                        $medical->id_employee = $id;
                        $medical->id_record = $record[0]->id;
                        $medical->reason = $data3['medical_reason'][$indice];
                        $medical->date = $data3['medical_date'][$indice];
                        if (isset($data3['medicalExamFile'][$indice+1])) {
                            if($path = $data3['medicalExamFile'][$indice+1]->store($this->folderFileProofAddress)){
                                $medical->proof = $path;
                            }
                        }
                        $medical->save();
                    }
                }

            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];

            return Redirect::back()->withErrors($errorsMessage);
        }

        return redirect('records')->with('success','Ok');
    }
}
