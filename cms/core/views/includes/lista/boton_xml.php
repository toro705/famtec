<?php

$html_boton_xml = ( isset($xls_btn) AND $xls_btn) ?
	'<a class="exportButton" id="xls" href="'.base_url().'index.php/'.$controller.'/exportxls">
		<img alt="Exportar a XLS" title="Exportar a XLS" src="'.base_url().'core/images/icons/xls.png"/></a>' : '';

return $html_boton_xml;
