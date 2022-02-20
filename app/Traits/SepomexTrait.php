<?php

namespace App\Traits;


use App\Models\CodigosPostales;
use App\Models\CP_temporal;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


trait SepomexTrait
{

    public function DescargarSepomex(){

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

        
        if($response->status()==200){    
            
            Storage::put('ultima_version.zip', $response->getBody());
            Log::info('Descarga completa');

            return true;

        }else{

            Log::info('Error al descargar');
            return false;

        }

    }


    public function DescomprimirSepomex(){

          //descomprimimos el archivo        
          $zip = new \ZipArchive;
          $res = $zip->open(storage_path('app/ultima_version.zip'));
          if ($res === TRUE) {
              $zip->extractTo(storage_path('app/'));
              $zip->close();  
            return true;
          }else{
                
                return false;
          }
          
          

    }

    public function ProcesarSepomex(){
            
            //comprobamos si existe el archivo que buscamos
            if(Storage::exists('CPdescarga.txt')){

            $i=0; //contador de línea que se está leyendo
            $numlinea = 1; //línea que se desea borrar a esa se le asigna el indice, iniciando en 0 como primera 

            Log::info('iniciando proceso de procesar el archivo');
            //leer archivo
            $file = fopen(storage_path('app/CPdescarga.txt'), "r");
            if($file){
                // Hacemos un ciclo y vamos recogiendo linea por linea del archivo.
                while ($linea = fgets($file))
                    {
                
                  if ($i > $numlinea)  // Si la linea que deseamos eliminar no es esta 
                    {
                        $cpa = explode("|", utf8_encode($linea));
                
                        $CPT = new CP_temporal();
                        $CPT->d_codigo= $cpa[0];
                        $CPT->d_asenta=$cpa[1];
                        $CPT->d_tipo_asenta =$cpa[2];
                        $CPT->d_mnpio=$cpa[3];
                        $CPT->d_estado=$cpa[4];
                        $CPT->d_ciudad=$cpa[5];
                        $CPT->d_CP=$cpa[6];
                        $CPT->c_estado=$cpa[7];
                        $CPT->c_oficina=$cpa[8];
                        $CPT->c_CP=$cpa[9];
                        $CPT->c_tipo_asenta=$cpa[10];
                        $CPT->c_mnpio=$cpa[11];
                        $CPT->id_asenta_cpcons=$cpa[12];
                        $CPT->d_zona=$cpa[13];
                        $CPT->c_cve_ciudad=$cpa[14];
                        $CPT->save(); 
                        
                    }
                
                  // Incrementamos nuestro contador de lineas
                $i++;
                }

            fclose($file);
            Log::info('Termina el proceso de procesado del archivo');

    
                }

                
                //limpiamos la tabla de codigos postales
                DB::table('codigos_postales')->truncate();
                //insertamos los codigos postales de la tabla temporal a la tabla codigos postales
                DB::insert("INSERT INTO codigos_postales SELECT * FROM cp_temporal");
                //limpieamos la tabla temporal
                DB::table('cp_temporal')->truncate();
                //eliminamos los archivos
                Storage::delete(['CPdescarga.txt','ultima_version.zip']);
                
            
                return true;
                
            }else{
                Log::info('No existe el archivo CPdescarga.txt');
                return false;
            }
            }

}