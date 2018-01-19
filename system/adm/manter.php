<?php 

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