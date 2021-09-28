# Crear un nuevo endpoint personalizado

1. Abre la consola de comandos y ejecuta el script "composer make endpoint".
2. Introduce un nombre para la clase de tu endpoint personalizado. Recuerda que el nombre de la clase tiene que tener el formato UpperCamelCase.
3. Introduce una ruta para llamar al controlador del nuevo endpoint. Recuerda que la ruta debe estar compuesta por minísculas y separada por guiones.
4. Revisa los archivos del nuevo endpoint en la ruta src/Endpoints/NuevoEndpoint, para verificar que no queda rastro de las cadenas de ejemplo. Si así fuese, por favor, haz los cambios de forma manual y notifícamelo con una incidencia en el repositorio de GitHub para arregarlo.
5. Guarda todos los cambios que has hecho en todos los archivos.

Una vez que hayas creado tu nuevo endpoint personalizado, tendrás un nuevo directorio con esta estructura:

- **NuevoEndpoint:** Contiene el nuevo endpoint que acabas de crear.
    - **NuevoEndpoint.php:** Este es el archivo que contiene los métodos y las propiedades necesarias para desarrollar el endpoint personalizado.