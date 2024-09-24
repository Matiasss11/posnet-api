<?php

class Posnet
{
    private $tarjetas = [];

    // Método para registrar una tarjeta
    public function registerCard(Tarjeta $tarjeta)
    {
        if ($tarjeta->getTipo() !== "Visa" && $tarjeta->getTipo() !== "AMEX") {
            throw new Exception("Tipo de tarjeta no permitido. Solo VISA y AMEX.");
        }

        // Almacenar la tarjeta en el arreglo usando el número de tarjeta como clave
        $this->tarjetas[$tarjeta->getNumero()] = $tarjeta;
    }

    // Método para buscar una tarjeta por número
    private function findCard($numeroTarjeta)
    {
        return isset($this->tarjetas[$numeroTarjeta]) ? $this->tarjetas[$numeroTarjeta] : null;
    }

    // Método para procesar un pago
    public function doPayment($numeroTarjeta, $monto, $cuotas)
    {
        // Buscar la tarjeta
        $tarjeta = $this->findCard($numeroTarjeta);
        if (!$tarjeta) {
            throw new Exception("Tarjeta no encontrada.");
        }

        // Calcular el recargo si hay cuotas
        $recargo = 0;
        if ($cuotas > 1) {
            $recargo = ($cuotas - 1) * 0.03; // 3% por cuota adicional
        }

        $montoTotal = $monto * (1 + $recargo);

        // Verificar si hay límite disponible
        if ($tarjeta->getLimiteDisponible() < $montoTotal) {
            throw new Exception("Límite disponible insuficiente para realizar el pago.");
        }

        $tarjeta->setLimiteDisponible($tarjeta->getLimiteDisponible() - $montoTotal);

        return $this->generateTicket($tarjeta, $montoTotal, $cuotas);
    }

    // Método para generar un ticket
    private function generateTicket(Tarjeta $tarjeta, $montoTotal, $cuotas)
    {
        $montoPorCuota = $montoTotal / $cuotas;

        return [
            'nombre' => $tarjeta->getTitularNombre(),
            'apellido' => $tarjeta->getTitularApellido(),
            'monto_total' => $montoTotal,
            'monto_por_cuota' => $montoPorCuota,
        ];
    }

    public function getTarjetas()
    {
        return $this->tarjetas;
    }
}
