# Crear una nueva categoría para los bloques personalizados

1. Abre la consola de comandos y ejecuta el script "composer make blocks-category".
2. Introduce un nombre para la clase de tu categoría de bloques personalizados. Recuerda que el nombre de la clase tiene que tener el formato UpperCamelCase.
3. Introduce un slug para la nueva categoría de bloques personalizados. Recuerda que el slug debe estar compuesto por minísculas y separado por guiones.
4. Revisa los archivos de la nueva categoría en la ruta src/BlocksCategories/NuevaCategoriaDeBloques, para verificar que no queda rastro de las cadenas de ejemplo. Si así fuese, por favor, haz los cambios de forma manual y notifícamelo con una incidencia en el repositorio de GitHub para arregarlo.
5. Guarda todos los cambios que has hecho en todos los archivos.

Una vez que hayas creado tu nueva categoría de bloques personalizados, tendrás un nuevo directorio con esta estructura:

- **NuevaCategoriaDeBloques:** Contiene una categoría de bloques personalizada.
    - **NuevaCategoriaDeBloques.php:** Este es el archivo que contiene los métodos y las propiedades necesarias para desarrollar la categoría de bloques personalizada.