<?php return array (
  'app' => 
  array (
    'name' => 'Bebran',
    'env' => 'local',
    'debug' => true,
    'url' => 'https://bebran.com/',
    'asset_url' => 'https://bebran.com/public',
    'timezone' => 'UTC',
    'locale' => 'en',
    'fallback_locale' => 'en',
    'faker_locale' => 'en_US',
    'key' => 'base64:KxncDJP3Nxe/XGRsnCytbKqucTW9hPIxcIgjcyxrWgI=',
    'cipher' => 'AES-256-CBC',
    'STRIPE_SECRET' => NULL,
    'STRIPE_KEY' => NULL,
    'providers' => 
    array (
      0 => 'Illuminate\\Auth\\AuthServiceProvider',
      1 => 'Illuminate\\Broadcasting\\BroadcastServiceProvider',
      2 => 'Illuminate\\Bus\\BusServiceProvider',
      3 => 'Illuminate\\Cache\\CacheServiceProvider',
      4 => 'Illuminate\\Foundation\\Providers\\ConsoleSupportServiceProvider',
      5 => 'Illuminate\\Cookie\\CookieServiceProvider',
      6 => 'Illuminate\\Database\\DatabaseServiceProvider',
      7 => 'Illuminate\\Encryption\\EncryptionServiceProvider',
      8 => 'Illuminate\\Filesystem\\FilesystemServiceProvider',
      9 => 'Illuminate\\Foundation\\Providers\\FoundationServiceProvider',
      10 => 'Illuminate\\Hashing\\HashServiceProvider',
      11 => 'Illuminate\\Mail\\MailServiceProvider',
      12 => 'Illuminate\\Notifications\\NotificationServiceProvider',
      13 => 'Illuminate\\Pagination\\PaginationServiceProvider',
      14 => 'Illuminate\\Pipeline\\PipelineServiceProvider',
      15 => 'Illuminate\\Queue\\QueueServiceProvider',
      16 => 'Illuminate\\Redis\\RedisServiceProvider',
      17 => 'Illuminate\\Auth\\Passwords\\PasswordResetServiceProvider',
      18 => 'Illuminate\\Session\\SessionServiceProvider',
      19 => 'Illuminate\\Translation\\TranslationServiceProvider',
      20 => 'Illuminate\\Validation\\ValidationServiceProvider',
      21 => 'Illuminate\\View\\ViewServiceProvider',
      22 => 'App\\Providers\\AppServiceProvider',
      23 => 'App\\Providers\\AuthServiceProvider',
      24 => 'App\\Providers\\EventServiceProvider',
      25 => 'App\\Providers\\RouteServiceProvider',
      26 => 'Cartalyst\\Stripe\\Laravel\\StripeServiceProvider',
    ),
    'aliases' => 
    array (
      'App' => 'Illuminate\\Support\\Facades\\App',
      'Arr' => 'Illuminate\\Support\\Arr',
      'Artisan' => 'Illuminate\\Support\\Facades\\Artisan',
      'Auth' => 'Illuminate\\Support\\Facades\\Auth',
      'Blade' => 'Illuminate\\Support\\Facades\\Blade',
      'Broadcast' => 'Illuminate\\Support\\Facades\\Broadcast',
      'Bus' => 'Illuminate\\Support\\Facades\\Bus',
      'Cache' => 'Illuminate\\Support\\Facades\\Cache',
      'Config' => 'Illuminate\\Support\\Facades\\Config',
      'Cookie' => 'Illuminate\\Support\\Facades\\Cookie',
      'Crypt' => 'Illuminate\\Support\\Facades\\Crypt',
      'Date' => 'Illuminate\\Support\\Facades\\Date',
      'DB' => 'Illuminate\\Support\\Facades\\DB',
      'Eloquent' => 'Illuminate\\Database\\Eloquent\\Model',
      'Event' => 'Illuminate\\Support\\Facades\\Event',
      'File' => 'Illuminate\\Support\\Facades\\File',
      'Gate' => 'Illuminate\\Support\\Facades\\Gate',
      'Hash' => 'Illuminate\\Support\\Facades\\Hash',
      'Http' => 'Illuminate\\Support\\Facades\\Http',
      'Js' => 'Illuminate\\Support\\Js',
      'Lang' => 'Illuminate\\Support\\Facades\\Lang',
      'Log' => 'Illuminate\\Support\\Facades\\Log',
      'Mail' => 'Illuminate\\Support\\Facades\\Mail',
      'Notification' => 'Illuminate\\Support\\Facades\\Notification',
      'Password' => 'Illuminate\\Support\\Facades\\Password',
      'Queue' => 'Illuminate\\Support\\Facades\\Queue',
      'RateLimiter' => 'Illuminate\\Support\\Facades\\RateLimiter',
      'Redirect' => 'Illuminate\\Support\\Facades\\Redirect',
      'Request' => 'Illuminate\\Support\\Facades\\Request',
      'Response' => 'Illuminate\\Support\\Facades\\Response',
      'Route' => 'Illuminate\\Support\\Facades\\Route',
      'Schema' => 'Illuminate\\Support\\Facades\\Schema',
      'Session' => 'Illuminate\\Support\\Facades\\Session',
      'Storage' => 'Illuminate\\Support\\Facades\\Storage',
      'Str' => 'Illuminate\\Support\\Str',
      'URL' => 'Illuminate\\Support\\Facades\\URL',
      'Validator' => 'Illuminate\\Support\\Facades\\Validator',
      'View' => 'Illuminate\\Support\\Facades\\View',
      'Stripe' => 'Cartalyst\\Stripe\\Laravel\\Facades\\Stripe',
    ),
  ),
  'auth' => 
  array (
    'defaults' => 
    array (
      'guard' => 'web',
      'passwords' => 'users',
    ),
    'guards' => 
    array (
      'web' => 
      array (
        'driver' => 'session',
        'provider' => 'users',
      ),
      'sanctum' => 
      array (
        'driver' => 'sanctum',
        'provider' => NULL,
      ),
    ),
    'providers' => 
    array (
      'users' => 
      array (
        'driver' => 'eloquent',
        'model' => 'App\\Models\\User',
      ),
    ),
    'passwords' => 
    array (
      'users' => 
      array (
        'provider' => 'users',
        'table' => 'password_resets',
        'expire' => 60,
        'throttle' => 60,
      ),
    ),
    'password_timeout' => 10800,
  ),
  'broadcasting' => 
  array (
    'default' => 'log',
    'connections' => 
    array (
      'pusher' => 
      array (
        'driver' => 'pusher',
        'key' => '',
        'secret' => '',
        'app_id' => '',
        'options' => 
        array (
          'cluster' => 'mt1',
          'useTLS' => true,
        ),
      ),
      'ably' => 
      array (
        'driver' => 'ably',
        'key' => NULL,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
      ),
      'log' => 
      array (
        'driver' => 'log',
      ),
      'null' => 
      array (
        'driver' => 'null',
      ),
    ),
  ),
  'cache' => 
  array (
    'default' => 'file',
    'stores' => 
    array (
      'apc' => 
      array (
        'driver' => 'apc',
      ),
      'array' => 
      array (
        'driver' => 'array',
        'serialize' => false,
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'cache',
        'connection' => NULL,
        'lock_connection' => NULL,
      ),
      'file' => 
      array (
        'driver' => 'file',
        'path' => '/home/bebrmslz/public_html/storage/framework/cache/data',
      ),
      'memcached' => 
      array (
        'driver' => 'memcached',
        'persistent_id' => NULL,
        'sasl' => 
        array (
          0 => NULL,
          1 => NULL,
        ),
        'options' => 
        array (
        ),
        'servers' => 
        array (
          0 => 
          array (
            'host' => '127.0.0.1',
            'port' => 11211,
            'weight' => 100,
          ),
        ),
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'cache',
        'lock_connection' => 'default',
      ),
      'dynamodb' => 
      array (
        'driver' => 'dynamodb',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'table' => 'cache',
        'endpoint' => NULL,
      ),
      'octane' => 
      array (
        'driver' => 'octane',
      ),
    ),
    'prefix' => 'bebran_cache',
  ),
  'cors' => 
  array (
    'paths' => 
    array (
      0 => 'api/*',
      1 => 'sanctum/csrf-cookie',
    ),
    'allowed_methods' => 
    array (
      0 => '*',
    ),
    'allowed_origins' => 
    array (
      0 => '*',
    ),
    'allowed_origins_patterns' => 
    array (
    ),
    'allowed_headers' => 
    array (
      0 => '*',
    ),
    'exposed_headers' => 
    array (
    ),
    'max_age' => 0,
    'supports_credentials' => false,
  ),
  'database' => 
  array (
    'default' => 'mysql',
    'connections' => 
    array (
      'sqlite' => 
      array (
        'driver' => 'sqlite',
        'url' => NULL,
        'database' => 'bebrmslz_latest_live_v2',
        'prefix' => '',
        'foreign_key_constraints' => true,
      ),
      'mysql' => 
      array (
        'driver' => 'mysql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'bebrmslz_latest_live_v2',
        'username' => 'bebrmslz_bebrmslz',
        'password' => 'n{nySJY1M0X7',
        'unix_socket' => '',
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'prefix_indexes' => true,
        'strict' => true,
        'engine' => NULL,
        'options' => 
        array (
          1005 => 16777216,
        ),
      ),
      'pgsql' => 
      array (
        'driver' => 'pgsql',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'bebrmslz_latest_live_v2',
        'username' => 'bebrmslz_bebrmslz',
        'password' => 'n{nySJY1M0X7',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
        'schema' => 'public',
        'sslmode' => 'prefer',
      ),
      'sqlsrv' => 
      array (
        'driver' => 'sqlsrv',
        'url' => NULL,
        'host' => '127.0.0.1',
        'port' => '3306',
        'database' => 'bebrmslz_latest_live_v2',
        'username' => 'bebrmslz_bebrmslz',
        'password' => 'n{nySJY1M0X7',
        'charset' => 'utf8',
        'prefix' => '',
        'prefix_indexes' => true,
      ),
    ),
    'migrations' => 'migrations',
    'redis' => 
    array (
      'client' => 'phpredis',
      'options' => 
      array (
        'cluster' => 'redis',
        'prefix' => 'bebran_database_',
      ),
      'default' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '0',
      ),
      'cache' => 
      array (
        'url' => NULL,
        'host' => '127.0.0.1',
        'password' => NULL,
        'port' => '6379',
        'database' => '1',
      ),
    ),
  ),
  'filesystems' => 
  array (
    'default' => 'local',
    'disks' => 
    array (
      'local' => 
      array (
        'driver' => 'local',
        'root' => '/home/bebrmslz/public_html/storage/app',
      ),
      'public' => 
      array (
        'driver' => 'local',
        'root' => '/home/bebrmslz/public_html/storage/app/public',
        'url' => 'https://bebran.com//storage',
        'visibility' => 'public',
      ),
      's3' => 
      array (
        'driver' => 's3',
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
        'bucket' => '',
        'url' => NULL,
        'endpoint' => NULL,
        'use_path_style_endpoint' => false,
      ),
    ),
    'links' => 
    array (
      '/home/bebrmslz/public_html/public/storage' => '/home/bebrmslz/public_html/storage/app/public',
    ),
  ),
  'hashing' => 
  array (
    'driver' => 'bcrypt',
    'bcrypt' => 
    array (
      'rounds' => 10,
    ),
    'argon' => 
    array (
      'memory' => 1024,
      'threads' => 2,
      'time' => 2,
    ),
  ),
  'logging' => 
  array (
    'default' => 'stack',
    'deprecations' => NULL,
    'channels' => 
    array (
      'stack' => 
      array (
        'driver' => 'stack',
        'channels' => 
        array (
          0 => 'single',
        ),
        'ignore_exceptions' => false,
      ),
      'single' => 
      array (
        'driver' => 'single',
        'path' => '/home/bebrmslz/public_html/storage/logs/laravel.log',
        'level' => 'debug',
      ),
      'daily' => 
      array (
        'driver' => 'daily',
        'path' => '/home/bebrmslz/public_html/storage/logs/laravel.log',
        'level' => 'debug',
        'days' => 14,
      ),
      'slack' => 
      array (
        'driver' => 'slack',
        'url' => NULL,
        'username' => 'Laravel Log',
        'emoji' => ':boom:',
        'level' => 'debug',
      ),
      'papertrail' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\SyslogUdpHandler',
        'handler_with' => 
        array (
          'host' => NULL,
          'port' => NULL,
        ),
      ),
      'stderr' => 
      array (
        'driver' => 'monolog',
        'level' => 'debug',
        'handler' => 'Monolog\\Handler\\StreamHandler',
        'formatter' => NULL,
        'with' => 
        array (
          'stream' => 'php://stderr',
        ),
      ),
      'syslog' => 
      array (
        'driver' => 'syslog',
        'level' => 'debug',
      ),
      'errorlog' => 
      array (
        'driver' => 'errorlog',
        'level' => 'debug',
      ),
      'null' => 
      array (
        'driver' => 'monolog',
        'handler' => 'Monolog\\Handler\\NullHandler',
      ),
      'emergency' => 
      array (
        'path' => '/home/bebrmslz/public_html/storage/logs/laravel.log',
      ),
    ),
  ),
  'mail' => 
  array (
    'default' => 'smtp',
    'mailers' => 
    array (
      'smtp' => 
      array (
        'transport' => 'smtp',
        'host' => 'mailhog',
        'port' => '1025',
        'encryption' => NULL,
        'username' => NULL,
        'password' => NULL,
        'timeout' => NULL,
        'auth_mode' => NULL,
      ),
      'ses' => 
      array (
        'transport' => 'ses',
      ),
      'mailgun' => 
      array (
        'transport' => 'mailgun',
      ),
      'postmark' => 
      array (
        'transport' => 'postmark',
      ),
      'sendmail' => 
      array (
        'transport' => 'sendmail',
        'path' => '/usr/sbin/sendmail -t -i',
      ),
      'log' => 
      array (
        'transport' => 'log',
        'channel' => NULL,
      ),
      'array' => 
      array (
        'transport' => 'array',
      ),
      'failover' => 
      array (
        'transport' => 'failover',
        'mailers' => 
        array (
          0 => 'smtp',
          1 => 'log',
        ),
      ),
    ),
    'from' => 
    array (
      'address' => 'info@bebran.com',
      'name' => 'Bebran',
    ),
    'markdown' => 
    array (
      'theme' => 'default',
      'paths' => 
      array (
        0 => '/home/bebrmslz/public_html/resources/views/vendor/mail',
      ),
    ),
  ),
  'queue' => 
  array (
    'default' => 'sync',
    'connections' => 
    array (
      'sync' => 
      array (
        'driver' => 'sync',
      ),
      'database' => 
      array (
        'driver' => 'database',
        'table' => 'jobs',
        'queue' => 'default',
        'retry_after' => 90,
        'after_commit' => false,
      ),
      'beanstalkd' => 
      array (
        'driver' => 'beanstalkd',
        'host' => 'localhost',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => 0,
        'after_commit' => false,
      ),
      'sqs' => 
      array (
        'driver' => 'sqs',
        'key' => '',
        'secret' => '',
        'prefix' => 'https://sqs.us-east-1.amazonaws.com/your-account-id',
        'queue' => 'default',
        'suffix' => NULL,
        'region' => 'us-east-1',
        'after_commit' => false,
      ),
      'redis' => 
      array (
        'driver' => 'redis',
        'connection' => 'default',
        'queue' => 'default',
        'retry_after' => 90,
        'block_for' => NULL,
        'after_commit' => false,
      ),
    ),
    'failed' => 
    array (
      'driver' => 'database-uuids',
      'database' => 'mysql',
      'table' => 'failed_jobs',
    ),
  ),
  'sanctum' => 
  array (
    'stateful' => 
    array (
      0 => 'localhost',
      1 => 'localhost:3000',
      2 => '127.0.0.1',
      3 => '127.0.0.1:8000',
      4 => '::1',
      5 => 'bebran.com',
    ),
    'guard' => 
    array (
      0 => 'web',
    ),
    'expiration' => NULL,
    'middleware' => 
    array (
      'verify_csrf_token' => 'App\\Http\\Middleware\\VerifyCsrfToken',
      'encrypt_cookies' => 'App\\Http\\Middleware\\EncryptCookies',
    ),
  ),
  'services' => 
  array (
    'mailgun' => 
    array (
      'domain' => NULL,
      'secret' => NULL,
      'endpoint' => 'api.mailgun.net',
    ),
    'postmark' => 
    array (
      'token' => NULL,
    ),
    'ses' => 
    array (
      'key' => '',
      'secret' => '',
      'region' => 'us-east-1',
    ),
  ),
  'session' => 
  array (
    'driver' => 'file',
    'lifetime' => '120',
    'expire_on_close' => false,
    'encrypt' => false,
    'files' => '/home/bebrmslz/public_html/storage/framework/sessions',
    'connection' => NULL,
    'table' => 'sessions',
    'store' => NULL,
    'lottery' => 
    array (
      0 => 2,
      1 => 100,
    ),
    'cookie' => 'bebran_session',
    'path' => '/',
    'domain' => NULL,
    'secure' => NULL,
    'http_only' => true,
    'same_site' => 'lax',
  ),
  'view' => 
  array (
    'paths' => 
    array (
      0 => '/home/bebrmslz/public_html/resources/views',
    ),
    'compiled' => '/home/bebrmslz/public_html/storage/framework/views',
  ),
  'dompdf' => 
  array (
    'show_warnings' => false,
    'orientation' => 'portrait',
    'defines' => 
    array (
      'font_dir' => '/home/bebrmslz/public_html/storage/fonts/',
      'font_cache' => '/home/bebrmslz/public_html/storage/fonts/',
      'temp_dir' => '/tmp',
      'chroot' => '/home/bebrmslz/public_html',
      'enable_font_subsetting' => false,
      'pdf_backend' => 'CPDF',
      'default_media_type' => 'screen',
      'default_paper_size' => 'a4',
      'default_font' => 'serif',
      'dpi' => 96,
      'enable_php' => false,
      'enable_javascript' => true,
      'enable_remote' => true,
      'font_height_ratio' => 1.1,
      'enable_html5_parser' => false,
    ),
  ),
  'flare' => 
  array (
    'key' => NULL,
    'reporting' => 
    array (
      'anonymize_ips' => true,
      'collect_git_information' => false,
      'report_queries' => true,
      'maximum_number_of_collected_queries' => 200,
      'report_query_bindings' => true,
      'report_view_data' => true,
      'grouping_type' => NULL,
      'report_logs' => true,
      'maximum_number_of_collected_logs' => 200,
      'censor_request_body_fields' => 
      array (
        0 => 'password',
      ),
    ),
    'send_logs_as_events' => true,
    'censor_request_body_fields' => 
    array (
      0 => 'password',
    ),
  ),
  'ignition' => 
  array (
    'editor' => 'phpstorm',
    'theme' => 'light',
    'enable_share_button' => true,
    'register_commands' => false,
    'ignored_solution_providers' => 
    array (
      0 => 'Facade\\Ignition\\SolutionProviders\\MissingPackageSolutionProvider',
    ),
    'enable_runnable_solutions' => NULL,
    'remote_sites_path' => '',
    'local_sites_path' => '',
    'housekeeping_endpoint_prefix' => '_ignition',
  ),
  'excel' => 
  array (
    'exports' => 
    array (
      'chunk_size' => 1000,
      'pre_calculate_formulas' => false,
      'strict_null_comparison' => false,
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'line_ending' => '
',
        'use_bom' => false,
        'include_separator_line' => false,
        'excel_compatibility' => false,
        'output_encoding' => '',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'imports' => 
    array (
      'read_only' => true,
      'ignore_empty' => false,
      'heading_row' => 
      array (
        'formatter' => 'slug',
      ),
      'csv' => 
      array (
        'delimiter' => ',',
        'enclosure' => '"',
        'escape_character' => '\\',
        'contiguous' => false,
        'input_encoding' => 'UTF-8',
      ),
      'properties' => 
      array (
        'creator' => '',
        'lastModifiedBy' => '',
        'title' => '',
        'description' => '',
        'subject' => '',
        'keywords' => '',
        'category' => '',
        'manager' => '',
        'company' => '',
      ),
    ),
    'extension_detector' => 
    array (
      'xlsx' => 'Xlsx',
      'xlsm' => 'Xlsx',
      'xltx' => 'Xlsx',
      'xltm' => 'Xlsx',
      'xls' => 'Xls',
      'xlt' => 'Xls',
      'ods' => 'Ods',
      'ots' => 'Ods',
      'slk' => 'Slk',
      'xml' => 'Xml',
      'gnumeric' => 'Gnumeric',
      'htm' => 'Html',
      'html' => 'Html',
      'csv' => 'Csv',
      'tsv' => 'Csv',
      'pdf' => 'Dompdf',
    ),
    'value_binder' => 
    array (
      'default' => 'Maatwebsite\\Excel\\DefaultValueBinder',
    ),
    'cache' => 
    array (
      'driver' => 'memory',
      'batch' => 
      array (
        'memory_limit' => 60000,
      ),
      'illuminate' => 
      array (
        'store' => NULL,
      ),
    ),
    'transactions' => 
    array (
      'handler' => 'db',
      'db' => 
      array (
        'connection' => NULL,
      ),
    ),
    'temporary_files' => 
    array (
      'local_path' => '/home/bebrmslz/public_html/storage/framework/cache/laravel-excel',
      'remote_disk' => NULL,
      'remote_prefix' => NULL,
      'force_resync_remote' => NULL,
    ),
  ),
  'site' => 
  array (
    'title' => 'BeBran Digital',
    'logo' => '1684411706_1683115263_be-bran-header-logo.webp',
    'pagination' => NULL,
    'meta_title' => NULL,
    'meta_keyword' => NULL,
    'meta_description' => NULL,
    'meta_image' => '1627316567final-logo1.png',
    'favicon' => '1683116405_favicon.ico',
    'contact_email' => NULL,
    'support_email' => NULL,
    'address' => NULL,
    'email' => NULL,
    'phone' => '+91-8349815741',
    'google_analytics' => NULL,
    'footer_logo' => '1684821193_1683116437_be-bran-footer-logo.webp',
    'facebook_link' => 'https://www.facebook.com/bebran',
    'twitter_link' => 'https://twitter.com/bebran',
    'instagram_link' => 'https://www.instagram.com/bebran',
    'linkedin_link' => 'https://www.linkedin.com/company/bebran',
    'pinterest_link' => NULL,
    'youtube_link' => NULL,
    'copyright' => 'Copyright © {#Year#}. BeBran Digital. All Rights Reserved.',
    'url' => NULL,
    'whatsapp' => '+91-8349815741',
    'skype_link' => 'https://join.skype.com/invite/utDElBCpgvbE',
    'community_link' => NULL,
    'footer1_title' => '<h4>About Us</h4>

<p>BeBran Digital is one of the pioneer digital marketing agencies in India. We have over thirteen years of experience in the marketing industry.</p>',
    'footer2_title' => 'Contact us',
    'footer3_title' => 'Our Services',
    'footer4_title' => 'Resources',
    'footer5_title' => 'follow us on',
    'mobilelogo' => '1684761624_be-bran-mobaillogo.webp',
    'meta_tag' => NULL,
    'exclude_stuctured_data' => '24,35',
    'book_appointment' => 'book_appointment',
    'language_meta_tag' => NULL,
    'footer2_title4' => '+91-8349815741',
    'header_resource_link2' => 'https://bebran.com/news-list',
    'header_resource_title2' => 'News',
    'index_tag' => NULL,
    'author_tag' => NULL,
    'copyright_tag' => NULL,
    'revisit_after_tag' => NULL,
    'rating_tag' => NULL,
    'canonical_tag' => NULL,
    'open_graph_title_tag' => NULL,
    'open_graph_description_tag' => NULL,
    'open_graph_url_tag' => NULL,
    'open_graph_type_tag' => NULL,
    'open_graph_site_name_tag' => NULL,
    'twitter_card_tag' => NULL,
    'twitter_site_tag' => NULL,
    'twitter_title_tag' => NULL,
    'twitter_description_tag' => NULL,
    'geo_graphic_region_tag' => NULL,
    'geo_graphic_position_tag' => NULL,
    'geo_graphic_placename_tag' => NULL,
    'facebook_title_tag' => NULL,
    'facebook_description_tag' => NULL,
    'facebook_url_tag' => NULL,
    'facebook_type_tag' => NULL,
    'linkedIn_title_tag' => NULL,
    'linkedIn_description_tag' => NULL,
    'linkedIn_url_tag' => NULL,
    'linkedIn_type_tag' => NULL,
    'instagram_title_tag' => NULL,
    'instagram_description_tag' => NULL,
    'instagram_url_tag' => NULL,
    'instagram_type_tag' => NULL,
    'verification_tag_1' => NULL,
    'verification_tag_2' => NULL,
    'verification_tag_3' => NULL,
    'verification_tag_4' => NULL,
    'custom_code_in_head_section_1' => NULL,
    'custom_code_in_head_section_2' => NULL,
    'custom_code_in_head_section_3' => NULL,
    'custom_code_in_head_section_4' => NULL,
    'open_graph_image' => NULL,
    'twitter_image' => NULL,
    'facebook_image' => NULL,
    'linkedIn_image' => NULL,
    'instagram_image' => NULL,
    'footer2_title2' => '+91-8349815741',
    'footer2_title3' => 'info@bebran.com',
    'footer2_title1' => 'BeBran Digital Pvt. Ltd. , 55, 2nd Floor, Lane - 2, 	Westend Marg, Near Saket Metro Station, 	New Delhi - 110030',
    'footer2_title5' => 'Help',
    'footer3_title1' => '33',
    'footer3_title2' => '89',
    'footer3_title3' => '63',
    'footer3_title4' => '65',
    'footer3_title5' => '68',
    'footer4_title1' => '31',
    'footer4_title2' => '32',
    'footer4_title3' => '28',
    'footer4_title4' => NULL,
    'footer4_title5' => NULL,
    'important_links1' => '24',
    'important_links2' => '31',
    'important_links3' => '29',
    'important_links4' => '32',
    'important_links5' => '7',
    'important_links6' => '158',
    'important_links7' => '159',
    'important_links8' => '169',
    'important_links9' => NULL,
    'payment_methods' => '1701494212_visa.webp',
    'important_links10' => NULL,
    'important_links11' => NULL,
    'buy_with_confidence' => '1701494212_ssl.webp',
    'header_resource_title1' => NULL,
    'header_resource_link1' => NULL,
    'footer2_title6' => NULL,
    'footer2_title7' => NULL,
    'footer2_title8' => 'https://join.skype.com/invite/utDElBCpgvbE',
    'footer3_title6' => '81',
    'footer3_title7' => '74',
    'footer3_title8' => '82',
    'resource_title1' => 'Tools',
    'resource_link1' => 'https://tools.bebran.com/',
    'resource_title2' => 'News',
    'resource_link2' => 'https://bebran.com/news',
    'resource_title3' => 'Media Coverage',
    'resource_link3' => 'https://bebran.com/media-coverage',
    'resource_title4' => 'Guest Post',
    'resource_link4' => 'https://bebran.com/submit-guest-post',
    'resource_title5' => 'Blog',
    'resource_link5' => 'https://bebran.com/blog-list',
    'header_resource_title3' => 'Media Coverage',
    'resource_title6' => NULL,
    'resource_link6' => NULL,
    'resource_title7' => NULL,
    'resource_link7' => NULL,
    'resource_title8' => NULL,
    'resource_link8' => NULL,
    'header_resource_link3' => 'https://bebran.com/media-coverage',
    'header_resource_title4' => 'Guest Post',
    'header_resource_link4' => 'https://bebran.com/submit-guest-post',
    'header_resource_title5' => 'Tools',
    'header_resource_link5' => 'https://tools.bebran.com',
    'header_resource_title6' => 'Blog',
    'header_resource_link6' => 'https://bebran.com/blog-list',
    'header_resource_title7' => NULL,
    'header_resource_link7' => NULL,
    'header_resource_title8' => NULL,
    'header_resource_link8' => NULL,
    'country_title1' => 'Saudi Arabia',
    'country_link1' => NULL,
    'country_title2' => 'United States',
    'country_link2' => NULL,
    'country_title3' => 'United Kingdom',
    'country_link3' => NULL,
    'country_title4' => 'Australia',
    'country_link4' => NULL,
    'country_title5' => 'UAE',
    'country_link5' => NULL,
    'country_title6' => 'Canada',
    'country_link6' => NULL,
    'country_title7' => 'Norway',
    'country_link7' => NULL,
    'country_title8' => NULL,
    'country_link8' => NULL,
    'country_title9' => NULL,
    'country_link9' => NULL,
    'country_title10' => NULL,
    'country_link10' => NULL,
    'header_nav_title1' => 'About Us',
    'header_nav_title2' => 'Contact Us',
    'header_nav_title3' => NULL,
    'header_nav_title4' => NULL,
    'header_nav_title5' => NULL,
    'header_nav_link1' => 'https://bebran.com/about-us',
    'header_nav_link2' => 'https://bebran.com/contact-us',
    'header_nav_link3' => NULL,
    'header_nav_link4' => NULL,
    'header_nav_link5' => NULL,
    'header_nav_button_title1' => 'FREE WEBSITE AUDIT',
    'header_nav_button_link1' => 'https://tools.bebran.com',
  ),
  'admin' => 
  array (
    'pagination' => '25',
  ),
  'currency' => '$',
  'tinker' => 
  array (
    'commands' => 
    array (
    ),
    'alias' => 
    array (
    ),
    'dont_alias' => 
    array (
      0 => 'App\\Nova',
    ),
  ),
);
