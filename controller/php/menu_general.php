<?php

    if (isset($_GET["module"])) {  
        # code...
        $option = $_GET["module"];
        switch ($option) {
            case 'menu':
                
                if ($_SERVER["REQUEST_METHOD"] === "POST") { 
                    /**
                     * Verificar si se ha enviado una solicitud POST
                     * Capturar los valores de user y password del formulario
                     * valores capturados user y password
                     * la contraseña ya va hasheada en md5
                     */
                    $user_login = $_POST["user"];
                    $password_login = md5($_POST["password"]);
                    
                    
                    // Funciones que muestran los errores de consulta en la pantalla
                    ini_set('display_errors', 1);
                    ini_set('display_startup_errors', 1);
                    error_reporting(E_ALL);
                    
                    /**
                     * Consulta a la base de datos tomando en cuenta los parámetros
                     * ingresados por el usuario (nombre de usuario y contraseña)
                     */
                    $SQL = "SELECT usuario, contrasena FROM usuarios 
                    WHERE usuario = '$user_login' 
                    AND contrasena = '$password_login'";
                    $resultado = Consulta($SQL);
                    
                    if (!empty($resultado)) {
                        
                        include_once("view/menu/menu.php");
                    } else {
                        ?>
                        <script>alert('¡Credenciales inválidas!')</script>
                        <?php
                        include_once("view/login/login.php");
                    }
                    
                }
                break;   
            case 'articulo':
                include_once("view/menu/menu.php"); 
                include_once("modules/moduloArticulos/Articulos.php");        
                break;
            case 'usuario':
                include_once("view/menu/menu.php"); 
                include_once("modules/moduloUsuario/usuario.php");
                
                break;
            case 'configuracion':
                include_once("view/menu/menu.php");
                include_once("modules/moduloConfiguracion/configuracion.php");
                break;
            case 'cerrarSesion':
                include_once("view/login/login.php");
                break;
                case 'recuperarContrasena':
                    include_once("view/login/recuperarcontrasena.php");
                    break;
                case 'solicitudContrasena':
                    /**
                         * Verificar si se ha enviado una solicitud POST
                         * Capturar los valores de correo electronico
                         * 
                         */
                    if ($_SERVER["REQUEST_METHOD"] === "POST") { 
                        $user = $_POST["user"];
                        /**
                         * Consulta a la base de datos tomando en cuenta los parámetros
                         * ingresados por el usuario (user)
                         */
                        $SQL = "SELECT * FROM usuarios WHERE correo = '$user'";
                        $resultado = Consulta($SQL);
                        #verifica si la variable $resultado no está vacía.
                        if (!empty($resultado)) {
                            $SQL = "UPDATE usuarios SET estatus_usuario = 'pendiente' WHERE usuario = '$user';";
                            
                            $resultadoUpdate = Actualizar($SQL);
                            if($resultadoUpdate){
                                ?>
                                <script>alert('¡Solicitud enviada al administrador correctamente!')</script>
                                <?php
                                include_once("view/login/login.php");
                            }else{
                                ?>
                                <script>alert('¡Este usuario tiene una solicitud pendiente!')</script>
                                <?php
                                include_once("view/login/login.php");
                            }
                        } else {
                            
                            echo "<script>alert('¡No se encontró el usuario: " . $gmail . "');</script>";

                            
                             include_once("view/login/recuperarcontrasena.php");
                        }
                        
                    }
                        
                        break;
            default:
                # code...
                break;
        }
    }else{
       include_once("view/login/login.php");
    }

?>