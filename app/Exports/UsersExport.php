<?php

namespace App\Exports;

use App\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromQuery, WithHeadings
{
    use Exportable;
    
    public function exportUsers(int $type){
        $this->type = $type;

        return $this;
    }

    public function query(){
        switch ($this->type) {
            case 1:
                    return User::query()->select('id_role', 'name', 'email')->withTrashed()->where('id_employee', '=', null);
                break;

            case 2:
                    return User::query()->select('id_role', 'name', 'email');
                break;
            
            default:
                    return User::query()->select('name', 'email');
                break;
        }
    }

    public function headings(): array
    {
        return ["id_role" => "rol", "name", "email"];
    }
}
