# Crear un nuevo shortcode

1. Abre la consola de comandos y ejecuta el script "composer make shortcode".
2. Introduce un nombre para la clase de tu shortcode. Recuerda que el nombre de la clase tiene que tener el formato UpperCamelCase.
3. Introduce una etiqueta para el nuevo shortcode. Recuerda que la etiqueta debe estar compuesta por minísculas y separada por guiones bajos.
4. Revisa los archivos del nuevo shortcode en la ruta src/Shortcodes/NuevoShortcode, para verificar que no queda rastro de las cadenas de ejemplo. Si así fuese, por favor, haz los cambios de forma manual y notifícamelo con una incidencia en el repositorio de GitHub para arregarlo.
5. Guarda todos los cambios que has hecho en todos los archivos.

- **NuevoShortcode:** Contiene un shortcode personalizado desarrollado a medida.
    - **NuevoShortcode.php:** Este es el archivo que contiene los métodos y las propiedades necesarias para desarrollar el shortcode personalizado.
    - **views:** En esta carpeta podrás crear templates para que se renderice tu shortcode.
        - **template-nuevo_shortcode.php:** Este archivo contiene el template del shortcode.