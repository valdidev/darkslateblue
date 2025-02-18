<?php if (isset($_GET['carpeta'])) { ?>
	<table>
		<thead>
			<tr>
				<td>Documento</td>
				<td>Operaciones</td>
			</tr>
		</thead>
		<tbody>
			<?php
			$folder = '../basededatos/' . $_GET['carpeta'] . "/";

			if (is_dir($folder)) {
				$files = scandir($folder);

				$files = array_diff($files, array('.', '..'));

				foreach ($files as $file) {
					echo "
						  	<tr>
						  		<td>" . $file . "</td>
						  		<td>
						  			<a href='?documento=" . $file . "'>
						  				<button>
						  					Ver el pedido
						  				</button>
						  			</a>
						  		</td>
						  	</tr>";
				}
			} else {
				echo "The folder does not exist.";
			}
			?>
		</tbody>
	</table>

<?php } ?>