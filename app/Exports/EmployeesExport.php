<?php

namespace App\Exports;

use App\Models\Administracion\Employee;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class EmployeesExport implements FromQuery, WithHeadings
{
    use Exportable;
    
    public function exportEmployees(int $type){
        $this->type = $type;

        return $this;
    }

    public function query(){
        switch ($this->type) {
            case 1:
                    return Employee::query()->select('nombre', 'paterno', 'materno')->withTrashed();
                break;

            case 2:
                    return Employee::query()->select('nombre', 'paterno', 'materno');
                break;

            case 3:
                    return collect();
                break;
            
            default:
                    return Employee::query()->select('nombre', 'paterno', 'materno');
                break;
        }
    }

    public function headings(): array
    {
        return ["nombre", "paterno", "materno", "fuente"];
    }
}
