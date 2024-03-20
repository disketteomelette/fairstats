# fairstats
Herramienta PHP de analítica web que no utiliza base de datos, cookies ni datos personales de los usuarios.

# Adiós a las cookies ¡Bienvenido a las estadísticas justas!

Fairstats es una herramienta de analítica web diseñada para proporcionar información detallada sobre las visitas a un sitio web sin comprometer la privacidad de los usuarios. Permite recoger los datos básicos de visitas sin necesidad de utilizar cookies ni almacenar direcciones IP, pero permitiendo funciones de seguimiento mediante un hash con cifrado no reversible (mediante iteraciones sobre sha256) en las condiciones técnicas actuales.

# Licencia

Este software ha sido desarrollado por JCRueda.com. El proyecto se regula de acuerdo con los términos de la licencia Creative Commons Atribución Sin Derivadas (CC BY-ND). Esta licencia permite a los usuarios utilizar el software libremente, siempre que se reconozca la autoría del trabajo original y no se realicen modificaciones en el mismo. Debe citarse el repositorio original del archivo: https://github.com/disketteomelette/fairstats

# Configurando fairstats

Fairstats es muy sencillo de configurar si tu aplicación funciona en PHP (Wordpress, Joomla, etc.). Basta con colocar el agente y el dashboard en tu carpeta principal, e inyectar este código en un header o footer:
  <?php include "visita.php";?>

En caso de páginas HTML u otras tecnologías, si tu servidor es Apache puedes añadir la siguiente regla a tu archivo .htaccess para permitir ejecutar scripts PHP en archivos distintos a .php :
  AddType application/x-httpd-php .html
