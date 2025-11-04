## Objetivo del ejercicio:

Desarrollar un **carrito de compras** en PHP utilizando un **Map** que contenga 20 productos predefinidos con sus nombres completos y sus respectivos precios. El **Map** de productos debe estar almacenado en un archivo PHP específico y no dentro del código de la aplicación directamente. El programa debe leer los productos desde este archivo, mostrarlos dinámicamente en un archivo **index.php** y permitir que el usuario seleccione la cantidad que desea comprar de cada producto.

Es recomendable usar las funciones **`json_encode()`** y **`json_decode()`** para almacenar y recuperar el carrito de compras (que será un array) en las **cookies** de manera eficiente.

## Requisitos:

1. **Archivo de productos**:
   - Los productos y sus precios estarán almacenados en un archivo PHP llamado `productos.php`. Este archivo contendrá un **Map** en PHP que asocia los nombres completos de los productos con sus precios.
   - El archivo `index.php` debe leer este archivo para obtener la lista de productos y sus precios de manera dinámica.

2. **Mostrar productos en una página dinámica**:
   - En `index.php`, los productos y precios extraídos del archivo `productos.php` deben mostrarse en una lista generada dinámicamente. Para cada producto, el usuario debe poder ingresar la cantidad que desea comprar mediante un campo de entrada.
   - El listado no debe estar codificado manualmente en el HTML, sino que debe generarse automáticamente usando PHP para leer los productos desde el archivo.

3. **Interacción del usuario**:
   - El usuario puede seleccionar la cantidad de productos que desea añadir al carrito de compras. Después de que el usuario ingrese las cantidades y envíe el formulario, la información debe ser almacenada en **una cookie** para mantener el carrito persistente cuando el usuario cierre y reabra el navegador.
   
4. **Almacenamiento del carrito usando `json_encode()` y `json_decode()`**:
   - Como las **cookies solo pueden almacenar cadenas de texto** y no arrays directamente, se recomienda usar las funciones `json_encode()` y `json_decode()` para manejar el carrito de compras.
   - **`json_encode()`**: Esta función convierte un array en una cadena JSON que puede almacenarse en una cookie.
   - **`json_decode()`**: Esta función se usa para convertir la cadena JSON almacenada en la cookie de nuevo a un array de PHP cuando sea necesario.
   - Ejemplo:
     - Para almacenar un array en una cookie: `setcookie('carrito', json_encode($carrito), time() + 86400, "/");`
     - Para recuperar el array de la cookie: `$carrito = json_decode($_COOKIE['carrito'], true);`

5. **Guardar la información**:
   - El **Map** de productos debe estar almacenado en el archivo `productos.php` y no codificado directamente en `index.php`. Esto asegura que los productos sean fáciles de modificar y mantener. 

6. **Gastos de envío y total de la compra**:
   - El sistema debe calcular el **total de la compra** sumando el precio de cada producto por la cantidad seleccionada por el usuario.
   - Además, debe calcular los **gastos de envío**, que son el **2% del total**, pero con un **mínimo de 5€**.
   - Ejemplo:
     - Si el total de la compra es 100€, el 2% serían 2€, pero como el mínimo es 5€, los gastos de envío serán 5€.
     - Si el total es 300€, el 2% serían 6€, por lo que en este caso los gastos de envío serían 6€.

7. **Eliminar o actualizar el carrito**:
   - El usuario debe poder vaciar el carrito, lo que eliminaría la cookie, o actualizar las cantidades de productos en cualquier momento.

### Pasos del flujo del programa:

1. **index.php**:
   - Al cargar la página, `index.php` debe leer el archivo `productos.php` para obtener la lista de productos y sus precios.
   - Luego, generar dinámicamente un formulario con la lista de productos. Cada producto debe tener un campo de texto en el que el usuario pueda ingresar la cantidad deseada.
   
2. **Formulario de compra**:
   - Al enviar el formulario (guardar carrito), los datos de las cantidades seleccionadas deben procesarse en otra página (o en el mismo `index.php`), donde se almacenarán en **una cookie**.
   
3. **Almacenamiento del carrito**:
   - Para mantener los datos del carrito persistentes entre sesiones, se deben utilizar cookies. Para almacenar el array del carrito en una cookie, se usará la función `json_encode()` para convertir el array en una cadena JSON.
   - Cuando se necesite acceder al carrito, se debe leer la cookie y convertirla nuevamente en un array con `json_decode()`.

### Estructura del archivo `productos.php`:

El archivo `productos.php` contiene un **Map** en PHP con 20 productos, cada uno con su nombre completo y su precio correspondiente.

