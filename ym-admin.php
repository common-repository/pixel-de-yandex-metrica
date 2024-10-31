<?php
if(!defined('ABSPATH')) exit;

add_action( 'admin_menu', 'pym_counter_menu');

function pym_counter_menu() {
	add_options_page('Yandex Metrica by Lab School', 'Yandex Metrica','manage_options', 'yandex-metrica', 'pym_counter_conf');
}
function pym_counter_conf() {
?>
	
<style>
#wrap{margin:0; padding:0;}
#col1{width:600px;float:left;text-align:left;padding:0 0 0 10px; margin: 0 10px 0 0}
#col2{width:170px;float:left;text-align:right;padding:0 10px 0 0}
#col3{width:790px;clear:both; margin:20px 0;border-bottom:1px solid #ccc;font-size:20px;padding:0 0 10px 10px}
#guardar{width:800px;clear:both; margin:20px 0}
.instruccion{ font-style:italic; font-size:13px;color:#888; margin:12px 0 0 0}

@media screen and (max-width: 899px) {
#col1{width:500px}
#col2{width:170px}
#col3{width:690px}
#guardar{width:700px}
}

@media screen and (max-width: 767px) {
#col1{width:450px}
#col2{width:170px}
#col3{width:640px}
#guardar{width:650px}
}

@media screen and (max-width: 479px) {
#col1{width:170px}
#col2{width:150px}
#col3{width:340px}
#guardar{width:350px}
}
</style>

<div class="wrap">	
<h2>Yandex Metrica by Lab School</h2>
<form method="post" action='options.php' id="guardar">
	<?php settings_fields('pym_counter_options'); ?>
	<?php do_settings_sections('pym_counter'); ?>
<input class="button-primary" type="submit" name="submit" value="Guardar cambios" style="margin:20px 0 0 20px"/>
</form>
</div>
 
<?php
}

add_action('admin_init', 'pym_counter_admin_init');

function pym_counter_admin_init() {
	register_setting('pym_counter_options','pym_counter_options','pym_counter_validate');
	add_settings_section('pym_counter_main','', 'pym_counter_section_text','pym_counter');
	add_settings_field('pym_counter_id_', '','pym_counter_conf_id_input','pym_counter','pym_counter_main');
	add_settings_field('pym_counter_cod', '','pym_counter_conf_cod_input','pym_counter','pym_counter_main');
	add_settings_field('pym_counter_web', '','pym_counter_conf_web_input','pym_counter','pym_counter_main');
}

/* DOCUMENTACION */
function pym_counter_section_text() {
	//echo "<br><a style='margin-left:8px;' href='#'>Documentaci&oacute;n del plugin</a>";
}

/* ID YANDEX METRICA */
function pym_counter_conf_id_input() {
	$options = get_option('pym_counter_options');
	$id = $options['id'];	
	echo "<div id='col3'>".esc_html('Configuraci&oacute;n','pym-counter')."</div>";
	echo "<div id='col1'><label>".esc_html('Configuraci&oacute;n','pym-counter')."Yandex Metrica ID</label>
		  <div class='instruccion'>".esc_html('Introduce el identificador facilitado por Yandex Metrica','pym-counter')." <a href='https://yandex.com/support/metrica/general/creating-counter.html' target='_blank'>".esc_html('&iquest;C&oacute;mo obtener el ID?','pym-counter')."</a></div></div>";
	echo "<div id='col2'><input id='id' name='pym_counter_options[id]' type='text' value='$id' /></div>";
}

/* INCLUIR CODIGO SEGUIMIENTO */
function pym_counter_conf_cod_input() {
	$options = get_option('pym_counter_options');
	$id = $options['include_snippet_ya'];
	echo "<div id='col1'><label>".esc_html('Agregar c&oacute;digo seguimiento de Yandex Metrica','pym-counter')."</label><br />
		  <div class='instruccion'>".esc_html('Debes marcar esta opci&oacute;n para implementar el c&oacute;digo de seguimiento b&aacute;sico de Yandex Metrica en toda la web.','pym-counter')."</div></div>";
	echo "<div id='col2'><input name='pym_counter_options[include_snippet_ya]' type='checkbox' value='1' ".checked($id,1,false)."/></div>";
}

/* WEBVISOR */
function pym_counter_conf_web_input() {
	$options = get_option('pym_counter_options');
	$id = $options['webvisor'];
	echo "<div id='col1'><label>".esc_html('Activar Webvisor, Scroll Map y An&aacute;lisis de Formularios','pym-counter')."</label>
	      <div class='instruccion'>".esc_html('Marca esta opci&oacute;n para implementar la funci&oacute;n de Webvisor, Scroll Map y An&aacute;lisis de Formularios en la configuraci&oacute;n de tu propiedad.','pym-counter')."</div></div>";
	echo "<div id='col2'><input name='pym_counter_options[webvisor]' type='checkbox' value='1' ".checked($id,1,false)."/></div>";
}

/* GUARDAR OPCIONES */
function pym_counter_validate($form){
	$options 						= get_option('pym_counter_options');
	$updated 						= $options;
	$updated['id'] 					= $form['id'];
	$updated['include_snippet_ya'] 	= $form['include_snippet_ya'];
	$updated['webvisor'] 			= $form['webvisor'];
	return $updated;
}

?>
