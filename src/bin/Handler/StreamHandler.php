<?php
namespace src\bin\Handler;
class StreamHandler{

    private static $path;
    private static $stream;
    private static $data;

    /**
     * Guardar los datos en un archivo
     * @param mixed $data datos a almacenar
     * @return void
     */
    public static function store($data):void 
    {
        $path = getcwd() . '/../tmp/' . $data['profile'];
        self::$data = $data;
        self::$path = str_replace('\\','/',$path);
        self::createDir();
    }

    /**
     * Crea un directorio de manera recursiva en la funcion store
     * @return void
    */
    private static function createDir():void{
        if(!empty(self::$path) && !is_dir(self::$path)){
            $status = mkdir(self::$path,775,true);
        }
        self::stream(self::$data['id'] . '.txt');
    }
    /**
     *  Abre el archivo para ser escrito.
     */
    private static function stream(string $file){
            $file = self::$path . "/$file";
            $handle = fopen($file,'a');
            self::write($handle,self::$data);
    }
    private static function write($handle,$record){
        fwrite($handle, json_encode($record));
    }
}

?>