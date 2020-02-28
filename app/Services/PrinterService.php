<?php
namespace App\Services;



use App\Models\Settings;

class PrinterService
{
    private $settings;
    private $printer;
    private $type;
    private $fileOrUrl;

    public function __construct(Settings $settings)
    {
        $this->settings = $settings->getEditableData('printing');
    }

    public function call(string $type,$fileOrUrl)
    {
        $this->type = $type;
        $this->fileOrUrl = $fileOrUrl;

        if(method_exists($this,$this->type)){
            $this->getPrinterData();
            if($this->printer != null){
                $this->{$this->type}($this->printer);
            }
        }
    }

    private function getPrinterData(){
        $this->printer = null;
        if($this->settings && $this->settings->printers){
            $data = json_decode($this->settings->printers,true);
            if(count($data)){
                foreach ($data as $datum){
                    if($datum['folder'] == $this->type){
                        $this->printer = $datum;
                    }
                }
            }
        }
    }

    public function invoice($data){
        \GoogleCloudPrint::asPdf()
            ->file($this->fileOrUrl)
            ->printer($data['id'])
            ->send();
    }

    public function shipping($data){
        \GoogleCloudPrint::asPdf()
            ->file($this->fileOrUrl)
            ->printer($data['id'])
            ->send();
    }

    public function downloads($data){
        \GoogleCloudPrint::asPdf()
            ->url($this->fileOrUrl)
            ->printer($data['id'])
            ->send();
    }
}
