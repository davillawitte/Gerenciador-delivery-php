<!DOCTYPE html>
<html lang="en">
<head>
  <title>Júnior água</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.5/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.5/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="index.css">
</head>
<body>

  <?php
  
  //Change the password to match your configuration
  $link = mysqli_connect("localhost", "root", "", "zdg");

  // Check connection
  if($link === false){
      die("ERROR: Could not connect. " . mysqli_connect_error());
  }
  echo "<br>";
  
  
  $sql = "SELECT id, user, nome, itens, pagamento, localizacao, total, horario, status FROM pedido_full";
  $result = $link->query($sql);
  
  	echo "<nav id='menu-h'>";
    echo "<ul>";
    echo "    <li><a>Júnior Água</a></li>";
    echo "    <li><a target='_blank' href='https://comunidadezdg.com.br/'><img src='https://comunidadezdg.com.br/wp-content/uploads/elementor/thumbs/icone-p7nqaeuwl6ck4tz33sz0asflw2opfsqwutv8l3hfk0.png' style='height:20px;'><br></a></li>";
    echo "</ul>";
    echo "</nav>";
	echo "<br> ";
	
	echo "<br> ";
	echo "<hr>";
	echo "<br> ";
	echo "<h2>Gestão de Pedidos via bot-Whatsapp</h2>";
	echo "<p>Insira algum valor para filtrar a coluna abaixo</p> ";
	echo "<input class='form-control' id='myInput' type='text' placeholder='Buscar..'>";
	echo "<br>";
  
    echo "<br> ";
	echo "<table class='table table-bordered table-striped'> ";
    echo "<thead> ";
				echo "<tr>";
				echo "<th>ID</th>";
				echo "<th>Usuário</th>";
				echo "<th>Nome</th>";
				echo "<th>Itens</th>";
				echo "<th>Pagamento</th>";
				echo "<th>Localização</th>";
				echo "<th>Total</th>";
				echo "<th>Data</th>";
				echo "<th>Entrega</th>";
				echo "<th>Deletar</th>";
				echo "</tr>";
	echo " </thead> ";
	echo " <tbody id='myTable'> ";
				if ($result->num_rows > 0) {
					// output data of each row
					while($row = $result->fetch_assoc()) {
							
						echo "<tr>";
						echo "<td>" . $row["id"] . "</td>";
						echo "<td>" . $row["user"] . "</td>";
						//echo "<td style='color: transparent;text-shadow: 0 0 8px rgba(0,0,0,0.5);'>" . $row["user"] . "</td>";
						echo "<td>" . $row["nome"] . "</td>";
						echo "<td>" . preg_replace('/,/', ' ', $row["itens"],1) . "</td>";
						//echo "<td>" . $row["itens"] . "</td>";
						echo "<td>" . $row["pagamento"] . "</td>";
						echo "<td><a target='_blank' href='". $row["localizacao"] ."'>" . $row["localizacao"] . "</a></td>";
						echo "<td> R$ " . $row["total"] . "</td>";
						echo "<td>" . $row["horario"] . "</td>";
						// muda conforme status do pedido
						// echo "<td>" . $row["status"] . 
						// (($row["status"] == "Entregue") ? "  <i class='fa fa-check' style='color: green'></i>" : "<i class='fa fa-times' style='color: red'></i>") . 
						// "</td>";
						echo "<td>";
							if ($row["status"] == "Entregue") {
							echo "<i class='fa fa-check' style='color: green;'> Entregue</i>";
							} else if ($row["status"] == "Cancelado") {
							echo "<i class='fa fa-times' style='color: red;'> Cancelada</i>";
							} else {
							echo "<i class='fa fa-clock-o' style='color: orange;'> Aguardando</i>";
							}
						echo "</td>";
						echo "<td><a href='delete.php?id=".$row["id"]."' onclick='return delAlert(".$row["id"].");'>Deletar</a></td>";
						echo "</tr>";			
					}
				} else {
					echo "0 resultados";
				}
	echo " </tbody> ";
	echo " </table> ";
	echo "<hr>" ;
	echo "<p>Desenvolvido por @PowerBot automatizações.</p>";


	// Close connection
	mysqli_close($link);
  ?>
  
<script type="text/javascript">
    function delAlert(id){
        alert("O pedido " + id + " foi deletado com sucesso.");
        return true;
    }
</script>
  
 <script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>



</body>
</html>