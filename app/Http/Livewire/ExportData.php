<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ExportInfo;
use Maatwebsite\Excel\Excel;
use App\Exports\ExportInformation;

class ExportData extends Component
{
    public $selected=[];
    public $selectall=false;

    public $search='';
    protected $queryString=['search'];

    public function render()
    {

        $datas=ExportInfo::where('last_name','like',"%{$this->search}%")
        ->orWhere('first_name','like',"%{$this->search}%")
        ->orWhere('email','like',"%{$this->search}%")
        ->latest()->get();
        return view('livewire.export-data',
            compact('datas'));
    }

    public function selectAll(){
        if($this->selectall){
        $this->selectall=true;
        $this->selected=ExportInfo::pluck('id')->toArray();
        }
        else{
           $this->selectall=false;
           $this->selected=[];

        }
        return $this->selected;
     }


    public function exportToSvc(){


        if ($this->isArrayEmpty()) {
            return;
        }
        session()->flash('download','Download has started successfully');

        return (new ExportInformation($this->selected))->download('fileSvc_' . date('Y-m-d') . '_' . now()->toTimeString() . '.csv', Excel::CSV);

    }

    public function exportToPdf(){
        if ($this->isArrayEmpty()) {
            return;
        }
        session()->flash('download','Download has started successfully');

        return (new ExportInformation($this->selected))->download('filePdf_' . date('Y-m-d') . '_' . now()->toTimeString() . '.pdf', \Maatwebsite\Excel\Excel::DOMPDF);


    }

    public function exportToXsl(){
        if ($this->isArrayEmpty()) {
            return;
        }
        session()->flash('download','Download has started successfully');

        return (new ExportInformation($this->selected))->download('fileXsl_' . date('Y-m-d') . '_' . now()->toTimeString() . '.xlsx');


    }


    public function isArrayEmpty(){
        if($this->selected){
            return false;
        }
        session()->flash('message', 'Please select at least one row to export data');

        return true;

    }


}
