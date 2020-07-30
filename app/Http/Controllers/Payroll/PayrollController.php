<?php

namespace App\Http\Controllers\Payroll;

use App\User;
use Illuminate\Http\Request;
use App\Models\Payroll\Payroll;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class PayrollController extends Controller
{
    /**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
        // $this->middleware('auth');
        $this->folderFilePayroll = 'payroll_files';
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administracion.payroll.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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
        try {
            DB::beginTransaction();

            if(!$request->hasFile('file')) {
                return redirect()->back()->with('warning', '');
            } else {  
                // $path = $request->file->store($this->folderFilePayroll);
                $ext = $request->file->getClientOriginalExtension();
                
                if(!($ext == 'xlsx')){
                    return redirect()->back()->with('warning', '');
                }

                \Excel::load($request->file->path(), function($reader) {
                    $tmp = $reader->all()->toArray();
                    // Aquí hacer función de descarte de repetidos
                    $new_tmp = $this->dropDuplicates($tmp);
                    //dd('Viejo:', $tmp, 'Nuevo:', $new_tmp);
                    // ===========================================
                    $this->insertData($new_tmp);    
                });

            } 
            DB::commit();
        } catch (\PDOException $e) {
            DB::rollBack();
            dd($e->getMessage());
            $errorsMessage = [
                'fullMessage' => $e->getMessage(),
            ];
            return Redirect::back()->withErrors($errorsMessage);
        }
        return redirect()->back()->with('success','Ok');
    }

    private function dropDuplicates(array $tmp) {
		$claves = array();
		$arr_count = 0;
		foreach($tmp as $temp_row) {
			if(!in_array($temp_row['clave'], $claves)) {
				$new_tmp[$arr_count] = $temp_row;
				$claves[$arr_count] = $temp_row['clave'];
				$arr_count += 1;
			} else {
				foreach($new_tmp as $key => $new_tmp_row) {
					if($temp_row['clave'] == $new_tmp_row['clave']) {
						$new_tmp[$key] = $temp_row;
					}
				}
			}
		}
		return $new_tmp;
	}

	private function insertData(array $payrollReceiptData){
		foreach ($payrollReceiptData as $data) {
			$user = User::where('id_employee', trim($data['clave']))->first();
			if(!is_null($user)) {
				$receipts = Payroll::where('user_id', $user->id)->where('type_period', $data['nomina'])->where('period', $data['periodo'])->where('company', $data['sucursal'])->where('year', $data['ano'])->exists();
				if($receipts){
					//Update
					Payroll::where('user_id', $user->id)->where('type_period', $data['nomina'])->where('period', $data['periodo'])->where('company', $data['sucursal'])->where('year', $data['ano'])->update([
						'file' => $data['archivo']
					]);
				}else{
					//Insert
					Payroll::insert([
						'user_id' => $user->id,
						'type_period' => $data['nomina'],
						'period' => $data['periodo'],
						'company' => $data['sucursal'],
						'year' => $data['ano'],
						'file' => $data['archivo']
					]);
				}
			}
		}
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
