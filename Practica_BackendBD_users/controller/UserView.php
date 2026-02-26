<?php

class UserView{
    public function __construct() {}


    public function display($template = null, $data = null) {
        if ($template != null) {
            // Extraer las variables del array para que estén disponibles en la vista
            if (is_array($data)) {
                extract($data);
            }
            include($template);
        }
    }
}
?>