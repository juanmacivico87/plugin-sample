# Crear un nuevo campo para la API Rest

1. Abre la consola de comandos y ejecuta el script "composer make rest-api-field".
2. Introduce un nombre para la clase de tu campo personalizado para la API Rest. Recuerda que el nombre de la clase tiene que tener el formato UpperCamelCase.
3. Revisa los archivos del nuevo campo personalizado para la API Rest en la ruta src/RestApi/NuevoCampoApiRest, para verificar que no queda rastro de las cadenas de ejemplo. Si así fuese, por favor, haz los cambios de forma manual y notifícamelo con una incidencia en el repositorio de GitHub para arregarlo.
4. Guarda todos los cambios que has hecho en todos los archivos.

Una vez que hayas creado tu nuevo campo personalizado para la API Rest, tendrás un nuevo directorio con esta estructura:

- **NuevoCampoApiRest:** Contiene un campo personalizado para la API Rest desarrollado a medida.
    - **NuevoCampoApiRest.php:** Este es el archivo que contiene los métodos y las propiedades necesarias para desarrollar el campo personalizado para la API Rest.