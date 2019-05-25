<?php

class LogoutJs
{
    private function _logout_js()
    {
        // Inicializar la sesión.
        session_start();
        // Destruir todas las variables de sesión.
        $_SESSION = array();
        // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
        // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
                );
        }
        // Finalmente, destruir la sesión.
        session_destroy();
        // Volver al inicio
        return 'salidaExitosa';
    }
    public function logout_js()
    {
        return $this->_logout_js();
    }
}
//Saliendo del sistema
$logout = new LogoutJs();
echo $logout->logout_js();
