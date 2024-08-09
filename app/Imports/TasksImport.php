<?php

namespace App\Imports;

use App\Models\Task;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class TasksImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Task([
            'title' => $row['title'],
            'description' => $row['description'],
            'status' => $row['status'],
            'user_id' => $row['user']
        ]);
    }
}
