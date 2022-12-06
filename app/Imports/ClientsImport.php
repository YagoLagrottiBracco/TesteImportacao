<?php

namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\Importable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\WithChunkReading;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Validator;

class ClientsImport implements ToModel, WithChunkReading, ShouldQueue
{
    use Importable;

    private $rowNumber = 1;

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $row[5] = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]);

        Validator::make($row, [
            '0' => 'required',
            '1' => 'required|email',
            '2' => 'required|integer|unique:clients,document',
            '3' => 'required',
            '4' => 'required|size:2',
            '5' => 'required|date',
        ],[
            '0.required' => 'The name of row ' . $this->rowNumber . ' is required',
            '1.required' => 'The email of row ' . $this->rowNumber . ' is required',
            '1.email' => 'The email of row ' . $this->rowNumber . ' is is not a valid email',
            '2.required' => 'The document of row ' . $this->rowNumber . ' is required',
            '2.integer' => 'The document of row ' . $this->rowNumber . ' is not a valid integer',
            '2.unique' => 'The document of row ' . $this->rowNumber . ' has already been taken.',
            '3.required' => 'The city of row ' . $this->rowNumber . ' is required',
            '4.required' => 'The state of row ' . $this->rowNumber . ' is required',
            '4.size' => 'The state of row ' . $this->rowNumber . ' must have maximum of 2 characters',
            '5.required' => 'The start date of row ' . $this->rowNumber . ' is required',
            '5.date' => 'The start date of row ' . $this->rowNumber . ' is not a valid date',
        ])->validate();

        $this->rowNumber++;

        return new Client([
            'name' => $row[0],
            'email' => $row[1],
            'document' => trim(str_replace(".", "", $row[2])),
            'city' => $row[3],
            'state' => $row[4],
            'start_date' => $row[5],
        ]);
    }

    public function chunkSize(): int
    {
        return 1000;
    }
}
