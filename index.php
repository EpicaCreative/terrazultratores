<?php

session_start();

$utm = $_GET['utm_source'];

if (empty($utm)) { 
  $utm = "Não rastreável"; }

echo "Hello"." ".$_SESSION['nome_cliente'];



if (empty($_SESSION['nome_cliente'])) {

	$nome = "";

}
else{
	$nome = $_SESSION['nome_cliente'];
}

if (empty($_SESSION['email_cliente'])) {

	$email = "";

}
else{
	$email = $_SESSION['email_cliente'];
}

if (empty($_SESSION['telefone_cliente'])) {

	$telefone = "";

}
else{
	$telefone = $_SESSION['telefone_cliente'];
}

if (empty($_SESSION['uf_cliente'])) {

	$uf = "";

}
else{
	$uf = $_SESSION['uf_cliente'];
}

if (empty($_SESSION['cidade_cliente'])) {

	$cidade = "";

}
else{
	$cidade = $_SESSION['cidade_cliente'];
}

if (empty($_SESSION['origem_inicial'])) {

	$utm = $utm;

}
else{
	$utm = $_SESSION['origem_inicial'];
}

?>

<html>
 <head>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
  <script src="view-source:https://rawgit.com/RobinHerbots/jquery.inputmask/3.x/dist/jquery.inputmask.bundle.js"></script>
    <script type="text/javascript">
 function mascaraTel(componente){
	var texto = $("#"+componente).val();
	texto = texto.replace(/\D/g,"");//Remove tudo o que não é dígito

	texto = texto.replace(/^(\d\d)(\d)/g,"($1) $2");//Coloca parênteses em volta dos dois primeiros dígitos

	if(texto.length < 14) texto = texto.replace(/(\d{4})(\d)/,"$1-$2");//Número com 8 dígitos. Formato: (99) 9999-9999
	else texto = texto.replace(/(\d{5})(\d)/,"$1-$2");//Número com 9 dígitos. Formato: (99) 99999-9999

	$("#"+componente).val(texto); 
}
</script>
 </head>
<body>
    <iframe name="lead" style="display:none" src="lead.php"></iframe>
	<div class="container">
  <form target="lead" id="email-form"  name="email-form" method="post" action="processamento.php" data-name="Email Form">
              <input type="text" class="text-field w-input" maxlength="256" name="formulario" data-name="formulario" placeholder="formulario" id="nome" required="">
              <input type="text" class="text-field w-input" maxlength="256" name="origem_cliente" data-name="formulario" placeholder="formulario" id="nome" value="<?php echo $utm; ?>" required="">

  	          <input type="text" class="text-field w-input" maxlength="256" name="nome_cliente" value="<?php echo $nome;?>" data-name="nome" placeholder="Nome" id="nome" required="">
              <input type="text" class="text-field w-input" maxlength="256" name="email_cliente" style="display: none;" data-name="nome" placeholder="Nome" id="nome" ><input type="text" class="text-field w-input" maxlength="256" name="email_cliente" data-name="email" placeholder="Email" value="<?php echo $email;?>" id="email"><input type="text" class="phone-mask" maxlength="256" name="tel_cliente" data-name="tel" placeholder="Telefone" id="tel" onKeyUp="mascaraTel(this.id)" onkeypress="" value="<?php echo $telefone;?>" required="">
              <div class="w-row">
                <div class="w-col w-col-4"><input type="text" class="text-field-copy w-input" maxlength="256" name="uf_cliente" data-name="uf" placeholder="UF" id="uf" value="<?php echo $uf;?>" required=""></div>
                <div class="column w-col w-col-8"><input type="text" class="text-field-copy-copy w-input" maxlength="256" name="cidade_cliente" data-name="cidade" value="<?php echo $cidade;?>" placeholder="Cidade" id="cidade" required=""></div>
              </div><input type="text" maxlength="256" list="tipos" name="maquina_cliente" data-name="maquina_cliente" placeholder="Maquina" id="maq" class="text-field w-input"><input type="submit" value="Enviar" name="BTEnvia" data-wait="Please wait..." class="submit-button w-button" onclick="EnviaCadastro()"  ></form>

              <form target="lead" id="email-form"  name="email-form" method="post" action="processamenta.php" data-name="Email Form">
              <input type="text" class="text-field w-input" maxlength="256" name="formulario" data-name="formulario" placeholder="formulario" id="nome" required="">
              <input type="text" class="text-field w-input" maxlength="256" name="origem_cliente" data-name="formulario" placeholder="formulario" id="nome" value="<?php echo $utm; ?>" required="">

  	          <input type="text" class="text-field w-input" maxlength="256" name="nome_cliente" value="<?php echo $nome;?>" data-name="nome" placeholder="Nome" id="nome" required="">
              <input type="text" class="text-field w-input" maxlength="256" name="email_cliente" style="display: none;" data-name="nome" placeholder="Nome" id="nome" ><input type="text" class="text-field w-input" maxlength="256" name="email_cliente" data-name="email" placeholder="Email" value="<?php echo $email;?>" id="email"><input type="text" class="phone-mask" maxlength="256" name="tel_cliente" data-name="tel" placeholder="Telefone" id="tel" onKeyUp="mascaraTel(this.id)" onkeypress="" value="<?php echo $telefone;?>" required="">
              <div class="w-row">
                <div class="w-col w-col-4"><input type="text" class="text-field-copy w-input" maxlength="256" name="uf_cliente" data-name="uf" placeholder="UF" id="uf" value="<?php echo $uf;?>" required=""></div>
                <div class="column w-col w-col-8"><input type="text" class="text-field-copy-copy w-input" maxlength="256" name="cidade_cliente" data-name="cidade" value="<?php echo $cidade;?>" placeholder="Cidade" id="cidade" required=""></div>
              </div><input type="text" maxlength="256" list="tipos" name="maquina_cliente" data-name="maquina_cliente" placeholder="Maquina" id="maq" class="text-field w-input"><input type="submit" value="Enviar" name="BTEnvia" data-wait="Please wait..." class="submit-button w-button" onclick="EnviaCadastro()"  ></form>
</div>
</body>
</html>
