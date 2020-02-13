<?php
/**
 * Nuovo WordPress Theme
 *
 * Codebean.co
 * www.codebean.co
 */

# Constants
define('GOSEO_THEMEDIR', 		get_theme_file_path() . '/');
define('GOSEO_THEMEURL', 		get_theme_file_uri() . '/');
define('GOSEO_THEMEASSETS',	GOSEO_THEMEURL . 'assets/');
define('GOSEO_TD', 			'nuovowp');
define('GOSEO_TS', 			microtime(true));

# Theme Content Width
$content_width = ! isset($content_width) ? 1170 : $content_width;

# Initial Actions
add_action('after_setup_theme', 	'codebean_after_setup_theme');
add_action('init', 					'codebean_init');

add_action('widgets_init', 			'codebean_widgets_init');

add_action('wp_enqueue_scripts', 	'codebean_wp_enqueue_scripts');

add_action('admin_enqueue_scripts', 'codebean_admin_enqueue_scripts');

add_action('wp_footer', 			'codebean_wp_footer');

# Core Files
require get_parent_theme_file_path( 'includes/codebean_functions.php' );
require get_parent_theme_file_path( 'includes/codebean_actions.php' );
require get_parent_theme_file_path( 'includes/codebean_filters.php' );
require get_parent_theme_file_path( 'includes/codebean_vc.php' );
require get_parent_theme_file_path( 'includes/codebean_woocommerce.php' );
require get_parent_theme_file_path( 'includes/codebean_portfolio.php' );

// ACF Custom fields
require get_parent_theme_file_path('includes/acf-fields.php');


// Load Redux extensions - MUST be loaded before your options are set
if (file_exists(dirname(__FILE__) . '/includes/lib/redux-extensions/extensions-init.php')) {
	require_once( dirname(__FILE__) . '/includes/lib/redux-extensions/extensions-init.php' );
}

if ( !isset( $redux_demo ) && file_exists( dirname( __FILE__ ) . '/includes/codebean_options_init.php' ) ) {
	require_once( dirname( __FILE__ ) . '/includes/codebean_options_init.php' );
}

// Ajax
require get_parent_theme_file_path('/includes/ajax.php');

# Library
require get_parent_theme_file_path('includes/lib/class-tgm-plugin-activation.php');
require get_parent_theme_file_path('includes/lib/aq_resizer.php');


function my_acf_add_local_field_groups() {
	acf_add_local_field_group(array(
		'key' => 'group_1',
		'title' => 'Campos Personalizados',
		'fields' => array (
			array (
				'key' => 'field_1',
				'label' => 'Ano',
				'name' => 'ano',
				'type' => 'text',
			), 
			array (
				'key' => 'field_3',
				'label' => 'Sobrenome',
				'name' => 'sobrenome',
				'type' => 'text',
			),
			array (
				'key' => 'field_4',
				'label' => 'Nome',
				'name' => 'nome',
				'type' => 'text',
			),
			array (
				'key' => 'field_sigla',
				'label' => 'Sigla',
				'name' => 'sigla',
				'type' => 'text',
			),
			array (
				'key' => 'field_5',
				'label' => 'Protocolo',
				'name' => 'protocolo',
				'type' => 'text',
			),
			array (
				'key' => 'field_status',
				'label' => 'Status',
				'name' => 'status',
				'type' => 'text',
			),
			array (
				'key' => 'field_data',
				'label' => 'Data',
				'name' => 'data',
				'type' => 'text',
			)
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'consulta_sao_paulo',
				)
			),
		),
	));
}

add_action('acf/init', 'my_acf_add_local_field_groups');


function my_acf_add_local_field_groups2() {
	acf_add_local_field_group(array(
		'key' => 'group_2',
		'title' => 'Campos Personalizados',
		'fields' => array (
			array (
				'key' => 'field_3_curitiba',
				'label' => 'Sobrenome',
				'name' => 'sobrenome',
				'type' => 'text',
			),
			array (
				'key' => 'field_4_curitiba',
				'label' => 'Nome',
				'name' => 'nome',
				'type' => 'text',
			),
			array (
				'key' => 'field_5_curitiba',
				'label' => 'Protocolo',
				'name' => 'protocolo',
				'type' => 'text',
			),
			array (
				'key' => 'field_status_curitiba',
				'label' => 'Status',
				'name' => 'status',
				'type' => 'text',
			)
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'consulta_curitiba',
				)
			),
		),
	));
}

add_action('acf/init', 'my_acf_add_local_field_groups2');

function display_consulta_curt()
{	
	$args = array(
		"post_type" => "consulta_curitiba",
		"numberposts" => -1
	);

	$posts = get_posts($args);

	foreach($posts as $post)
	{
		$ano = get_field("ano",$post->ID);
		echo $ano;
		$numero = get_field("numero",$post->ID);
		echo $numero;
		$nome = get_field("nome",$post->ID);
		echo $nome;
		$sobrenome = get_field("sobrenome",$post->ID);
		echo $sobrenome;
	}
}

add_shortcode('consulta_curt', 'display_consulta_curt');


function custom_fields_alerta() {
	acf_add_local_field_group(array(
		'key' => 'group_10',
		'title' => 'Campos Personalizados',
		'fields' => array (
			array (
				'key' => 'field_email_alerta',
				'label' => 'Email',
				'name' => 'email',
				'type' => 'text',
			),
			array (
				'key' => 'field_3_alerta',
				'label' => 'Telefone',
				'name' => 'Telefone',
				'type' => 'text',
			),
			array (
				'key' => 'field_4_alerta',
				'label' => 'Nome',
				'name' => 'nome',
				'type' => 'text',
			),
			array (
				'key' => 'field_6_alerta',
				'label' => 'Sobrenome',
				'name' => 'sobrenome',
				'type' => 'text',
			),
			array (
				'key' => 'field_5_alerta',
				'label' => 'Protocolo',
				'name' => 'protocolo',
				'type' => 'text',
			),
			array (
				'key' => 'field_7_alerta',
				'label' => 'Cidade',
				'name' => 'cidade',
				'type' => 'text',
			),
			array (
				'key' => 'field_8_alerta',
				'label' => 'Ano',
				'name' => 'ano',
				'type' => 'text',
			)
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'receber_alerta',
				),
			),
		),
	));
}

add_action('acf/init', 'custom_fields_alerta');


function Fbuscar_sobrenome($atts){

?>
<div class="widget">
	<h1>Widget 1</h1>
	<form method="get" action="<?php echo $atts['pagina_tabela'] ?>" style="">

		<select class="cidade" name="cidade">
			<option value="" selected disabled hidden>Escolha a Cidade</option>
			<option value="consulta_sao_paulo">São Paulo</option>
			<option value="consulta_curitiba">Curitiba</option>
		</select>

		<select class="ano" name="ano">
			<option value="" selected disabled hidden>Escolha o Ano</option>
			<option value="2017maior">Depois de 2017</option>
			<option value="2017menor">Antes de 2017 (inclusive)</option>
		</select>

		<input class="sigla" name="sigla" type="text" placeholder="Sigla">
		<input class="data" name="data" type="date" placeholder="Data de Nascimento" >

		<input class="nome" name="Nome" type="text" placeholder="Nome">
		<input class="sobrenome" name="sobrenome" type="text" placeholder="Sobrenome">

		<button class="button-yellow" type="submit">PROCURAR</button>
	</form>
</div>
<script>
	jQuery(document).ready(function(){
		$("select.ano").hide("fast");
		$("input.sigla").hide("fast");
		$("input.data").hide("fast");
		$("input.nome").hide("fast");
		$("input.sobrenome").hide("fast");
// 		$("button[type='submit']").hide("fast");

		jQuery("select.cidade").change(function(){
			var selectedCity = jQuery(this).children("option:selected").val();
			if(selectedCity == "consulta_sao_paulo"){
				jQuery("select.ano").show("fast");
				jQuery("input.nome").hide("fast");
				jQuery("input.sobrenome").hide("fast");
				jQuery("input.nome").val('');
				jQuery("input.sobrenome").val('');
// 				jQuery("button[type='submit']").hide("fast");
			} else {
				jQuery("input.nome").show("fast");
				jQuery("input.sobrenome").show("fast");
				jQuery("select.ano").hide("fast");
				jQuery("input.sigla").hide("fast");
				jQuery("input.data").hide("fast");
// 				jQuery("button[type='submit']").hide("fast");
				jQuery("select.ano").val("");
				jQuery("input.sigla").val("");
				jQuery("input.data").val("");
			}
		});

		jQuery("input.nome").focusout(function(){
			var input = jQuery(this).val();
			var size = input.length;
			if( size > 1){
				$("button[type='submit']").show("fast");
			}
		})

		jQuery("input.sobrenome").focusout(function(){
			var input = jQuery(this).val();
			var size = input.length;
			if( size > 1){
				$("button[type='submit']").show("fast");
			}
		})

		jQuery("input.data").focusout(function(){
			var input = jQuery(this).val();
			var size = input.length;
			if( size > 1){
				$("button[type='submit']").show("fast");
			}
		})

		jQuery("input.sigla").focusout(function(){
			var input = jQuery(this).val();
			var size = input.length;
			if( size > 1){
				$("button[type='submit']").show("fast");
			}
		})

		jQuery("select.ano").change(function(){
			var selectedAno = jQuery(this).children("option:selected").val();
			if(selectedAno == "2017maior"){
				jQuery("input.sigla").show("fast");
				jQuery("input.data").show("fast");
				jQuery("input.nome").hide("fast");
				jQuery("input.sobrenome").hide("fast");
// 				jQuery("button[type='submit']").hide("fast");
				jQuery("input.nome").val("");
				jQuery("input.sobrenome").val("");
			} else {
				jQuery("input.nome").show("fast");
				jQuery("input.sobrenome").show("fast");
				jQuery("input.sigla").hide("fast");
				jQuery("input.data").hide("fast");
// 				jQuery("button[type='submit']").hide("fast");
				jQuery("input.sigla").val("");
				jQuery("input.data").val("");
			}
		});
	});
</script>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/rowreorder/1.2.6/js/dataTables.rowReorder.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.6/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.dataTables.min.css">

<style>
	.widget {
		max-width: 700px;
		margin-bottom: 150px;
		border-bottom: 5px solid black;
		display: block;
		margin: 40px auto;
		padding-bottom: 20px;
	}
	select, input{
		margin-bottom: 10px;
	}

	input[type=date]{
		width: 100%;
		border-radius: 0;
		padding: 0 12px;
		min-height: 50px;
		line-height: 1.7;
		border: 1px solid #e6e6e6;
		outline: 0;
		-webkit-box-shadow: none;
		box-shadow: none;
		placeholder: #afafaf;
		transition: border-color ease-in-out .15s, box-shadow ease-in-out .15s, -webkit-box-shadow ease-in-out .15s;
	}


	div#example_length, div#example_filter{
		display: none;
	}
	table {
		font-family: arial, sans-serif;
		border-collapse: collapse;
		width: 100%;
	}

	td, th {
		border: 1px solid #dddddd;
		text-align: left;
		padding: 8px;
	}

	td{
		font-size: 14px;
		font-weight: bold;
		color: black;
	}

	tr:nth-child(even) {
		background-color: #dddddd;
	}

	.button-yellow{
		background-color: #FBCC02;
		padding: 10px 15px;
		border-radius: 20px;
		color: #630E2B;
		border: none;
		cursor: pointer;
		font-weight: bold;
		width: 100%;
	}

	input{
		height: 35px;
		border: 2px solid black;
		border-radius: 20px;
		padding: 10px;
	}

	select{
		height: 35px;
		border: 2px solid black;
		border-radius: 20px;
		background-color: #FBCC02;
		padding: 0px 10px;
		color: black;
		font-weight: bold;
	}

	.cadastrar input, .cadastrar select,  .cadastrar button{
		display: block;
		margin: 10px;
	}

</style>

<?php 
}
add_shortcode('buscar_sobrenome', 'Fbuscar_sobrenome');

function Ftabela_cidadania4u($atts){

// 	echo $atts['landing_page_curitiba_1'];
// 	echo $atts['landing_page_sp_1'];

// 	echo $atts['landing_page_curitiba_2'];
// 	echo $atts['landing_page_sp_2'];

// 	echo $atts['landing_page_curitiba_3'];
// 	echo $atts['landing_page_sp_3'];

// 	echo $atts['landing_page_curitiba_4'];
// 	echo $atts['landing_page_sp_4'];

?>
<div class="widget">
	<h1>Widget 2</h1>
	<table id="example" class="display" cellspacing="0" width="100%">
		<?php
	global $wpdb;

	if($_GET['cidade'] == 'consulta_curitiba'){
		?>
		<thead>
			<tr>
				<th>Nº PROTOCOLO</th>
				<th>NOME</th>
				<th>SOBRENOME</th>
				<th>STATUS</th>
				<th>RECEBER ALERTA</th>
			</tr>
		</thead>
		<tbody>
			<?php

		if(strlen($_GET['Nome']) > 1 && strlen($_GET['sobrenome']) > 1){
			$query = "select * from wp_postmeta where wp_postmeta.meta_value LIKE '".$_GET['Nome']."' OR wp_postmeta.meta_value LIKE '".$_GET['sobrenome']."'";
			$query = "select * from wp_postmeta where wp_postmeta.meta_value LIKE '".$_GET['Nome']."'";
			$check=1;

		} else if(strlen($_GET['Nome']) > 1){
			$query = "select * from wp_postmeta where wp_postmeta.meta_value LIKE '".$_GET['Nome']."'";
			$check=0;

		} else if(strlen($_GET['sobrenome']) > 1){
			$query = "select * from wp_postmeta where wp_postmeta.meta_value LIKE '".$_GET['sobrenome']."'";
			$check=0;
		} 
		$posts = $wpdb->get_results($query);

		foreach($posts as $post){
			$imprimi_linha=0;

			$protocolo = get_field("protocolo",$post->post_id);
			$ano = get_field("ano",$post->post_id);
			$numero = get_field("numero",$post->post_id);
			$nome = get_field("nome",$post->post_id);
			$sobrenome = get_field("sobrenome",$post->post_id);
			$status = get_field("status",$post->post_id);


			if($check == 1){
				if(strpos($sobrenome, $_GET['sobrenome']) !== FALSE){
					$imprimi_linha=1;
				}
			} else {
				$imprimi_linha=1;
			}


			if($imprimi_linha == 1 && (get_post_type($post->post_id) == 'consulta_curitiba')){
			?><tr><td><?php echo $protocolo ?></td><?php
			?><td><?php echo $nome ?></td><?php
			?><td><?php echo $sobrenome ?></td><?php
			?><td><?php echo $status ?></td><?php

				if($status == 1){
					$link = $atts['landing_page_curitiba_1'];
					$texto = 'E agora?';
				} else if($status == 2){
					$link = $atts['landing_page_curitiba_2'];
					$texto = 'Em Convocação';
				} else if($status == 3){
					$link = $atts['landing_page_curitiba_3'];
					$texto = 'Convocação Próxima';
				} else if($status == 4){
					$link = $atts['landing_page_curitiba_4'];
					$texto = 'Não Convocado';
				} 

			?><td><a href="<?php echo $link ?>?protocolo=<?php echo $protocolo ?>&sobrenome=<?php echo $sobrenome ?>&nome=<?php echo $nome ?>&ano=<?php echo $ano ?>&cidade=<?php echo $_GET['cidade'] ?>"><button class="button-yellow" ><?php echo $texto ?></button></a></td></tr><?php
			}
		}

	} else {
		if($_GET['ano'] == '2017maior'){
			?>

			<thead>
				<tr>
					<th>Nº PROTOCOLO</th>
					<th>SIGLA</th>
					<th>DATA DE NASCIMENTO</th>
					<th>STATUS</th>
					<th>RECEBER ALERTA</th>
				</tr>
			</thead>
		<tbody>
			<?php
			$data = $_GET['data'];
			$data = date('d/m/Y',strtotime($data));
			echo $data;
			echo $_GET['sigla'];
			
			if(strlen($_GET['sigla']) > 1 && strlen($_GET['data']) > 1){
				$query = "select * from wp_postmeta where wp_postmeta.meta_value LIKE '".$_GET['sigla']."' OR wp_postmeta.meta_value LIKE '".$data."'";
				$query = "select * from wp_postmeta where wp_postmeta.meta_value LIKE '".$data."'";
				$check=1;
			} else if(strlen($_GET['sigla']) > 0){
				$query = "select * from wp_postmeta where wp_postmeta.meta_value LIKE '".$_GET['sigla']."'";
				$check=0;
				echo "ok";
			} else if(strlen($_GET['data']) > 1){
				$query = "select * from wp_postmeta where wp_postmeta.meta_value LIKE '".$data."'";
				$check=0;
			} 
			
			$posts = $wpdb->get_results($query);
			foreach($posts as $post){
				$imprimi_linha=0;
				$ano = get_field("ano",$post->post_id);
				$protocolo = get_field("protocolo",$post->post_id);
				$data = get_field("data",$post->post_id);
				$sigla = get_field("sigla",$post->post_id);
				$sobrenome = get_field("sobrenome",$post->post_id);
				$status = get_field("status",$post->post_id);

				if($check == 1){
					if(strpos($sigla, $_GET['sigla']) !== FALSE){
						$imprimi_linha=1;
					}
				} else {
					$imprimi_linha=1;
				}

				if($imprimi_linha == 1 && (get_post_type($post->post_id) == 'consulta_sao_paulo')){

			?><tr><td><?php echo $ano."-".$protocolo ?></td><?php
			?><td><?php echo $sigla ?></td><?php
			?><td><?php echo $data ?></td><?php
			?><td><?php echo $status ?></td><?php
				if($status == 1){
					$link = $atts['landing_page_sp_1'];
					$texto = 'E agora?';
				} else if($status == 2){
					$link = $atts['landing_page_sp_2'];
					$texto = 'Em Convocação';
				} else if($status == 3){
					$link = $atts['landing_page_sp_3'];
					$texto = 'Convocação Próxima';
				} else if($status == 4){
					$link = $atts['landing_page_sp_4'];
					$texto = 'Não Convocado';
				} 

			?><td><a href="<?php echo $link ?>?protocolo=<?php echo $protocolo ?>&sobrenome=<?php echo $sobrenome ?>&nome=<?php echo $nome ?>&ano=<?php echo $ano ?>&cidade=<?php echo $_GET['cidade'] ?>"><button class="button-yellow" ><?php echo $texto ?></button></a></td></tr><?php
				}
			}
		} else {
			?>
			<thead>
				<tr>

					<th>Nº PROTOCOLO</th>
					<th>NOME</th>
					<th>SOBRENOME</th>
					<th>STATUS</th>
					<th>RECEBER ALERTA</th>
				</tr>
			</thead>
		<tbody>
			<?php

			if(strlen($_GET['Nome']) > 1 && strlen($_GET['sobrenome']) > 1){
				$query = "select * from wp_postmeta where wp_postmeta.meta_value LIKE '".$_GET['Nome']."' OR wp_postmeta.meta_value LIKE '".$_GET['sobrenome']."'";
				$query = "select * from wp_postmeta where wp_postmeta.meta_value LIKE '".$_GET['Nome']."'";
				$check=1;

			} else if(strlen($_GET['Nome']) > 1){
				$query = "select * from wp_postmeta where wp_postmeta.meta_value LIKE '".$_GET['Nome']."'";
				$check=0;

			} else if(strlen($_GET['sobrenome']) > 1){
				$query = "select * from wp_postmeta where wp_postmeta.meta_value LIKE '".$_GET['sobrenome']."'";
				$check=0;
			} 
			$posts = $wpdb->get_results($query);
			foreach($posts as $post){
				$ano = get_field("ano",$post->post_id);
				if($ano <= 2017){
					$imprimi_linha = 0;
					$protocolo = get_field("protocolo",$post->post_id);
					$data = get_field("data",$post->post_id);
					$nome = get_field("nome",$post->post_id);
					$sobrenome = get_field("sobrenome",$post->post_id);
					$status = get_field("status",$post->post_id);

					if($check == 1){
						if(strpos($sobrenome, $_GET['sobrenome']) !== FALSE){
							$imprimi_linha=1;
						}
					} else {
						$imprimi_linha=1;
					}


					if($imprimi_linha == 1 && (get_post_type($post->post_id) == 'consulta_sao_paulo')){
			?><tr><td><?php echo $ano."-".$protocolo ?></td><?php
			?><td><?php echo $nome ?></td><?php
			?><td><?php echo $sobrenome ?></td><?php
			?><td><?php echo $status ?></td><?php
				if($status == 1){
					$link = $atts['landing_page_sp_1'];
					$texto = 'E agora?';
				} else if($status == 2){
					$link = $atts['landing_page_sp_2'];
					$texto = 'Em Convocação';
				} else if($status == 3){
					$link = $atts['landing_page_sp_3'];
					$texto = 'Convocação Próxima';
				} else if($status == 4){
					$link = $atts['landing_page_sp_4'];
					$texto = 'Não Convocado';
				} 

			?><td><a href="<?php echo $link ?>?protocolo=<?php echo $protocolo ?>&sobrenome=<?php echo $sobrenome ?>&nome=<?php echo $nome ?>&ano=<?php echo $ano ?>&cidade=<?php echo $_GET['cidade'] ?>"><button class="button-yellow" ><?php echo $texto ?></button></a></td></tr><?php
					}
				}
			}
		}
	}
			?>
		</tbody>
	</table>
</div>

<script>

	$(document).ready(function() {
		var table = $('#example').DataTable( {
			rowReorder: {
				selector: 'td:nth-child(2)'
			},
			responsive: true,
			"oLanguage": {
				"sProcessing":   "Processando...",
				"sLengthMenu":   "Mostrar _MENU_ registros",
				"sZeroRecords":  "Não foram encontrados resultados",
				"sInfo":         "Mostrando de _START_ até _END_ de _TOTAL_ registros",
				"sInfoEmpty":    "Mostrando de 0 até 0 de 0 registros",
				"sInfoFiltered": "",
				"sInfoPostFix":  "",
				"sSearch":       "Buscar:",
				"sUrl":          "",
				"oPaginate": {
					"sFirst":    "Primeiro",
					"sPrevious": "Anterior",
					"sNext":     "Seguinte",
					"sLast":     "Último"
				}
			}
		} );
	} );

</script>
<?php 
}

add_shortcode('tabela_cidadania4u', 'Ftabela_cidadania4u');


function Fsalvar_alerta(){

	if(isset($_GET['telefone'])){
		$titulo = $_GET['nome']." ".$_GET['email'];
		$args = array(
			'post_title' => $titulo,
			'post_type' => 'receber_alerta', 
			'post_status' => 'publish'
		);

		$id = wp_insert_post($args); 

		update_field("email", $_GET['email'], $id);
		update_field("Telefone", $_GET['telefone'], $id);
		update_field("ano", $_GET['ano'], $id);
		update_field("cidade", $_GET['cidade'], $id);
		update_field("nome", $_GET['nome'], $id);
		update_field("sobrenome", $_GET['sobrenome'], $id);
		update_field("protocolo", $_GET['protocolo'], $id);
	} 
?>

<div class="widget">
	<h1>Widget 3</h1>

	<?php echo $_GET['nome'];  ?>
	<form method="get" class="cadastrar">
		<input type="hidden" name="cidade" value="<?php echo $_GET['cidade'] ?>">
		<input type="hidden" name="ano" value="<?php echo $_GET['ano'] ?>">
		<input type="hidden" name="sobrenome" value="<?php echo $_GET['sobrenome'] ?>">
		<input type="text" name="nome" placeholder="Nome" style="display: block">
		<input type="text" name="email" placeholder="Email"  style="display: block">
		<input type="text" name="telefone" placeholder="Telefone"  style="display: block">
		<input type="hidden" name="protocolo" placeholder="" value="<?php echo $_GET['protocolo'] ?>">
		<button type="input" class="button-yellow"  style="display: block">Cadastrar Alerta</button>
	</form>
</div>

<?php
}

add_shortcode('salvar_alerta', 'Fsalvar_alerta');
