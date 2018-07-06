<?php 

class Generic_model extends CI_model
{
	
	function __construct()
	{
		parent::__construct();

	}

	public function encriptarDatos($datos){
		$this->load->library('encryption');
		$datosTemp = [];
		foreach ($datos as $key => $value) {
			$textEncript = $this->encryption->encrypt($value);
			$datosTemp[$key] = $textEncript;
		}

		return $datosTemp;
	}


	public function encriptarPassword($texto){
		$pass_encrypt = password_hash($texto, PASSWORD_DEFAULT);
		return $pass_encrypt;
	}


	public function obtenerIp(){
        if (isset($_SERVER["HTTP_CLIENT_IP"])){
            return $_SERVER["HTTP_CLIENT_IP"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
            return $_SERVER["HTTP_X_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_X_FORWARDED"])){
            return $_SERVER["HTTP_X_FORWARDED"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED_FOR"])){
            return $_SERVER["HTTP_FORWARDED_FOR"];
        }
        elseif (isset($_SERVER["HTTP_FORWARDED"])){
            return $_SERVER["HTTP_FORWARDED"];
        }
        else{
            return $_SERVER["REMOTE_ADDR"];
        }
    }

    public function subirArchivos($files, $ruta, $opciones = array()){
    	$return = array();

		$errorImg = 0;

    	$archivos = array();
		$cantidad = count($files['name']);

		for ($i=0; $i < $cantidad; $i++){ 
			if($files["error"][$i] != 0){
				$errorImg++;
			}
		}

		if($errorImg < $cantidad){
			$config['upload_path'] = $ruta;
			$config['encrypt_name'] = TRUE;

			if(count($opciones) > 0){
				if(array_key_exists("formatos", $opciones)){
					$config['allowed_types'] = $opciones["formatos"];
				}
				elseif(array_key_exists("size_max", $opciones)){
					$config['max_size'] = $opciones["size_max"];
				}
			}

			$this->load->library('upload', $config);

			for($i = 0; $i < $cantidad; $i++){
				$extension = explode(".", $files['name'][$i]);
				$extension = end($extension);

				$_FILES['imgTempAct']['name'] = $files['name'][$i];
				$_FILES['imgTempAct']['type'] = $files['type'][$i];
				$_FILES['imgTempAct']['tmp_name'] = $files['tmp_name'][$i];
				$_FILES['imgTempAct']['error'] = $files['error'][$i];
				$_FILES['imgTempAct']['size'] = $files['size'][$i];

				if($files['error'][$i] == 0){
					$this->upload->initialize($config);
					if($this->upload->do_upload('imgTempAct')){
						$fileData = $this->upload->data();
						$archivos[$i] = array();
						$archivos[$i]['nombre'] = $fileData['file_name'];
						$archivos[$i]['extencion'] = $fileData['file_ext'];
					}
				}
			}

			$return["archivos"] = $archivos;
			$return["error"] = 0;
		}
		else{
			$return["error"] = 1;
		}

		return $return;
    }

    public function subirArchivo($file, $ruta, $opciones = array()){
    	$return = array();

		$errorImg = 0;

    	$archivo = array();
		$errorImg = $file["error"];

		if($errorImg == 0){
			$config['upload_path'] = $ruta;
			$config['encrypt_name'] = TRUE;

			if(count($opciones) > 0){
				if(array_key_exists("formatos", $opciones)){
					$config['allowed_types'] = $opciones["formatos"];
				}
				elseif(array_key_exists("size_max", $opciones)){
					$config['max_size'] = $opciones["size_max"];
				}
			}

			$this->load->library('upload', $config);

			$_FILES['imgTempAct']['name'] = $file['name'];
			$_FILES['imgTempAct']['type'] = $file['type'];
			$_FILES['imgTempAct']['tmp_name'] = $file['tmp_name'];
			$_FILES['imgTempAct']['error'] = $file['error'];
			$_FILES['imgTempAct']['size'] = $file['size'];

			$this->upload->initialize($config);
			if($this->upload->do_upload('imgTempAct')){
				$fileData = $this->upload->data();
				$archivo['nombre'] = $fileData['file_name'];
				$archivo['extencion'] = $fileData['file_ext'];

				$return["archivo"] = $archivo;
				$return["error"] = 0;
			}
			else{
				$return["error"] = 2;
			}

		}
		else{
			$return["error"] = 1;
		}

		return $return;
    }

}

 ?>