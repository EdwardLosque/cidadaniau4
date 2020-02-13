<form method="get" action="" style="">
	
	<select class="cidade" name="cidade">
		<option value="" selected disabled hidden>Escolha a Cidade</option>
		<option value="consulta_sao_paulo">São Paulo</option>
		<option value="consulta_curitiba">Curitiba</option>
	</select>
	
	<input class="data" name="ano_import" type="text" placeholder="Ano" >
	<input name="arquivo" type="text" placeholder="url do Arquivo">
	
	<button class="button-yellow" type="submit">Importar</button>
	<br><br><br>

<!-- 	São Paulo colocar o ano do protocolo e a cidade em receber alerta -->
<!-- Ano, Cidade e Protocolo na wp-admin -->

<!-- Nome, Telefone e emal não salvando -->
	Curitiba<br>
	Incio da Chamada: <input type="text" name="inicio">
	Fim da Chamada: <input type="text" name="fim">
	Status
	<select class="cidade" name="status_curitiba">
		<option value="" selected disabled hidden>Escolha o Status</option>
		<option value="1">Já Convocado</option>
		<option value="2">Em Convocação</option>
		<option value="3">Convocação Próxima</option>
		<option value="4">Não Convocado</option>
	</select>
	<button class="button-yellow" type="submit">Mudar</button>
	<br><br><br>
	São Paulo<br>
	Ano: <input type="text" name="ano_change">
	Status
	<select class="cidade" name="status_sp">
		<option value="" selected disabled hidden>Escolha o Status</option>
		<option value="1">Já Convocado</option>
		<option value="2">Em Convocação</option>
		<option value="3">Convocação Próxima</option>
		<option value="4">Não Convocado</option>
	</select>
	<button class="button-yellow" type="submit">Mudar</button>

</form>

	
<!-- </form> -->

<?php
$row=0;
$url = $_GET['arquivo'];
if(strlen($url) > 2){
	if (($handle = fopen($url, "r")) !== FALSE) {
		
		while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
			$num = count($data);
			$row++;

			$args_insert = array(
				'post_title'=>$data[0], 
				'post_type'=> $_GET['cidade'], 
				'post_status' => 'publish'
			);

			$args_search = array(
				's'=>$data[0], 
				'post_type'=> $_GET['cidade'], 
				'post_status' => 'publish',
				'meta_key'		=> 'ano',
				'meta_value'	=> $_GET['ano_import']
			);

			$post_search = get_posts($args_search);
// 			echo "<pre>";
// 			var_dump($post_search);
// 			echo "</pre>";
			
			if(sizeof($post_search) < 1) {
				if($_GET['cidade'] == 'consulta_curitiba'){
					$args_insert = array(
						'post_title'=>$data[0], 
						'post_type'=>'consulta_curitiba', 
						'post_status' => 'publish'
					);
					$id = wp_insert_post($args_insert); 
					update_field("protocolo", $data[0], $id);
					update_field("nome", $data[2], $id);
					update_field("sobrenome", $data[1], $id);
				} else {
					// Verifica se o protocolo daquele ano já foi inserido
					$procura_ano=0;
					/*
					foreach($post_search as $post_check){
						$data_consulta = get_field("data", $post_check->ID);
						if($data_consulta == $_GET['ano_import']){
							$procura_ano = 1;
							break;
						}
					}
					echo $procura_ano;*/
					if($procura_ano == 0){
						if($_GET['ano_import'] > 2017){

							$args_insert = array(
								'post_title'=>$data[0], 
								'post_type'=>'consulta_sao_paulo', 
								'post_status' => 'publish'
							);

							$id = wp_insert_post($args_insert); 
							update_field("protocolo", $data[0], $id);
							update_field("sigla", $data[1], $id);
							update_field("data", $data[2], $id);
							update_field("ano", $_GET['ano_import'], $id);

						} else {
							$args_insert = array(
								'post_title'=>$data[0], 
								'post_type'=>'consulta_sao_paulo', 
								'post_status' => 'publish'
							);

							$id = wp_insert_post($args_insert); 
							update_field("protocolo", $data[0], $id);
							update_field("nome", $data[2], $id);
							update_field("sobrenome", $data[1], $id);
							update_field("ano", $_GET['ano_import'], $id);
						}
					}
				}
			}
		}
		fclose($handle);
	}
} elseif (strlen($_GET['fim']) > 1){
	for($i= (int)$_GET['inicio']; $i<(int)$_GET['fim']; $i++){
		$query = "select * from wp_postmeta where wp_postmeta.meta_value = '$i'";
		$posts = $wpdb->get_results($query);
		foreach($posts as $post){
			echo $post->post_id;
			update_field("status", $_GET['status_curitiba'], $post->post_id);
			$ano = get_field("ano",$post->post_id);
			if($ano == $_GET['ano_change']){
				update_field("status", $_GET['status_curitiba'], $posts->post_id);
				break;
			}
		}
	}

} elseif(strlen($_GET['ano_change']) > 1){
	
		$query = "select * from wp_postmeta where wp_postmeta.meta_value = '".$_GET['ano_change']."'";
		$posts = $wpdb->get_results($query);
		
		foreach($posts as $post){
			update_field("status", $_GET['status_sp'], $posts->post_id);
		}
}
