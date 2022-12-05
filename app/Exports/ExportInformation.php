<?php

namespace App\Exports;

use App\Models\ExportInfo;
use App\Http\Livewire\ExportData;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportInformation implements FromCollection,WithHeadings, ShouldAutoSize,WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    protected $selected;

    public function  __construct(array $selected)
    {
        $this->selected = $selected;
    }

    public function collection()
    {
        return ExportInfo::whereIn('id',$this->selected)->select('id','first_name','last_name','gender','email')->get();


    }

    public function headings() :array
    {
        return ["Id", "First Name", "Last Name","Gender","Email"];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class=> function(AfterSheet $event) {
                $cellRange = 'A1:E1';
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(12);
            },
        ];
    }



}
