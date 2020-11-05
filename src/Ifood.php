<?php

namespace BeeDelivery\ifood;

use BeeDelivery\ifood\src\Pedido;

class ifood{	
    public function pedido($client_id, $client_secret, $username, $password){
        return new Pedido($client_id, $client_secret, $username, $password);
    }

}