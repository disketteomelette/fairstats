# fairstats
Herramienta PHP de analítica web que no utiliza base de datos, cookies ni datos personales de los usuarios. Se trata de una versión alfa muy básica, por lo que espero poder seguir mejorándolo en el futuro. 

![Captura](scr2.jpg) 

# Funciones de análisis de visitantes

- Número de visitas diarias
- Visualización de visitas por hora
- Usuarios únicos
- Usuarios recurrentes ese día
- Visitas por página (páginas visitadas y número de visitas)
- Tipo de dispositivo
- Compatibilidad del navegador
- Sistema operativo
- Listado completo de visitas

# Enfocado en la privacidad del usuario

Fairstats se basa en la pseudoanonimización de las direcciones IP. El proceso de pseudoanonimización implica transformar la dirección IP del usuario en una representación hash. Esta representación hash conserva la información esencial para fines de análisis mientras hace prácticamente imposible revertir la dirección IP original. 

Para ello, la IP se somete a un primer proceso de hashing usando el algoritmo SHA-256. Se utiliza el tamaño del archivo agente "visita.php" para generar, a su vez, dos hashes: uno MD5 y otro SHA-256. Estos últimos dos hashes son agregados al primer hash que contiene la IP encriptada, y con su resultado se realiza un hashing iterativo en SHA-256. Esto mantiene la privacidad del usuario mientras preserva la usabilidad de los datos objeto de análisis. Este proceso de pseudoanonimización combina técnicas criptográficas robustas con medidas de seguridad adicionales para proteger efectivamente los datos del usuario. Los usuarios pueden confiar en que su privacidad es respetada sin comprometer la utilidad de nuestra herramienta de análisis.

# Adiós a las cookies ¡Bienvenido a las estadísticas justas!

Fairstats es una herramienta de analítica web diseñada para proporcionar información detallada sobre las visitas a un sitio web sin comprometer la privacidad de los usuarios. Permite recoger los datos básicos de visitas sin necesidad de utilizar cookies ni almacenar direcciones IP, pero permitiendo funciones de seguimiento mediante un hash con cifrado no reversible (mediante iteraciones sobre sha256) en las condiciones técnicas actuales.

# Licencia

Este software ha sido desarrollado por JCRueda.com. El proyecto se regula de acuerdo con los términos de la licencia Creative Commons Atribución Sin Derivadas (CC BY-ND). Esta licencia permite a los usuarios utilizar el software libremente, siempre que se reconozca la autoría del trabajo original y no se realicen modificaciones en el mismo. Debe citarse el repositorio original del archivo: https://github.com/disketteomelette/fairstats

# Configurando fairstats

Fairstats es muy sencillo de configurar si tu aplicación funciona en PHP (Wordpress, Joomla, etc.). Basta con colocar el agente y el dashboard en tu carpeta principal, e inyectar este código en un header o footer:
  <?php include "visita.php";?>

En caso de páginas HTML u otras tecnologías, si tu servidor es Apache puedes añadir la siguiente regla a tu archivo .htaccess para permitir ejecutar scripts PHP en archivos distintos a .php :
  AddType application/x-httpd-php .html
