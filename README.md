# DIAN XML GENERATOR

Paquete para la generación de archivos XML validos para la factura electrónica DIAN.

## Instalación

```bash
composer require dazza-dev/dian-xml-generator
```

## Uso

Primero vamos a entender la estructura de los datos que debemos pasar al constructor.

### Software

Datos del software propio creado en el modulo de habilitacion de la [DIAN](https://catalogo-vpfe-hab.dian.gov.co/User/Login).

```php
$software = [
    'identifier' => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
    'test_set_id' => 'xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx',
    'pin' => 'pin_software',
];
```

### Encabezados

Datos de la factura como Prefijo y numero de factura etc.

```php
$documentData = [
    'operation_type' => '10',
    'prefix' => 'SETP',
    'number' => '990000001',
    'date' => '2024-01-17 10:30:00-05:00',
    'currency' => 'COP',
    'note' => 'notas de prueba',
    'payment_mean' => '1',
    'company' => ...
];
```

### Emisor

Datos de quien emite el documento electronico.

```php
'company' => [
    'identification_type' => 31,
    'identification_number' => '123456789',
    'entity_type' => 1,
    'regime' => 49,
    'liability' => 'R-99-PN',
    'name' => 'EMPRESA EJEMPLO S.A.S.',
    'email' => 'contacto@empresa-ejemplo.com',
    'phone' => '3001234567',
    'merchant_registration' => '12345678',
    'address' => 'Carrera 10 # 20-30',
    'city' => '11001',
    'state' => '11',
    'country' => 'CO'
];
```

### Receptor

Datos de quien recibe el documento electronico.

```php
'customer' => [
    'identification_type' => 13,
    'identification_number' => '987654321',
    'entity_type' => 2,
    'regime' => 49,
    'liability' => 'R-99-PN',
    'name' => 'Juan Pérez',
    'email' => 'juan.perez@email.com',
    'phone' => '3109876543',
    'address' => 'Calle 45 # 67-89',
    'city' => '11001',
    'state' => '11',
    'country' => 'CO'
];
```

### Resolucion de factura electronica (solo para facturas)

Datos de la resolucion de facturacion electronica asociada en el software (para habilitacion siempre son estos).

```php
'numbering_range' => [
    'prefix' => 'SETP',
    'authorized_code' => '18760000001',
    'start_date' => '2019-01-19',
    'end_date' => '2030-01-19',
    'start_number' => '990000000',
    'end_number' => '995000000'
];
```

### Totales

Datos de los totales del documento electronico.

```php
'totals' => [
    'line_extension_amount' => 8403.36,
    'tax_exclusive_amount' => 8403.36,
    'tax_inclusive_amount' => 10000,
    'prepaid_amount' => 10000,
    'payable_amount' => 10000
];
```

### Pagos

Datos de los pagos asociados al documento electronico.

```php
'payments' => [
    [
        'amount' => 10000,
        'received_date' => '2024-01-17T10:30:00Z',
        'paid_date' => '2024-01-17T10:30:00Z',
        'payment_method' => '10',
        'payment_reference' => '1234567890'
    ]
];
```

### Impuestos

Impuestos del documento electronico.

```php
'taxes' => [
    [
        'code' => '01',
        'percent' => 19.0,
        'tax_amount' => 1596.64,
        'taxable_amount' => 8403.36
    ]
];
```

### Orden de compra

Para referenciar una orden de compra en la factura.

```php
'order_reference' => [
    'number' => 'purchase_order_number',
    'issue_date' => '2024-01-17T10:30:00Z',
];
```

### Items (productos o servicios del documento)

Datos de las lineas o items del documento electronico. cada linea incluye impuestos, descuentos o cargos aplicados a nivel de item.

```php
'line_items' => [
    [
        'name' => 'Producto 1',
        'code' => '1234567890',
        'quantity' => 1.0,
        'unit_code' => '94',
        'unit_price' => 8403.36,
        'total_amount' => 8403.36,
        'free_of_charge' => false,
        'item_type' => '010',
        'taxes' => [
            [
                'code' => '01',
                'percent' => 19.0,
                'tax_amount' => 1596.64,
                'taxable_amount' => 8403.36
            ]
        ],
        'allowance_charges' => ...
    ]
];
```

### Cargos o descuentos

Para aplicar cargos o descuentos a nivel de item.

```php
'allowance_charges' => [
    [
        'is_charge' => true, // true: cargo, false: descuento
        'reason_code' => '00', // Codigo del motivo del descuento o cargo (ver listado de codigos)
        'percentage' => 10.00, // Porcentaje de descuento o cargo
        'amount' => 840.34, // Monto del descuento o cargo
        'base_amount' => 8403.36, // Monto base del descuento o cargo
    ],
];
```

### Notas Crédito/Débito

Cuando emitimos notas crédito o débito la dian nos pide que enviemos el motivo por el cual se emite esta misma.

```php
'operation_type' => '2' // Anulación de factura electrónica
```

### Listado de codigos permitidos

Este repositorio contiene los listados oficiales de datos que deben ser utilizados para la emisión de facturas electrónicas ante la DIAN. Es crucial que los códigos enviados en los campos del documento coincidan exactamente con los establecidos por la DIAN, de lo contrario, la factura será rechazada.

- [Listado](./data)

### Instanciar `DocumentBuilder`

```php
use DazzaDev\DianXmlGenerator\Builder\DocumentBuilder;

$documentBuilder = new DocumentBuilder(
    type: 'invoice',
    documentData: $documentData,
    environment: '2', // 1: Producción, 2: Pruebas
    software: $software,
);
```

### Generar el XML

```php
$xml = $documentBuilder->getXml();
```

### Obtener el documento

```php
$document = $documentBuilder->getDocument();
```

## Contribuciones

Contribuciones son bienvenidas. Si encuentras algún error o tienes ideas para mejoras, por favor abre un issue o envía un pull request. Asegúrate de seguir las guías de contribución.

## Autor

Dian XML Generator fue creado por [DAZZA](https://github.com/dazza-dev).

## Licencia

Este proyecto está licenciado bajo la [Licencia MIT](https://opensource.org/licenses/MIT).
