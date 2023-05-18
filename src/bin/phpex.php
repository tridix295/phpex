<?php
require_once "../../vendor/autoload.php";

use src\bin\Handler\StreamHandler;

class phpex extends StreamHandler{
    private $init = [
        "id" => null
    ];
    private $metrics = [
         "wt" => array("Wall", "microsecs", "walltime"),
         "ut" => array("User", "microsecs", "user cpu time"),
         "st" => array("Sys", "microsecs", "system cpu time"),
         "cpu" => array("Cpu", "microsecs", "cpu time"),
         "mu" => array("MUse", "bytes", "memory usage"),
         "pmu" => array("PMUse", "bytes", "peak memory usage"),
         "samples" => array("Samples", "samples", "cpu time")
        ];
    private $enable = true;
    private $options = [];
    public function __construct($options = [])
    {
        $this->options = $options;
        $this->options["id"] = uniqid();
        $this->options["profile"] = 'test';
     //   xhprof_enable();
    }
    public function stop(){
        $this->enable = false;
        $this->save();
    }
    private function save(){
        $this->options["xhprof"] = 'a';//xhprof_disable();
       
        StreamHandler::store($this->options);
        
    }
                                                                                                 
}
$tes = new phpex();
$tes->stop();
?>