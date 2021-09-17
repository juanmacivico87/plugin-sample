# Crear una nueva página de ajustes

1. Abre la consola de comandos y ejecuta el script "composer make settings [core | acf]". La primera opción creará una página de ajustes con las funciones nativas de WordPress. La segunda lo hará con las funciones del plugin Advanced Custom Field.
2. Introduce un nombre para la clase de tu página de ajustes. Recuerda que el nombre de la clase tiene que tener el formato UpperCamelCase.
3. Introduce una etiqueta para la nueva página de ajustes. Recuerda que la etiqueta debe estar compuesta por minísculas y separada por guiones bajos.
4. Revisa los archivos de la nueva clase en la ruta src/Settings para verificar que no queda rastro de las cadenas de ejemplo. Si así fuese, por favor, haz los cambios de forma manual y notifícamelo con una incidencia en el repositorio de GitHub para arregarlo.
5. Guarda todos los cambios que has hecho en todos los archivos.

Una vez que hayas creado tu nueva clase, tendrás un nuevo archivo con las funciones necesarias para desarrollar tu página de ajustes.