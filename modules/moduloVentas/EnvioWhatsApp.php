<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
#EAAJSSgThKpABAEaBO1ASECIErbtgdeq5siI5nL3qhX4KBKI3EI0sLyrZAZBw3Cs5YaP5lCPGTFjNLZB10htJH9A40ZCBCOTKOX8X5qucE8NjZA2NLleSTyMZCZB7ZB36DPjhUWYhKett2VbZAFNFNESXapH09li8TDgYjlvBCd6zAO9Q7J92aoXZCN
if (isset($_POST['NumeroRecivido'])) {
    $telefonoRecivido = $_POST['NumeroRecivido'];
    $telefono='52'.$telefonoRecivido;
}
$token = "EAAJSSgThKpABAEaBO1ASECIErbtgdeq5siI5nL3qhX4KBKI3EI0sLyrZAZBw3Cs5YaP5lCPGTFjNLZB10htJH9A40ZCBCOTKOX8X5qucE8NjZA2NLleSTyMZCZB7ZB36DPjhUWYhKett2VbZAFNFNESXapH09li8TDgYjlvBCd6zAO9Q7J92aoXZCN";


$url = 'https://graph.facebook.com/v17.0/102187289605465/messages';


/**
 * $contenido_mensaje = 'Hola, este es un mensaje de texto sin formato.'; // Reemplaza este contenido con el mensaje que deseas enviar
 *  Construir el cuerpo de la solicitud
 *    $mensaje = json_encode([
 *   "messaging_product" => "whatsapp",
 *   "recipient_type" => "individual",
 *   "to" => $telefono,
 *   "type" => 'text',
 *   "text" => [
 *       "preview_url" => false,
 *       "body" => $contenido_mensaje
 *   ]
 * ]);
 */

$mensaje = json_encode([
    "messaging_product" => "whatsapp",
    "to" => $telefono,
    "type" => "template",
    "template" => [
        "name" => "hello_world",
        "language" => ["code" => "en_US"]
    ]
]);

$headers = array(
    "Authorization: Bearer ".$token,
    "Content-Type: application/json"
);

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $mensaje);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

$response = json_decode(curl_exec($curl), true);
$status_code = curl_getinfo($curl, CURLINFO_HTTP_CODE);
if ($status_code !== 200) {
    echo "<script>window.location = '../../index.php?module=ventaSemanal&EnvioWhatsApp=NoRealizado'</script>";

}else{
    echo "<script>window.location = '../../index.php?module=ventaSemanal&EnvioWhatsApp=Realizado'</script>";
}

curl_close($curl);

?>
