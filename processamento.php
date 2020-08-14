<?php

session_start();


//API que coleta dados do usuário de maneira automática
$query = @unserialize (file_get_contents('http://ip-api.com/php/'));

//cidade do usuário coletada automaticamente via API
$cidade_coletada = $query['city'];

//uf do usuário coletada automaticamente via API
$estado_coletada = $query['regionName'];

//cep do usuário coletada automaticamente via API
$zip = $query['zip'];

//ip do usuário coletada automaticamente via API
$ip = $query['query'];



//Detecta o tipo de dispositivo que o usuário está usando
$mobile = FALSE;

$user_agents = array("iPhone","iPad","Android","webOS","BlackBerry","iPod","Symbian","IsGeneric");

foreach($user_agents as $user_agent){

    if (strpos($_SERVER['HTTP_USER_AGENT'], $user_agent) !== FALSE) {
        $mobile = TRUE;

        $modelo = $user_agent;

        break;
    }
}

if ($mobile){

    $dispositivo = strtolower($modelo);

   // echo "$dispositivo";

}else{
    
    $dispositivo = "computador";
    //echo "$dispositivo";
}

//echo "$cidade_coletada <br> $estado_coletada <br> $zip <br> $ip <br> ";

$dados_coletados = "$cidade_coletada / $estado_coletada , cep: $zip ";

include_once("conexao.php");


if (isset($_POST['BTEnvia'])) {
 
 //Variaveis de POST, Alterar somente se necessário 
 //====================================================

//Coleta a data e hora	
date_default_timezone_set('America/Sao_Paulo');
$date = date('m/d/Y h:i:s a', time());

//Coleta de qual formulário veio o LEAD
$formulario = filter_input(INPUT_POST, 'formulario', FILTER_SANITIZE_STRING);

//Coleta a origem do lead (fb, instagram, linkedin etc) quando contém "?utm_source=" no link do mesmo
$utm = filter_input(INPUT_POST, 'origem_cliente', FILTER_SANITIZE_STRING);

//Coleta o nome do usuário quando inserido (porém é um campo obrigatório)
$nome = $_POST['nome_cliente'];

//Coleta o Email do usuário quando inserido (porém é um campo obrigatório)
$email = strtolower(filter_input(INPUT_POST, 'email_cliente', FILTER_SANITIZE_STRING));

//Coleta o telefone do usuário quando inserido (porém é um campo obrigatório)
$telefone = filter_input(INPUT_POST, 'tel_cliente', FILTER_SANITIZE_STRING);

//Coleta o estado do usuário quando inserido
$uf = $_POST['uf_cliente'];

//Coleta a cidade do usuário quando inserido
$cidade = $_POST['cidade_cliente'];;

//Coleta a máquina que o usuário deseja orçar com o comercial
$maquina = $_POST['maquina_cliente'];


//coleta os dados para a tabela usuários
$_SESSION['nome_cliente'] = $nome;
$_SESSION['email_cliente']   = $email;
$_SESSION['telefone_cliente']   = $telefone;
$_SESSION['uf_cliente']   = $uf;
$_SESSION['cidade_cliente']   = $cidade;
$_SESSION['ip_cliente']   = $ip;
$_SESSION['time']     = $date;
$_SESSION['formulario_inicial']     = $formulario;
$_SESSION['origem_inicial']     = $utm;



//Envia o LEAD para a tabela leads 
$result_aprov = "INSERT INTO leads (data_cadastro, origem_usuario, formulario, nome, email, telefone, uf, cidade, maquina, ip, dispositivo, dados_coletados) VALUES ('$date', '$utm', '$formulario', '$nome','$email', '$telefone', '$uf', '$cidade', '$maquina', '$ip', '$dispositivo', '$dados_coletados')";


$resultado_aprov = mysqli_query($conn, $result_aprov);


//Envia os dados do usuário para a tabela usuário (caso tenha acessado pela primeira vez, se não, ignora)
$result_aprov = "INSERT INTO usuarios (nome, email, telefone, uf, cidade, primeiro_acesso, primeiro_form, primeira_origem) VALUES ('{$_SESSION['nome_cliente']}', '{$_SESSION['email_cliente']}', '{$_SESSION['telefone_cliente']}', '{$_SESSION['uf_cliente']}','{$_SESSION['cidade_cliente']}', '{$_SESSION['time']}', '{$_SESSION['formulario_inicial']}', '{$_SESSION['origem_inicial']}')";

$resultado_aprov = mysqli_query($conn, $result_aprov);


 //====================================================
 
 //REMETENTE --> ESTE EMAIL TEM QUE SER VALIDO DO DOMINIO
 //==================================================== 
 $email_remetente = "terrazul@epicacreative.com.br"; // deve ser uma conta de email do seu dominio 
 //====================================================
 
 //Configurações do email, ajustar conforme necessidade
 //==================================================== 
 $email_destinatario = "guiosimura@hotmail.com, gustavo@epicacreative.com.br"; // pode ser qualquer email que receberá as mensagens
 $email_reply = "gustavo@epicacreative.com.br"; 
 $email_assunto = "Formulário do site"; // Este será o assunto da empresa
 //====================================================
 
 //Monta o Corpo da Mensagem
 //====================================================

 $email_conteudo = "nome $nome , de $cidade - $uf\n"; 
 $email_conteudo .= "deseja $maquina\n";
 $email_conteudo .= "Telefone $telefone\n"; 
 $email_conteudo .= "Email $email \n"; 
 $email_conteudo .= "Origem do lead $utm \n"; 

 //====================================================
 
 //Seta os Headers (Alterar somente caso necessario) 
 //==================================================== 
 $email_headers = implode ( "\n",array ( "From: $email_remetente", "Reply-To: $email_reply", "Return-Path: $email_remetente","MIME-Version: 1.0","X-Priority: 3","Content-Type: text/html; charset=UTF-8" ) );
 //====================================================
 
 //Enviando o email 
 //==================================================== 
 if (mail ($email_destinatario, $email_assunto, nl2br($email_conteudo), $email_headers)){ 
 echo "enviado com sucesso"; 
 echo "<style> #formu { display: none; } </style>";
 } 
 else{ 
 echo "</b>Falha no envio do E-Mail!</b>"; } 
 //====================================================
} 













?>

<!DOCTYPE html>
<html lang="pt-br">
	<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		
		<title>Conexão DB</title>	
		
	</head>
	</html>