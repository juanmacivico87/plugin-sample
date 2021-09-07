# Crear una nueva taxonomía

1. Abre la consola de comandos y ejecuta el script "composer make taxonomy [hieralchical | not-hieralchical]".
2. Introduce un nombre para la clase de tu taxonomía. Recuerda que el nombre de la clase tiene que tener el formato UpperCamelCase.
3. Introduce un slug para la nueva taxonomía. Recuerda que el slug debe estar compuesto por minísculas y separado por guiones.
4. Revisa los archivos de la nueva clase en la ruta src/Taxonomies/NuevaTaxonomia para verificar que no queda rastro de las cadenas de ejemplo. Si así fuese, por favor, haz los cambios de forma manual y notifícamelo con una incidencia en el repositorio de GitHub para arregarlo.
5. Guarda todos los cambios que has hecho en todos los archivos.

Una vez que hayas creado tu nueva clase, tendrás un nuevo directorio con esta estructura:

- **NuevaTaxonomia:** Contiene una taxonomía personalizada.
    - **NuevaTaxonomia.php:** Este es el archivo que contiene los métodos y las propiedades necesarias para desarrollar la taxonomía.
        - **views:** En esta carpeta podrás crear un template para que renderice el listado de entradas de tu taxonomía.
            - **taxonomy-nueva-taxonomia.php:** Este archivo contiene el template del listado de entradas de tu taxonomía.