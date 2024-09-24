<?php

use PHPUnit\Framework\TestCase;

require_once './src/classes/Posnet.php';
require_once './src/classes/Tarjeta.php';

class PosnetTest extends TestCase
{
    private $posnet;

    protected function setUp(): void
    {
        $this->posnet = new Posnet();
    }

    public function testRegisterCard()
    {
        $tarjeta = new Tarjeta("12345678", "Banco X", "Visa", 5000, "12345678", "Juan", "Perez");
        $this->posnet->registerCard($tarjeta);

        $this->assertArrayHasKey("12345678", $this->posnet->getTarjetas(), "La tarjeta debería estar registrada.");
    }

    public function testDoPaymentSuccess()
    {
        $tarjeta = new Tarjeta("12345678", "Banco X", "Visa", 5000, "12345678", "Juan", "Perez");
        $this->posnet->registerCard($tarjeta);

        $result = $this->posnet->doPayment("12345678", 1000, 2);

        $this->assertEquals("Juan", $result['nombre']);
        $this->assertEquals("Perez", $result['apellido']);
        $this->assertEquals(1030, $result['monto_total']); // 3% incremento por 2 cuotas
        $this->assertEquals(515, $result['monto_por_cuota']);
    }

    public function testDoPaymentInsufficientFunds()
    {
        $tarjeta = new Tarjeta("87654321", "Banco Y", "AMEX", 500, "87654321", "Ana", "Lopez");
        $this->posnet->registerCard($tarjeta);

        $this->expectException(Exception::class);
        $this->expectExceptionMessage("Límite disponible insuficiente para realizar el pago.");
        $this->posnet->doPayment("87654321", 1000, 1);
    }
}
