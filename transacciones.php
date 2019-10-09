<?php

include_once 'db.php';

class transacciones extends DB{
    
   

    function obtenertransacciones($id){
        $query = $this->connect()->prepare('SELECT * FROM transacciones WHERE id_usuario = :id');
        $query->execute(['id' => $id]);
        return $query;
    }

    function nuevatransaccion($transaccion){
        $query = $this->connect()->prepare('INSERT INTO transacciones (id_usuario, certificado, monto, fecha, comprobado, puntero) VALUES (
            :id_usuario, :certificado, :monto, :fecha, :comprobado, :puntero)');
        $query->execute(['id_usuario' => $transaccion['id_usuario'], 'certificado' => $transaccion['certificado'], 'monto' => $transaccion['monto'], 
        'fecha' => $transaccion['fecha'], 'comprobado' => $transaccion['comprobado'], 'puntero' => $transaccion['puntero'], ]);
        return $query;
    }

}

?>