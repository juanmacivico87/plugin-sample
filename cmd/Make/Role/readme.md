# Crear un nuevo rol personalizado

1. Abre la consola de comandos y ejecuta el script "composer make role".
2. Introduce un nombre para la clase de tu rol personalizado. Recuerda que el nombre de la clase tiene que tener el formato UpperCamelCase.
3. Introduce un slug para el nuevo rol personalizado. Recuerda que el slug debe estar compuesto por minísculas y separado por guiones.
4. Revisa los archivos del nuevo rol en la ruta src/Roles/NuevoRol, para verificar que no queda rastro de las cadenas de ejemplo. Si así fuese, por favor, haz los cambios de forma manual y notifícamelo con una incidencia en el repositorio de GitHub para arregarlo.
5. Guarda todos los cambios que has hecho en todos los archivos.

Una vez que hayas creado tu nueva rol personalizado, tendrás un nuevo directorio con esta estructura:

- **NuevoRol:** Contiene un rol personalizado desarrollado a medida.
    - **NuevoRol.php:** Este es el archivo que contiene los métodos y las propiedades necesarias para desarrollar el rol personalizado.