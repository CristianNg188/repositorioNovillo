<?php

class MensajeFlash {

    static function guardarMensaje($mensaje) {
        $_SESSION['mensajesFlash'][] = $mensaje;
    }

    static function imprimirMensajes() {
        if (isset($_SESSION['mensajesFlash'])) {
            foreach ($_SESSION['mensajesFlash'] as $mensaje)
            {
                print '<p style="mensajeErrGenerico">' . $mensaje . '</p>';
            }
            unset($_SESSION['mensajesFlash']);
        }
    }
    
    static function tieneErroresSesion(){
        if (isset($_SESSION['mensajesFlash'])) {
            if($_SESSION['mensajesFlash'][0]=="Usuario o contraseña incorrectos"){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    static function tieneErroresGenericos(){
        if (isset($_SESSION['mensajesFlash'])) {
            if($_SESSION['mensajesFlash'][0]!="Usuario o contraseña incorrectos"){
                return true;
            }else{
                return false;
            }
        }else{
            return false;
        }
    }
    
    static function quitarErrores() {
        unset($_SESSION['mensajesFlash']);
    }

}
