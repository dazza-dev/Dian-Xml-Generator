# FACTURA ELECTRONICA

Estructura de datos para la generación de facturas electrónicas ante la DIAN.

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

Datos de quien emite el documento electrónico.

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

Datos de quien recibe el documento electrónico.

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

### Resolución de factura electronica (solo para facturas y documentos soporte)

Datos de la resolución de facturación electronica asociada en el software (para habilitación siempre son estos).

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

Datos de los totales del documento electrónico.

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

Datos de los pagos asociados al documento electrónico.

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

Impuestos del documento electrónico.

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

Datos de las lineas o items del documento electrónico. cada linea incluye impuestos, descuentos o cargos aplicados a nivel de item.

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
        'reason_code' => '00', // Código del motivo del descuento o cargo (ver listado de códigos)
        'percentage' => 10.00, // Porcentaje de descuento o cargo
        'amount' => 840.34, // Monto del descuento o cargo
        'base_amount' => 8403.36, // Monto base del descuento o cargo
    ],
];
```

### Notas Crédito/Débito

Cuando emitimos notas crédito o débito la DIAN nos pide que enviemos el motivo por el cual se emite esta misma.

```php
'operation_type' => '2' // Anulación de factura electrónica
```

### Instanciar `DocumentBuilder`

```php
use DazzaDev\DianXmlGenerator\Builder\DocumentBuilder;

$documentBuilder = new DocumentBuilder(
    type: 'invoice', // invoice, support-document, credit-note o debit-note
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
