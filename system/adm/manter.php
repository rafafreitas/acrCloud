<?php 

//include_once('includes/acrcloud_recognizer.php');
include "includes/verifica.php";
include '../_db/conecta.php';
include "../_assets/inc/class.upload.php";
include "includes/functions.php";

$acao = $_POST["acao"];
$tipoAcao = $_POST["tipoAcao"];

switch ($acao) {
	
	case 'manterMusicas':

		if ($tipoAcao == 'listAll') {
			try {

				if (!isset($_SESSION)) session_start();
				
				$id_get = $_SESSION['UsuarioID'];
				$status = $_POST['tableStatus'];
				

				$sql = $pdo->prepare("select 
									music_id, 
									music_name, 
									music_artista, 
									music_album, 
									music_data_envio, 
									DATE_FORMAT( music_data_envio , '%d/%m/%Y' ) AS music_data_envio, 
									music_file, 
									music_status 
									FROM musicas 
									WHERE user_id = ? 
									AND music_status = ?
									ORDER BY music_name");

				$sql->bindParam(1, $id_get , PDO::PARAM_STR);
				$sql->bindParam(2, $status , PDO::PARAM_STR);
				$sql->execute();
				$result=$sql->fetchAll(PDO::FETCH_ASSOC);//FETCH_ASSOC

				$json=json_encode($result);
				echo "$json";

			} catch (Exception $e) {
				//echo "\nPDO::errorCode(): ", $e->errorCode();
				//echo $e->getCode();
				echo $e->getMessage();
			}

		}elseif ($tipoAcao == 'adicionar') {

			try {

		       if (empty($_FILES['musicaUpload'])) {
		        	echo '{erro: Input_Vazio}';
		         	die;
		       	}else{
			       	$idOng = $_POST["id"];

			       	$http_method = "POST";
			       	$http_uri = "/v1/identify";
			       	$data_type = "audio";
			       	$signature_version = "1" ;
			       	$timestamp = time() ;

			       	$requrl = "http://identify-eu-west-1.acrcloud.com/v1/identify";
			       	$access_key =  '7f5150d236050d49f776276c17a479d0';
			       	$access_secret =  '7SvA3tLpemKmVOZ48x3Bask5GaKin5stltULPWOj';
			       	$string_to_sign = $http_method . "\n" . 
			       	$http_uri ."\n" . 
			       	$access_key . "\n" . 
			       	$data_type . "\n" . 
			       	$signature_version . "\n" . 
			       	$timestamp;
			       	$signature = hash_hmac("sha1", $string_to_sign, $access_secret, true);
			       	$signature = base64_encode($signature);


					$file = $argv[1];
					// $file = $_FILES['musicaUpload'];
		         	$filesize = filesize($file);
					// $filesize = $_FILES['musicaUpload']['size'];
		         	$cfile = new CURLFile($file, "mp3", basename($argv[1]));
					// $cfile = new CURLFile($file, "mp3", $_FILES['musicaUpload']['tmp_name']);
		         	$postfields = array(
			         	"sample" => $cfile, 
			         	"sample_bytes"=>$filesize, 
			         	"access_key"=>$access_key, 
			         	"data_type"=>$data_type, 
			         	"signature"=>$signature, 
			         	"signature_version"=>$signature_version, 
			         	"timestamp"=>$timestamp);
			        $ch = curl_init();
			        curl_setopt($ch, CURLOPT_URL, $requrl);
			        curl_setopt($ch, CURLOPT_POST, true);
			        curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
			        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			        $result = curl_exec($ch);
			        echo $result;
					// $response = curl_exec($ch);

					// if ($response == true) {
					//    $info = curl_getinfo($ch);
					// } else {
					//    $errmsg = curl_error($ch);
					//    print $errmsg;
					// }
		         	curl_close($ch);

			        $result = array(
			         	'post' => $_POST,
			         	'input' => $_FILES
			        );

		        	$json=json_encode($result);
		        	echo "$json";

		     	}

			}catch (Exception $e) {
			    //echo "\nPDO::errorCode(): ", $e->errorCode();
			    //echo $e->getCode();
			 	echo $e->getMessage();
			}
      
		}elseif ($tipoAcao == 'enableDisable') {
			try {

				$id = $_POST["Id_Update"];
				$status = $_POST["status"];

				$sql = $pdo->prepare("UPDATE musicas SET music_status = ? WHERE music_id = ?;)");
				$sql->bindParam(1, $status , PDO::PARAM_STR);
				$sql->bindParam(2, $id , PDO::PARAM_STR);
				$sql->execute();
				$count = $sql->rowCount();

				if ($count == 1) {
					echo "1";
				}else{
					echo "2";
				}

			} catch (Exception $e) {
				//echo "\nPDO::errorCode(): ", $pdo->errorCode();
				echo $e->getCode();
			}
		
		}
	break;
	//FimManterUsuario

	default:
		echo "Ocorreu um erro na chamada da função, os parâmetros de ação não foram localizados.";
	break;
}

?>