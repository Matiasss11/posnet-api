# Proyecto POSNET API

Este proyecto es una API para gestionar el registro de tarjetas y procesar pagos utilizando las clases `Posnet` y `Tarjeta`. La API se desarrolla en PHP y utiliza PHPUnit para las pruebas.

## Estructura del Proyecto

- `src/`
  - `api/` - Contiene los endpoints de la API.
  - `classes/` - Contiene las clases utilizadas por la API.
- `tests/` - Contiene los tests unitarios para las clases y la lógica de la API.
- `vendor/` - Contiene las dependencias del proyecto (ignoradas en el control de versiones).
- `index.php` - Punto de entrada de la API.

## Instalación

1. Clona el repositorio:
   ```bash
   git clone <url_del_repositorio>
   cd <nombre_del_repositorio>
2. composer install

3. 1. Registrar tarjeta
Método: POST
Endpoint: /index.php/posnet?action=registerCard
Body:
{
    "numero": "12345678",
    "entidadBancaria": "Banco X",
    "tipo": "Visa",
    "limiteDisponible": 5000,
    "titularDNI": "12345678",
    "titularNombre": "Juan",
    "titularApellido": "Perez"
}

3. 2. Procesar pago
Método: POST
Endpoint: /index.php/posnet?action=doPayment
Body:
{
    "numeroTarjeta": "12345678",
    "monto": 1000,
    "cuotas": 2
}
