# Plugin sample

Este repositorio contiene un plugin de muestra para desarrollar otros plugins para WordPress a partir del mismo. El plugin alojado en este repositorio solamente tiene funcionalidades de prueba, las cuales puedes tomar como ejemplo para desarrollar las tuyas propias.

## Requisitos mínimos

Para poder desarrollar tu propio plugin a partir de este ejemplo, vas a necesitar, como mínimo:

- [WordPress 5.4](https://es.wordpress.org/download/)
- PHP 7.2
- [Composer 1.10.7](https://getcomposer.org/download/)
- Ganas de desarrollar un plugin para WordPress

## Primeros pasos para crear tu plugin

1. Entra en la [URL del repositorio](https://github.com/juanmacivico87/plugin-sample). Seguramente, si estás leyendo esto, ya estarás en ella.
2. Ve a la carpeta plugins de tu instalación de WordPress (preferiblemente, en un entorno de desarrollo).
3. Abre una consola de comandos en esta ruta y ejecuta el comando "git clone https://github.com/juanmacivico87/plugin-sample.git". Esto creará un clon del plugin de ejemplo en tu carpeta de plugins.
4. Renombra la carpeta del plugin descargado con el nombre que tú le quieras dar, en minúscula y separado por guiones (por ejemplo: "mi-plugin-de-wp").
5. Entra dentro de la carpeta del plugin y borra el fichero ".git". Normalmente está oculto, así que si no puedes verlo, es porque en tu sistema operativo tienes activada la configuración que oculta los ficheros ocultos.
6. Renombra el archivo principal del plugin (plugin-sample.php) con el mismo nombre que le has dado a la carpeta del plugin.
7. Abre el archivo principal del plugin y completa sustituye la información que vienen de ejemplo en la cabecera por los de tu plugin. Dicha información es:
    - **Nombre del plugin:** Será el nombre público que quieras darle a tu plugin.
    - **URI del plugin:** Aquí puedes indicar una URL a una página en la que pueda verse una muestra de tu plugin (yo suelo poner el URL del repositorio de GitHub donde lo alojo).
    - **Descripción:** Para que todo el mundo se entere para qué sirve tu plugin.
    - **Versión:** Ahora posiblemente será la 1.0, pero conforme vayas añadiendo nuevas funcionalidades, arreglando fallos, etc, este número irá incrementándose.
    - **Autor:** Aquí pon tu nombre o el de tu empresa. Que todo el mundo sepa quién ha desarrollado el plugin.
    - **URI del autor:** Y como un poco de publicidad nunca viene mal, pon también una URL en la que puedan encontrarte y felicitarte por el trabajo realizado.
    - **License y License URI:** Como todo lo que se desarrolla para WordPress tiene que estar bajo la licencia GPL, deja esos valores por defecto.
    - **Textdomain:** Esta cadena de texto será utilizada para definir los literales que quieras que sean traducibles en tu plugin, como nombres de campos, Custom Post Types,... en el caso de que quieras que tu plugin se pueda internacionalibilizar. Dicha cadena de texto será la misma que el nombre del archivo principal y de la carpeta de tu plugin.
    - **Domain path:** Será la carpeta de tu plugin donde guardarás los ficheros .po y .mo con las traducciones de tu plugin. Como el plugin de ejemplo es eso, un plugin de ejemplo, no la tiene. así que tendrás que crearla tú.
8. Sustituye también el texto "[Plugin Name]" por el nombre de tu plugin (igual que has hecho unas líneas más arriba).
9. Abre el archivo "composer.json" y...
    - En el valor "name", escribe "plugin/nombre-de-tu-plugin".
    - En el valor "description", escribe la misma descripción que en la cabecera del archivo principal.
10. Piensa en un prefijo único para tu plugin. Dicho prefijo no debe coincidir con ningún otro prefijo de la instalación de WordPress y se utilizará para definir algunos elementos de tu código. Yo, por ejemplo, utilizo siempre un prefijo formado por mis iniciales y el nombre del plugin. Así, si el plugin se llama "Meta SEO Generator", en mi caso el prefijo sería "jmc87_meta_seo_generator_" o "jmc87_meta_seo_gen_". Puede resultar muy largo, pero así me aseguro de que no va a haber otro igual.
11. Desde el editor de código, haz un "buscar y reemplazar" de todas las cadenas "prefix" de todos los archivos del plugin y sustitúyelas con el prefijo que has elegido. Asegúrate de que en los casos que tengan que estar en mayúsculas, estén en mayúsculas (por ejemplo, nombre de las constantes) y en los casos en los que tengan que estar en minúsculas, estén en minúsculas (por ejemplo, opciones y metas de la base de datos).
12. Haz otro "buscar y reemplazar" de todos los textdomains de ejemplo (plugin-sample), por el que tú hayas elegido para tu plugin (recuerda que tiene que ser el mismo valor que el nombre de la carpeta y del archivo principal).
13. Elimina, del archivo ".gitignore" la referencia al archivo "composer.lock".
14. Guarda todos los cambios que has hecho en todos los archivos.
15. Ejecuta en la consola, desde la raiz del plugin, el comando "composer install".

Y, voilà!!! Ya está todo listo para que empieces a desarrollar tu plugin.

## Estructura de archivos

Como partidario y defensor de la programación orientada a objetos, he querido crear una estructura de archivos que permitan seguir esa práctica, ya que considero que es una forma muy limpia de desarrollar, así como de mantener y escalar cualquier proyecto, utilizando cada archivo y cada carpeta únicamente para las funcionalidades concretas que debe tener.

Antes de ponerte a desarrollar, te recomiendo que le eches un vistazo a los archivos y las carpetas que te dejo en el plugin de ejemplo. También te recomiendo que instales este plugin e intentes localiar cada una de las funcionalidades que trae, para que así comprendas cuál es el objetivo de cada una de las clases.

De todas formas, para ayudarte, te hago un resumen de los archivos y carpetas que vas a encontrar en el plugin de ejemplo:

- **plugin-sample.php:** Este es el archivo principal del plugin. En él, se entablecen las cabeceras con la información de dicho plugin, constantes que necesita el plugin para ciertas funcionalidades y funciones que se ejecutan al activar, desactivar e instalar el plugin. Las constantes definidas en este archivo son:
    - **PLUGIN_VERSION:** Te permite definir la versión del plugin, para que así no tengas que ir modificándola en todas las partes de tu código donde sea necesario que la indiques, cada vez que hagas una actualización.
    - **LANG_DIR:** Te permite indicar la ruta de la carpeta en la que almacenarás los ficheros .po y .mo con las traducciones del plugin.
    - **PLUGIN_DIR:** Te permite indicar ruta absoluta a la carpeta del plugin. Esta constante te puede ayudar a la hora de hacer includes de otros archivos.
    - **PLUGIN_URL:** Te permite indicar la URL absoluta de la carpeta del plugin. Esta constante te puede ayudar a la hora de enconlar tus archivos CSS y JS.
- **config:** Contiene la clase en la que se establece la configuración del plugin.
    - **PluginConfig.php:** En este archivo se establece una clase con la configuración del plugin. En ella, se instancian todas las clases de la carpeta "src" con las funcionalidades del plugin, se indica a la instalación de WordPress el "textdomain" que debe buscar para traducir el plugin, se encolan los ficheros CSS y Javascript globales que el plugin necesita, y se declaran las funciones que se llaman desde el archivo principal del plugin al activar, desactivar y borrar el plugin.
- **inc:** Contiene todos los recursos que necesita tu plugin en el front.
    - **css:** Aquí podrás incluir los archivos CSS que tu plugin necesita para visualizarse correctamente.
    - **fonts:** Aquí podrás incluir las tipografías requeridas por tu plugin.
    - **images:** Aquí podrás incluir aquellas imágenes que tu plugin necesita, tales como iconos, logos, etc.
    - **js:** Aquí podrás incluir los archivos Javascript de las funcionalidades que tu plugin requiera en el front.
- **src (Source)::** Contiene las clases de PHP que desarrollarás para añadir las funcionalidades de tu plugin a la web en la que se instale el mismo.
    - **Blocks:** Desde la versión 5.0 de WordPress, el editor clásico fue sustituido por un editor de bloques (Gutenberg), que te permite contribuir tus sitios web de una forma más dinámica y visual. En esta carpeta, podrás crear clases con bloques personalizados que necesites para tus desarrollos.
        - **CustomACFBlock:** Contiene un bloque personalizado desarrollado gracias a la función "acf_register_block_type()" de ACF (muy útil para aquellos que no sabemos desarrollar bloques con React). Necesitarás disponer de una licencia PRO de ACF para poder desarrollar bloques de esta manera. Para crear tu propio bloque personalizado, duplica o edita esta clase y añade los métodos y las propiedades que necesites.
            - **CustomACFBlock.php:** Este es el archivo que contiene los métodos y las propiedades necesarias para desarrollar la funcionalidad del bloque.
            - **css:** En este archivo, podrás definir propiedades de CSS propias de este bloque, las cuales solamente se cargarán en el sistema cuando el bloque se haya contribuido.
            - **js:** En este archivo, podrás definir funciones de Javascript propias de este bloque, las cuales solamente se cargarán en el sistema cuando el bloque se haya contribuido.
            - **json:** Los bloques pueden tener campos de ACF para contribuir la información que en ellos se renderizará. En esta carpeta puedes guardar un JSON con los campos para poder editarlos cada vez que lo necesites, sin necesidad de tenerlos almacenados en la base de datos.
            - **views:** En esta carpeta podrás crear un template con el HTML que quieras que se renderice desde el front, o desde el editor de tu web, así como las funciones de WordPress que creas necesarias, como si se tratase de un template-part de un tema.
                - **template-acf-block.php:** Este archivo contiene el template del bloque.
    - **BlocksCategories:** Al igual que los tipos de contenido, los bloques pueden organizarse en categorías. En esta carpeta, podrás tener las clases de tus propias categorías para los bloques que desarrolles.
        - **CustomBlocksCategory:** Contiene una categoría de bloques personalizada. Para crear tu propia categoría de bloques, duplica o edita esta clase y añade los métodos y las propiedades que necesites.
            - **CustomBlocksCategory.php:** Este es el archivo que contiene los métodos y las propiedades necesarias para desarrollar la categoría de bloques personalizada.
    - **Customizer:** WordPress, en la opción "Apariencia" de su menú, contiene una opción desde la que permite personalizar el aspecto o funcionalidades de la web, como puede ser añadir un favicon identificativo a las pestañas del navegador. En esta opción, puedes añadir secciones personalizadas para poder realizar configuraciones, como por ejemplo, un campo para introducir el código de GTM de tu web y, en esta carpeta, podrás tener las secciones que desarrolles.
        - **CustomizerSection:** Contiene una sección del personalizador de WordPress, desarrollada a medida. Para crear tu propia sección para el personalizador, duplica o edita esta clase y añade los métodos y las propiedades que necesites.
            - **CustomizerSection.php:** Este es el archivo que contiene los métodos y las propiedades necesarias para desarrollar la sección del personalizador.
    - **Metaboxes:** Aunque pienses que los campos personalizados a WordPress llegaron gracias a plugins como ACF, he de decirte que no es así. En esta carpeta podrás tener los distintos campos personalizados que necesites tanto para tus contenidos, como para tus usuarios o para la página de opciones del plugin.
        - **SampleMetabox:** Contiene un campo personalizado desarrollado a medida. Para crear tu propio campo personalizado, duplica o edita esta clase y añade los métodos y las propiedades que necesites.
            - **SampleMetabox.php:** Este es el archivo que contiene los métodos y las propiedades necesarias para desarrollar el campo personalizado.
    - **PostsTypes:** WordPress trae incluidos en su núcleo una serie de tipos de contenido. Los más conocidos son las páginas y las entradas, pero también lo son los archivos de la biblioteca, los menús, etc. Pero también puedes tener los tuyos propios, como pueden ser para crear fichas de producto (como hace WooCommerce), cursos (como es el caso de Sensei) y todo lo que se te pase por la cabeza. En esta carpeta, podrás tener los tipos de contenido personalizados que desarrolles.
        - **SamplePostType:** Contiene un tipo de contenido personalizado. Para crear tu propio tipo de contenido personalizado, duplica o edita esta clase y añade los métodos y las propiedades que necesites.
            - **SamplePostType.php:** Este es el archivo que contiene los métodos y las propiedades necesarias para desarrollar el tipo de contenido personalizado.
            - **views:** En esta carpeta podrás crear templates para que se rendericen, tanto el listado de entradas de tu tipo de contenido personalizado, como la propia entrada de dicho tipo de contenido.
                - **archive-sample.php:** Este archivo contiene el template del listado.
                - **single-sample.php:** Este archivo contiene el template de la entrada.
    - **Taxonomies:** WordPress también trae incluidas en su núcleo taxonomías, que te permiten clasificar los contenidos de un tipo concreto o de varios tipos. Algunas de estas taxonomías permiten una jerarquía, como es el caso de las categorías de una entrada, que dan la posibilidad de crear sub-categorías. Otras, por el contrario, no permiten dicha jerarquía, como es el caso de las etiquetas de una entrada. En esta carpeta podrás tener todas las taxonomías personalizadas que necesites.
        - **CustomCategory:** Contiene una taxonomía personalizada, con jerarquía. Para crear tu propia taxonomía con jerarquía, duplica o edita esta clase y añade los métodos y las propiedades que necesites.
            - **CustomCategory.php:** Este es el archivo que contiene los métodos y las propiedades necesarias para desarrollar la taxonomía con jerarquía.
            - **views:** En esta carpeta podrás crear un template para que renderice el listado de entradas de tu taxonomía con jerarquía.
                - **taxonomy-category.php:** Este archivo contiene el template del listado de entradas de tu taxonomía con jerarquía.
        - **CustomTag:** Contiene una taxonomía personalizada, sin jerarquía. Para crear tu propia taxonomía con jerarquía, duplica o edita esta clase y añade los métodos y las propiedades que necesites.
            - **CustomTag.php:** Este es el archivo que contiene los métodos y las propiedades necesarias para desarrollar la taxonomía sin jerarquía.
            - **views:** En esta carpeta podrás crear un template para que renderice el listado de entradas de tu taxonomía sin jerarquía.
                - **taxonomy-tag.php:** Este archivo contiene el template del listado de entradas de tu taxonomía sin jerarquía.
- **vendor:** En esta carpeta, se almacenarán todas las dependencias que se instalen en el plugin al ejecutar el comando "composer install".
- **composer.json:** Este es el archivo de configuración de Composer. En él, encontrarás las librerías y dependencias que el plugin necesita para funcionar. Quizá necesites añadir las tuyas propias en función del plugin que vayas a desarrollar.
- **composer.lock:** Este archivo contiene las dependencias que se han instalado actualmente en tu plugin a través de composer, así como las versiones de cada una de ellas. Puedes modificar su contenido ejecutando el comando "composer update" en una consola desde la raíz del plugin.

## Fin del desarrollo de tu plugin

Una vez que hayas desarrollado tu plugin para WordPress, elimina todas aquellas clases, métodos y propiedades que no hayas utilizado, así como los ejemplos que te proporciono, para dejar tu código lo más limpio posible.

## Nota informativa

Este es un proyecto Open Source, así que siéntete libre de descargarlo, utilizarlo y proponer nuevas características y funcionalidades.

Si te animas, estaré encantado de aceptarte una Pull Request, pero ten en cuenta, que no aceptaré PR's que no tengan un comentario o que traigan algún tipo de código malicioso.
