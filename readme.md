# Plugin sample

Este repositorio contiene un boilerplate para desarrollar plugins para WordPress a partir del mismo. El plugin alojado en este repositorio solamente tiene funcionalidades de prueba, las cuales puedes tomar como ejemplo para desarrollar las tuyas propias.

## Requisitos mínimos

Para poder desarrollar tu propio plugin a partir de este ejemplo, vas a necesitar, como mínimo:

- [WordPress](https://es.wordpress.org/download/)
- PHP 7.4
- [Composer 1.10.7](https://getcomposer.org/download/)
- Ganas de desarrollar un plugin para WordPress

## Primeros pasos para crear tu plugin

1. Entra en la [URL del repositorio](https://github.com/juanmacivico87/plugin-sample). Seguramente, si estás leyendo esto, ya estarás en ella.
2. Ve a la carpeta plugins de tu instalación de WordPress (preferiblemente, en un entorno de desarrollo).
3. Abre una consola de comandos en esta ruta y ejecuta el comando "git clone https://github.com/juanmacivico87/plugin-sample.git". Esto creará un clon del plugin de ejemplo en tu carpeta de plugins.
4. Renombra la carpeta del plugin descargado con el slug que tú le quieras dar, en minúscula y separado por guiones (por ejemplo: "my-custom-plugin").
5. Entra dentro de la carpeta del plugin y edita el archivo ".data". En él, tendrás que facilitar la siguiente información:
    - **PLUGIN_NAME:** Especifica cómo se va a llamar el plugin que vas a desarrollar.
    - **PLUGIN_DESCRIPTION:** Escribe una descripción, para que así, los usuarios que instalen tu plugin tengan una referencia de lo que hace.
    - **PLUGIN_SLUG:** Es el mismo que el nombre que has utilizado para la carpeta del plugin.
    - **PLUGIN_URI:** Si tienes una URL en la que se pueda ver tu plugin, este es el sitio para indicarla. Por favor, respeta el formato del ejemplo, ya que de lo contrario, la configuración fallará.
    - **PLUGIN_AUTHOR:** Un poco de publicidad no viene mal, así que ya que has tenido el detalle de desarrollar el plugin, pon tu nombre o el de tu empresa para que todo el mundo te conozca.
    - **PLUGIN_AUTHOR_URI:** Indica también la URL de tu web o la de tu empresa, para que la gente sepa donde encontrarte.
    - **COMPOSER_VENDOR_NAME:** Será el nombre del proveedor para el archivo "composer.json" y deberá ir en minúscula y separado por guiones.
    - **PLUGIN_CONFIG_NAMESPACE:** Escribe el nombre de espacio para las clases que haya en la carpeta "config" del plugin.
    - **PLUGIN_SOURCE_NAMESPACE:** Igual que el punto anterior, pero para las clases de la carpeta "src".
    - **PLUGIN_COMMAND_NAMESPACE:** Igual que el punto anterior, pero para las clases de la carpeta "cmd".
    - **PLUGIN_VARS_PREFIX:** Con el uso de clases y de nombres de espacio, no es necesario el uso de prefijos en funciones y variables. Pero, sí hay un par de ellas que lo necesitan.
    - **PLUGIN_CONSTANTS_PREFIX:** Se trata del prefijo para las constantes globales del plugin.
6. Abre la consola de comandos y ejecuta el script "composer create-plugin".
7. Revisa los archivos del plugin para verificar que no queda rastro de las cadenas de ejemplo.
8. Elimina del archivo ".gitignore" la referencia al archivo "composer.lock".
9. Guarda todos los cambios que has hecho en todos los archivos.

Y, voilà!!! Ya está todo listo para que empieces a desarrollar tu plugin.

## Estructura de archivos

Como partidario y defensor de la programación orientada a objetos, he querido crear una estructura de archivos que permitan seguir esa práctica, ya que considero que es una forma muy limpia de desarrollar, así como de mantener y escalar cualquier proyecto, utilizando cada archivo y cada carpeta únicamente para las funcionalidades concretas que debe tener.

Antes de ponerte a desarrollar, te recomiendo que le eches un vistazo a los archivos y las carpetas que te dejo en el plugin de ejemplo. También te recomiendo que instales este plugin e intentes localiar cada una de las funcionalidades que trae, para que así comprendas cuál es el objetivo de cada una de las clases.

De todas formas, para ayudarte, te hago un resumen de los archivos y carpetas que vas a encontrar en el plugin de ejemplo:

- **plugin-sample.php:** Este es el archivo principal del plugin. En él, se entablecen las cabeceras con la información de dicho plugin, constantes que necesita el plugin para ciertas funcionalidades y funciones que se ejecutan al activar, desactivar e instalar el plugin. Las constantes definidas en este archivo son:
    - **LANG_DIR:** Te permite indicar la ruta de la carpeta en la que almacenarás los ficheros .po y .mo con las traducciones del plugin.
    - **PLUGIN_FILE:** Te permite indicar ruta absoluta al archivo principal del plugin.
    - **PLUGIN_DIR:** Te permite indicar ruta absoluta a la carpeta del plugin. Esta constante te puede ayudar a la hora de hacer includes de otros archivos.
    - **PLUGIN_URL:** Te permite indicar la URL absoluta de la carpeta del plugin.
    - **PLUGIN_ASSETS:** Te permite indicar la URL absoluta de la carpeta de los assets del plugin. Esta constante te puede ayudar a la hora de enconlar tus archivos CSS y JS, para el frontend.
    - **PLUGIN_ADMIN_ASSETS:** Te permite indicar la URL absoluta de los assets del panel de administración del plugin. Esta constante te puede ayudar a la hora de enconlar tus archivos CSS y JS, para el panel de administración.
    - **PLUGIN_ENDPOINTS_NAMESPACE:** Te permite indicar el endpoint base de tus endpoints personalizados.
- **admin:** Contiene todos los recursos que necesita tu plugin en el panel de administración.
    - **css:** Aquí podrás incluir los archivos CSS que tu plugin necesita para visualizarse correctamente.
    - **images:** Aquí podrás incluir aquellas imágenes que tu plugin necesita, tales como iconos, logos, etc.
    - **js:** Aquí podrás incluir los archivos Javascript de las funcionalidades que tu plugin requiera en el panel de administración.
- **assets:** Contiene todos los recursos que necesita tu plugin en el front.
    - **css:** Aquí podrás incluir los archivos CSS que tu plugin necesita para visualizarse correctamente.
    - **fonts:** Aquí podrás incluir las tipografías requeridas por tu plugin.
    - **images:** Aquí podrás incluir aquellas imágenes que tu plugin necesita, tales como iconos, logos, etc.
    - **js:** Aquí podrás incluir los archivos Javascript de las funcionalidades que tu plugin requiera en el front.
- **config:** Contiene la clase en la que se establece la configuración del plugin.
    - **PluginConfig.php:** En este archivo se establece una clase con la configuración del plugin. En ella, se instancian todas las clases de la carpeta "src" con las funcionalidades del plugin, se indica a la instalación de WordPress el "textdomain" que debe buscar para traducir el plugin, se encolan los ficheros CSS y Javascript globales que el plugin necesita, y se declaran las funciones que se llaman desde el archivo principal del plugin al activar, desactivar y borrar el plugin.
    - **PluginDependencies.php:** En este archivo se establece una clase con las dependencias que necesita el plugin para funcionar, como pueden ser la versión mínima de PHP, la versión mínima de WordPress o si están activos algunos plugins de terceros.
- **src (Source)::** Contiene las clases de PHP que desarrollarás para añadir las funcionalidades de tu plugin a la web en la que se instale el mismo.
    - **Blocks:** Desde la versión 5.0 de WordPress, el editor clásico fue sustituido por un editor de bloques (Gutenberg), que te permite contribuir tus sitios web de una forma más dinámica y visual. En esta carpeta, podrás crear clases con bloques personalizados que necesites para tus desarrollos.
    - **BlocksCategories:** Al igual que los tipos de contenido, los bloques pueden organizarse en categorías. En esta carpeta, podrás tener las clases de tus propias categorías para los bloques que desarrolles.
    - **Customizer:** WordPress, en la opción "Apariencia" de su menú, contiene una opción desde la que permite personalizar el aspecto o funcionalidades de la web, como puede ser añadir un favicon identificativo a las pestañas del navegador. En esta carpeta, puedes añadir secciones personalizadas para poder realizar configuraciones, como por ejemplo, un campo para introducir el código de GTM de tu web y, en esta carpeta, podrás tener las secciones que desarrolles.
    - **Endpoints:** Con la llegada de la API Rest de WordPress, es posible interactuar con nuestra web desde un servicio externo, como puede ser una App o un front hecho con un framework de Javascript. En esta carpeta, podrás crear tus propios endpoints para que devuelvan los datos que necesite tu aplicación externa... o interna.
    - **Metaboxes:** Aunque pienses que los campos personalizados a WordPress llegaron gracias a plugins como ACF, he de decirte que no es así. En esta carpeta podrás tener los distintos campos personalizados que necesites tanto para tus contenidos, como para tus usuarios o para la página de opciones del plugin.
    - **PostsTypes:** WordPress trae incluidos en su núcleo una serie de tipos de contenido. Los más conocidos son las páginas y las entradas, pero también lo son los archivos de la biblioteca, los menús, etc. Además, te ofrece la posibilidad de que puedas tener los tuyos propios, como pueden ser para crear fichas de producto (como hace WooCommerce), cursos (como es el caso de Sensei) y todo lo que se te pase por la cabeza. Guarda en esta carpeta todos los tipos de contenido personalizados que desarrolles.
    - **RestApi:** Pese a que los endpoints que trae por defecto la API Rest de WordPress te pueden proporcionar mucha información sobre tu sitio web, hay veces que esta información no es suficiente. Como alternativa a crear tu propio endpoint, WordPress te ofrece la posibilidad de añadir un nuevo campo a los endpoints que ya tiene integrados. En esta carpeta, podrás crear tus campos personalizados e incluirlos en el endpoint que desees.
    - **Roles:** WordPress, por defecto, incorpora cinco tipos de roles, con sus respectivas restricciones, pero, ¿qué ocurre si necesitas un sexto tipo de rol con unas restricciones específicas? En esta carpeta, podrás crear tus roles personalizados para asignárselos a los usuarios que desees.
    - **Settings:** La mayoría de plugins o temas incorporan una página de ajustes en la que poder configurar parámetros, incluir claves,... En esta carpeta, podrás crear tu propia página de ajustes y asignarle los campos y opciones que creas necesarios para tu plugin.
    - **Shortcodes:** Antes de la llegada de la era de los bloques a WordPress, si querías incluir un contenido específico en varias páginas, sin tener que duplicar su código, tenías que hacerlo con este tipo de componentes. A día de hoy, la gran mayoría de shortcodes están siendo migrados a bloques, pero aún hay proyectos en los que son necesarios. En esta carpeta, podrás crear tus shortcodes personalizados e insertarlos en las páginas o entradas en las que quieras renderizar su contenido.
    - **Taxonomies:** WordPress también trae incluidas en su núcleo taxonomías, que te permiten clasificar los contenidos de un tipo concreto o de varios tipos. Algunas de estas taxonomías permiten una jerarquía, como es el caso de las categorías de una entrada, que dan la posibilidad de crear sub-categorías. Otras, por el contrario, no permiten dicha jerarquía, como es el caso de las etiquetas de una entrada. En esta carpeta podrás tener todas las taxonomías personalizadas que necesites.
- **vendor:** En esta carpeta, se almacenarán todas las dependencias que se instalen en el plugin al ejecutar el comando "composer install".
- **composer.json:** Este es el archivo de configuración de Composer. En él, encontrarás las librerías y dependencias que el plugin necesita para funcionar. Quizá necesites añadir las tuyas propias en función del plugin que vayas a desarrollar.
- **composer.lock:** Este archivo contiene las dependencias que se han instalado actualmente en tu plugin a través de composer, así como las versiones de cada una de ellas. Puedes modificar su contenido ejecutando el comando "composer update" en una consola desde la raíz del plugin.

## Comandos para crear nuevas funcionalidades en el plugin

- [Block](cmd/Make/Block/readme.md)
- [Blocks Category](cmd/Make/BlocksCategory/readme.md)
- [Custom Post Type](cmd/Make/CustomPostType/readme.md)
- [Customizer](cmd/Make/Customizer/readme.md)
- [Endpoint](cmd/Make/Endpoint/readme.md)
- [Metaboxes Group](cmd/Make/MetaboxesGroup/readme.md)
- [Rest API Field](cmd/Make/RestApi/readme.md)
- [Role](cmd/Make/Role/readme.md)
- [Settings](cmd/Make/Settings/readme.md)
- [Shortcode](cmd/Make/Shortcode/readme.md)
- [Taxonomies](cmd/Make/Taxonomies/readme.md)

## Fin del desarrollo de tu plugin

Una vez que hayas desarrollado tu plugin para WordPress, elimina todas aquellas clases, métodos y propiedades que no hayas utilizado, así como los ejemplos que te proporciono, para dejar tu código lo más limpio posible.

## Nota informativa

Este es un proyecto Open Source, así que siéntete libre de descargarlo, utilizarlo y proponer nuevas características y funcionalidades.

Si te animas, estaré encantado de aceptarte una Pull Request, pero ten en cuenta, que no aceptaré PR's que no tengan un comentario o que traigan algún tipo de código malicioso.
