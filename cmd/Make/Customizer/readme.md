# Crear un nuevo panel/sección/opción en el personalizador

1. Abre la consola de comandos y ejecuta el script "composer make customizer [panel | section | control]".
2. Introduce un nombre para la clase de tu panel, sección u opción. Recuerda que el nombre de la clase tiene que tener el formato UpperCamelCase.
3. Introduce un slug para el nuevo panel, sección u opción. Recuerda que el slug debe estar compuesto por minísculas y separado por guiones.
4. Revisa los archivos de la nueva clase en su ruta correspondiente* para verificar que no queda rastro de las cadenas de ejemplo. Si así fuese, por favor, haz los cambios de forma manual y notifícamelo con una incidencia en el repositorio de GitHub para arregarlo.
5. Guarda todos los cambios que has hecho en todos los archivos.

Una vez que hayas creado tu nueva clase, tendrás un nuevo directorio con esta estructura, dentro de la ruta correspondiente*:

- **NuevaClase:** Contiene un panel, una sección o una opción del personalizador de WordPress, desarrollado a medida.
    - **NuevaClase.php:** Este es el archivo que contiene los métodos y las propiedades necesarias para desarrollar el panel, la sección o la opción del personalizador.

## Rutas correspondientes a cada elemento*

- **Panel:** src/Customizer/Panels/NuevoPanel
- **Sections:** src/Customizer/Sections/NuevaSeccion
- **Controls:** src/Customizer/Controls/NuevoControl