# Crear un nuevo tipo de contenido personalizado

1. Abre la consola de comandos y ejecuta el script "composer make cpt".
2. Introduce un nombre para la clase de tu tipo de contenido personalizado. Recuerda que el nombre de la clase tiene que tener el formato UpperCamelCase.
3. Introduce un slug para el nuevo tipo de contenido personalizado. Recuerda que el slug debe estar compuesto por minísculas y separado por guiones.
4. Introduce un slug para el plural del tipo de contenido personalizado. Recuerda que el slug debe estar compuesto por minísculas y separado por guiones.
5. Revisa los archivos del nuevo tipo de contenido en la ruta src/PostsTypes/NuevoTipoDeContenido, para verificar que no queda rastro de las cadenas de ejemplo. Si así fuese, por favor, haz los cambios de forma manual y notifícamelo con una incidencia en el repositorio de GitHub para arregarlo.
6. Guarda todos los cambios que has hecho en todos los archivos.

Una vez que hayas creado tu nuevo tipo de contenido personalizado, tendrás un nuevo directorio con esta estructura:

- **NuevoTipoDeContenido:** Contiene el nuevo tipo de contenido personalizado que acabas de crear.
    - **NuevoTipoDeContenido.php:** Este es el archivo que contiene los métodos y las propiedades necesarias para desarrollar el tipo de contenido personalizado.
    - **views:** En esta carpeta podrás crear templates para que se rendericen, tanto el listado de entradas de tu tipo de contenido personalizado, como la propia entrada de dicho tipo de contenido.
        - **archive-nuevo-tipo-de-contenido.php:** Este archivo contiene el template del listado.
        - **single-nuevo-tipo-de-contenido.php:** Este archivo contiene el template de la entrada.