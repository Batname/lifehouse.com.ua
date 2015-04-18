<?php
define('WP_HOME', 'http://lifehouse.com.ua/');
define('WP_SITEURL', 'http://lifehouse.com.ua/');
/**
 * Основные параметры WordPress.
 *
 * Этот файл содержит следующие параметры: настройки MySQL, префикс таблиц,
 * секретные ключи, язык WordPress и ABSPATH. Дополнительную информацию можно найти
 * на странице {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Кодекса. Настройки MySQL можно узнать у хостинг-провайдера.
 *
 * Этот файл используется сценарием создания wp-config.php в процессе установки.
 * Необязательно использовать веб-интерфейс, можно скопировать этот файл
 * с именем "wp-config.php" и заполнить значения.
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** �&#65533;мя базы данных для WordPress */
define('DB_NAME', 'lifehous');

/** �&#65533;мя пользователя MySQL */
define('DB_USER', 'u_lifehous');

/** Пароль к базе данных MySQL */
define('DB_PASSWORD', 'BdquYFdL');

/** �&#65533;мя сервера MySQL */
define('DB_HOST', 'localhost');

/** Кодировка базы данных для создания таблиц. */
define('DB_CHARSET', 'utf8');

/** Схема сопоставления. Не меняйте, если не уверены. */
define('DB_COLLATE', '');

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется снова авторизоваться.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'Sod(e;q+sUlR(,8|~+,N1wZd>4!n8jY71RihBvc;|nvlRB$|QSfr;~bp+MtRc]62');
define('SECURE_AUTH_KEY',  '#)=z,uQKI_6dYNCdk6tw+ +b]NbZLmZ;cBeRoXb+f8Lu+Koz/s66GPH#@CQ3-*d/');
define('LOGGED_IN_KEY',    '@3NVH[]ecMG!=TY7<I2jd1>,i1CvVhNmz9o&|f+TleZ4mD{3y(gh~bw0smSTBGTy');
define('NONCE_KEY',        'C.(w#~78CP+sUh%ed)GKK+*yOw&F~ *=j%&Jc}EH%OmOX[=VEOQq>8-g+-};/UwH');
define('AUTH_SALT',        '4GStfb2IK^bpCJ!:k*g-|{|H:Bs,k|gd-_yWF{13nap+O^L=d1ny0dkhYF/3*)z,');
define('SECURE_AUTH_SALT', 'v;(,lXi}lc{Z4LI6DcUY*F(NT##yX?7&^TN@_HX5dRh+aY#|^yCL$c,{,QQiX.F$');
define('LOGGED_IN_SALT',   'r;]aI[a]P1_&yxtAQ+!eJ8M_f}x_T(UAQd/B[){IBC|E?|?PXkBS||o5pYw):/Fp');
define('NONCE_SALT',       'x&bM,gfT|^+^6@N[%Y9 |b0Lw.$^+Qe{-o$[_[0(/HF{x*#Vfn<sZ)Aukfr-o3=}');

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько блогов в одну базу данных, если вы будете использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix  = 'wp_hotap';

/**
 * Язык локализации WordPress, по умолчанию английский.
 *
 * �&#65533;змените этот параметр, чтобы настроить локализацию. Соответствующий MO-файл
 * для выбранного языка должен быть установлен в wp-content/languages. Например,
 * чтобы включить поддержку русского языка, скопируйте ru_RU.mo в wp-content/languages
 * и присвойте WPLANG значение 'ru_RU'.
 */
define('WPLANG', 'ru_RU');

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * �&#65533;змените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Настоятельно рекомендуется, чтобы разработчики плагинов и тем использовали WP_DEBUG
 * в своём рабочем окружении.
 */
define('WP_DEBUG', false);

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** �&#65533;нициализирует переменные WordPress и подключает файлы. */
require_once(ABSPATH . 'wp-settings.php');