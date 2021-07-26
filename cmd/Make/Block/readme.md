# Crear un nuevo bloque de Gutenberg

1. Abre la consola de comandos y ejecuta el script "composer make block".
2. Introduce un nombre para la clase de tu bloque. Recuerda que el nombre de la clase tiene que tener el formato UpperCamelCase.
3. Introduce un slug para el nuevo bloque. Recuerda que el slug debe estar compuesto por minísculas y separada por guiones.
4. Introduce una etiqueta para el nuevo bloque. Recuerda que la etiqueta debe estar compuesta por minísculas y separada por guiones bajos.
5. Revisa los archivos del nuevo bloque en la ruta src/Blocks/NuevoBloque, para verificar que no queda rastro de las cadenas de ejemplo. Si así fuese, por favor, haz los cambios de forma manual y notifícamelo con una incidencia en el repositorio de GitHub para arregarlo.
6. Guarda todos los cambios que has hecho en todos los archivos.

- **NuevoBloque:** Contiene un bloque personalizado desarrollado gracias a la función "acf_register_block_type()" de ACF (muy útil para aquellos que no sabemos desarrollar bloques con React).
    - **NuevoBloque.php:** Este es el archivo que contiene los métodos y las propiedades necesarias para desarrollar la funcionalidad del bloque.
    - **css:** En este archivo, podrás definir propiedades de CSS propias de este bloque, las cuales solamente se cargarán en el sistema cuando el bloque se haya contribuido.
    - **js:** En este archivo, podrás definir funciones de Javascript propias de este bloque, las cuales solamente se cargarán en el sistema cuando el bloque se haya contribuido.
    - **views:** En esta carpeta podrás crear un template con el HTML que quieras que se renderice desde el front, o desde el editor de tu web, así como las funciones de WordPress que creas necesarias, como si se tratase de un template-part de un tema.
        - **template-nuevo_bloque.php:** Este archivo contiene el template del bloque.