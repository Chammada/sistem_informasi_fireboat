<?php

namespace App\Http\Controllers;

use App\Models\JenisBerkas;
use App\Models\SubJenisBerkas;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    
    public function sidebarData(){
        $this->data_jenis_berkas = JenisBerkas::get();
        $this->data_sub_jenis_berkas = SubJenisBerkas::get();

        $this->url = request()->path();
        $this->data_url = explode("/", $this->url);
    }

    public function view($view, $data = []){
        $this->sidebarData();
        
        if (count($this->data_url) < 2) {
            $this->data_url[1] = '';
        }

        $_data = [
            'data_jenis' => $this->data_jenis_berkas,
            'data_sub_jenis' => $this->data_sub_jenis_berkas,
            'data_url' => $this->data_url,
        ];

        foreach ($data as $d) {
            $_data[$d] = $this->{$d};
        }

        return view($view, $_data);
    }
}
