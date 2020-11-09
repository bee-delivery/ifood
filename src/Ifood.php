<?php

namespace BeeDelivery\ifood;

class Ifood{
    public function pedido($client_id, $client_secret, $username, $password){
        return new Pedido($client_id, $client_secret, $username, $password);
    }

}