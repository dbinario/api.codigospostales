<?php

namespace App\Http\Controllers;

use App\Models\CodigosPostales;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;




class SepomexController extends Controller
{
    //

    public static function DescargarSepomex(){

        $response = Http::asForm()->post('https://www.correosdemexico.gob.mx/SSLServicios/ConsultaCP/CodigoPostal_Exportar.aspx',[

            '__EVENTTARGET'=>'',
            '__EVENTARGUMENT'=>'',
            '__LASTFOCUS'=>'',
            '__VIEWSTATE'=>'/wEPDwUINzcwOTQyOTgPZBYCAgEPZBYCAgEPZBYGAgMPDxYCHgRUZXh0BTzDmmx0aW1hIEFjdHVhbGl6YWNpw7NuIGRlIEluZm9ybWFjacOzbjogRGljaWVtYnJlIDI2IGRlIDIwMjFkZAIHDxAPFgYeDURhdGFUZXh0RmllbGQFA0Vkbx4ORGF0YVZhbHVlRmllbGQFBUlkRWRvHgtfIURhdGFCb3VuZGdkEBUhIy0tLS0tLS0tLS0gVCAgbyAgZCAgbyAgcyAtLS0tLS0tLS0tDkFndWFzY2FsaWVudGVzD0JhamEgQ2FsaWZvcm5pYRNCYWphIENhbGlmb3JuaWEgU3VyCENhbXBlY2hlFENvYWh1aWxhIGRlIFphcmFnb3phBkNvbGltYQdDaGlhcGFzCUNoaWh1YWh1YRFDaXVkYWQgZGUgTcOpeGljbwdEdXJhbmdvCkd1YW5hanVhdG8IR3VlcnJlcm8HSGlkYWxnbwdKYWxpc2NvB03DqXhpY28UTWljaG9hY8OhbiBkZSBPY2FtcG8HTW9yZWxvcwdOYXlhcml0C051ZXZvIExlw7NuBk9heGFjYQZQdWVibGEKUXVlcsOpdGFybwxRdWludGFuYSBSb28QU2FuIEx1aXMgUG90b3PDrQdTaW5hbG9hBlNvbm9yYQdUYWJhc2NvClRhbWF1bGlwYXMIVGxheGNhbGEfVmVyYWNydXogZGUgSWduYWNpbyBkZSBsYSBMbGF2ZQhZdWNhdMOhbglaYWNhdGVjYXMVIQIwMAIwMQIwMgIwMwIwNAIwNQIwNgIwNwIwOAIwOQIxMAIxMQIxMgIxMwIxNAIxNQIxNgIxNwIxOAIxOQIyMAIyMQIyMgIyMwIyNAIyNQIyNgIyNwIyOAIyOQIzMAIzMQIzMhQrAyFnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dnZ2dkZAIdDzwrAAsAZBgBBR5fX0NvbnRyb2xzUmVxdWlyZVBvc3RCYWNrS2V5X18WAQULYnRuRGVzY2FyZ2GPJgxvyEjTKwUaRnTUkxNS/CXFbg==',
            '__VIEWSTATEGENERATOR'=>'BE1A6D2E',
            '__EVENTVALIDATION'=>'/wEWKALHq/bgDQLG/OLvBgLWk4iCCgLWk4SCCgLWk4CCCgLWk7yCCgLWk7iCCgLWk7SCCgLWk7CCCgLWk6yCCgLWk+iBCgLWk+SBCgLJk4iCCgLJk4SCCgLJk4CCCgLJk7yCCgLJk7iCCgLJk7SCCgLJk7CCCgLJk6yCCgLJk+iBCgLJk+SBCgLIk4iCCgLIk4SCCgLIk4CCCgLIk7yCCgLIk7iCCgLIk7SCCgLIk7CCCgLIk6yCCgLIk+iBCgLIk+SBCgLLk4iCCgLLk4SCCgLLk4CCCgLL+uTWBALa4Za4AgK+qOyRAQLI56b6CwL1/KjtBaNHbgkpBiITxRh6iLVZFcN6ZK+W',
            'cboEdo'=>'00',
            'rblTipo'=>'txt',
            'btnDescarga.x'=>'28',
            'btnDescarga.y'=>'12'
        ]);


        Storage::put('ultima_version.zip', $response->getBody());


    }


    public static function ProcesarSepomex(){
            
            //descomprimimos el archivo        
            $zip = new \ZipArchive;
            $res = $zip->open(storage_path('app/ultima_version.zip'));
            if ($res === TRUE) {
                $zip->extractTo(storage_path('app/'));
                $zip->close();  
            } 
            

            $i=0; //contador de línea que se está leyendo
            $numlinea = 1; //línea que se desea borrar a esa se le asigna el indice, iniciando en 0 como primera 

            //leer archivo
            $file = fopen(storage_path('app/CPdescarga.txt'), "r");
            if($file){
                // Hacemos un ciclo y vamos recogiendo linea por linea del archivo.
                while ($linea = fgets($file))
                    {
                
                  if ($i > $numlinea)  // Si la linea que deseamos eliminar no es esta 
                    {
                        $cp = explode("|", utf8_encode($linea));
                        
                        $CP = new CodigosPostales;
                        $CP->d_codigo= $cp[0];
                        $CP->d_asenta=$cp[1];
                        $CP->d_tipo_asenta =$cp[2];
                        $CP->d_mnpio=$cp[3];
                        $CP->d_estado=$cp[4];
                        $CP->d_ciudad=$cp[5];
                        $CP->d_CP=$cp[6];
                        $CP->c_estado=$cp[7];
                        $CP->c_oficina=$cp[8];
                        $CP->c_CP=$cp[9];
                        $CP->c_tipo_asenta=$cp[10];
                        $CP->c_mnpio=$cp[11];
                        $CP->id_asenta_cpcons=$cp[12];
                        $CP->d_zona=$cp[13];
                        $CP->c_cve_ciudad=$cp[14];



                        
                        

                        $CP->save();

                        
                    
                    }
                
                  // Incrementamos nuestro contador de lineas
                $i++;
                }

            fclose($file);

    
                }

                //eliminamos los archivos
                Storage::delete(['app/CPdescarga.txt','app/ultima_version.zip']);


            }

          

}
