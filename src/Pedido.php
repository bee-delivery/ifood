<?php

namespace BeeDelivery\ifood;

class Pedido
{

    public $http;

    public function __construct($client_id, $client_secret, $username, $password) {

        $this->http = new Connection($client_id, $client_secret, $username, $password);
    }


    /**
     * listar os pedidos
     *
     */
    public function listar()
    {
        return $this->http->get('/v3.0/events:polling');
    }

    /**
     * Consulta os dados de um pedido
     *
     */
    public function consultar($id)
    {
        return $this->http->get('/v3.0/orders/'.$id);
    }


}
