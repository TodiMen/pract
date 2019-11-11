<?php
/**
 * Основные параметры WordPress.
 *
 * Скрипт для создания wp-config.php использует этот файл в процессе
 * установки. Необязательно использовать веб-интерфейс, можно
 * скопировать файл в "wp-config.php" и заполнить значения вручную.
 *
 * Этот файл содержит следующие параметры:
 *
 * * Настройки MySQL
 * * Секретные ключи
 * * Префикс таблиц базы данных
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** Параметры MySQL: Эту информацию можно получить у вашего хостинг-провайдера ** //
/** Имя базы данных для WordPress */
define( 'DB_NAME', 'wordpress' );

/** Имя пользователя MySQL */
define( 'DB_USER', 'root' );

/** Пароль к базе данных MySQL */
define( 'DB_PASSWORD', '' );

/** Имя сервера MySQL */
define( 'DB_HOST', 'localhost' );

/** Кодировка базы данных для создания таблиц. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Схема сопоставления. Не меняйте, если не уверены. */
define( 'DB_COLLATE', '' );

/**#@+
 * Уникальные ключи и соли для аутентификации.
 *
 * Смените значение каждой константы на уникальную фразу.
 * Можно сгенерировать их с помощью {@link https://api.wordpress.org/secret-key/1.1/salt/ сервиса ключей на WordPress.org}
 * Можно изменить их, чтобы сделать существующие файлы cookies недействительными. Пользователям потребуется авторизоваться снова.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         ']Uld*=[5k}5Fzx|^ZE$|6Q!d22i|H{z{XP3YN:&ZsFs% FvwMqJz%j.;^:^mAisc' );
define( 'SECURE_AUTH_KEY',  '65_JFq0` UNJBF9$q$Vs0L7?Vzpe$-x}ZC.WzeoS,Qwb}]ow.t~K/10$!.O5a1]4' );
define( 'LOGGED_IN_KEY',    'Ou~E%+;` NBR<XF}>x.j.aTd_g2( |SWjysm,cbKo2BSGinA3*,!i([u[oHM9_2y' );
define( 'NONCE_KEY',        '!h5`MKk%xO.JzC1^SE6Z4dz;slHWas]ACxky6 (/W`w*:/Qm>zj$wUE|LiG_o+@I' );
define( 'AUTH_SALT',        'H^X3,7cT6pNR+VEq>kV^2q5_ Qh>fi@i!4_#t[I,*,y;kH{|=Iy(Rl5X,25PDyji' );
define( 'SECURE_AUTH_SALT', '=ARAGQh4F^lhv;cGkMA6 }VKmWbys8uxIG t.9K^k4F)t{Nl:{3[~/c%=f~q2i<X' );
define( 'LOGGED_IN_SALT',   'jDGR?)Zt*VsDFwkL=BA6+4,yl83eZ1E-KO-0G+lS9Cv^|qq${2|Fj&%&LE[gQHxw' );
define( 'NONCE_SALT',       'l;>DzCoDt1{phSr{S4%V.>?Y-[FDdY7<n2UE7(D_ksVXoQnvsf1<]B(Nb_@VXbNu' );

/**#@-*/

/**
 * Префикс таблиц в базе данных WordPress.
 *
 * Можно установить несколько сайтов в одну базу данных, если использовать
 * разные префиксы. Пожалуйста, указывайте только цифры, буквы и знак подчеркивания.
 */
$table_prefix = 'wp_';

/**
 * Для разработчиков: Режим отладки WordPress.
 *
 * Измените это значение на true, чтобы включить отображение уведомлений при разработке.
 * Разработчикам плагинов и тем настоятельно рекомендуется использовать WP_DEBUG
 * в своём рабочем окружении.
 *
 * Информацию о других отладочных константах можно найти в Кодексе.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* Это всё, дальше не редактируем. Успехов! */

/** Абсолютный путь к директории WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Инициализирует переменные WordPress и подключает файлы. */
require_once( ABSPATH . 'wp-settings.php' );
