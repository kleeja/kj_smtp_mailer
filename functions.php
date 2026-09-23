<?php
// kleeja plugin
// developer: KLEEJA TEAM

// prevent illegal run
if (! defined('IN_PLUGINS_SYSTEM'))
{
    exit;
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;

function kj_smtp_mailer_options(): array
{
    return [
        'kj_smtp_mailer_from_mail'       => ['value' => '',    'field' => 'text'],
        'kj_smtp_mailer_from_mail_force' => ['value' => '1',   'field' => 'yesno'],
        'kj_smtp_mailer_from_name'       => ['value' => '',    'field' => 'text'],
        'kj_smtp_mailer_from_name_force' => ['value' => '1',   'field' => 'yesno'],
        'kj_smtp_mailer_smtp_host'       => ['value' => '',    'field' => 'text'],
        'kj_smtp_mailer_smtp_port'       => ['value' => '587', 'field' => 'text'],
        'kj_smtp_mailer_smtp_encryption' => ['value' => 'tls', 'field' => 'encryption'],
        'kj_smtp_mailer_authentication'  => ['value' => '1',   'field' => 'yesno'],
        'kj_smtp_mailer_auth_username'   => ['value' => '',    'field' => 'text'],
        'kj_smtp_mailer_auth_password'   => ['value' => '',    'field' => 'password'],
    ];
}

function kj_smtp_mailer_field(string $name, string $field): string
{
    switch ($field)
    {
        case 'password':
            return '<input type="password" id="' . $name . '" name="' . $name . '"' .
                ' value="{con.' . $name . '}" size="50" autocomplete="new-password" />';

        case 'encryption':
            return configField($name, 'select', [
                '{olang.KJ_SMTP_MAILER_ENCRYPTION_NONE}' => 'none',
                '{olang.KJ_SMTP_MAILER_ENCRYPTION_TLS}'  => 'tls',
                '{olang.KJ_SMTP_MAILER_ENCRYPTION_SSL}'  => 'ssl',
            ]);

        default:
            return configField($name, $field);
    }
}

function kj_smtp_mailer_translations(): array
{
    return [
        'en' => [
            'R_KJ_SMTP_MAILER'                     => 'SMTP Mailer',
            'CONFIG_KLJ_MENUS_KJ_SMTP_MAILER'      => 'SMTP Mailer',
            'KJ_SMTP_MAILER_FROM_MAIL'             => 'From Mail',
            'KJ_SMTP_MAILER_FROM_MAIL_FORCE'       => 'Always send as this address',
            'KJ_SMTP_MAILER_FROM_NAME'             => 'From Name',
            'KJ_SMTP_MAILER_FROM_NAME_FORCE'       => 'Always send under this name',
            'KJ_SMTP_MAILER_SMTP_HOST'             => 'SMTP Host',
            'KJ_SMTP_MAILER_SMTP_PORT'             => 'SMTP Port',
            'KJ_SMTP_MAILER_SMTP_ENCRYPTION'       => 'SMTP Encryption',
            'KJ_SMTP_MAILER_AUTHENTICATION'        => 'SMTP Authentication',
            'KJ_SMTP_MAILER_AUTH_USERNAME'         => 'SMTP Username',
            'KJ_SMTP_MAILER_AUTH_PASSWORD'         => 'SMTP Password',
            'KJ_SMTP_MAILER_ENCRYPTION_NONE'       => 'None',
            'KJ_SMTP_MAILER_ENCRYPTION_SSL'        => 'SSL',
            'KJ_SMTP_MAILER_ENCRYPTION_TLS'        => 'TLS',
            'KJ_SMTP_MAILER_TAB_SETTINGS'          => 'Settings',
            'KJ_SMTP_MAILER_TAB_TEST'              => 'Status and test',
            'KJ_SMTP_MAILER_TAB_PRESETS'           => 'Ready-made setups',
            'KJ_SMTP_MAILER_PRESETS_INTRO'         => 'Pick your hosting provider and the server settings below are filled in for you.',
            'KJ_SMTP_MAILER_PRESETS_WARNING'       => 'If you continue, we will overwrite your SMTP configuration. Your sender address, username and password are left as they are.',
            'KJ_SMTP_MAILER_PRESETS_CONFIRM'       => 'This will overwrite your current SMTP configuration. Continue?',
            'KJ_SMTP_MAILER_PRESETS_APPLY'         => 'Use these settings',
            'KJ_SMTP_MAILER_PRESET_APPLIED'        => '%s settings applied.',
            'KJ_SMTP_MAILER_PRESET_NEEDS_LOGIN'    => 'Authentication is switched on, so you still have to enter the username and password of your %s email account before any mail will go out.',
            'KJ_SMTP_MAILER_PRESET_UNKNOWN'        => 'No such setup.',
            'KJ_SMTP_MAILER_PRESET_NOTE_GMAIL'     => 'SMTP has to be enabled on the Gmail account first. And with 2-step verification switched on, Google will not accept your normal password here - create an App Password and use that instead.',
            'KJ_SMTP_MAILER_STATUS_ACTIVE'         => 'Site mail is going out through your SMTP server.',
            'KJ_SMTP_MAILER_STATUS_INACTIVE'       => 'Site mail still uses the PHP mail function. This plugin takes over once the following is sorted out:',
            'KJ_SMTP_MAILER_ERR_NO_VENDOR'         => 'The PHPMailer library is missing. Install the release archive rather than a source checkout, or run composer install inside the plugin folder.',
            'KJ_SMTP_MAILER_ERR_NO_HOST'           => 'No SMTP host has been set.',
            'KJ_SMTP_MAILER_ERR_NO_FROM'           => 'No sender address has been set.',
            'KJ_SMTP_MAILER_ERR_NO_CREDENTIALS'    => 'Authentication is on but the username or password is empty.',
            'KJ_SMTP_MAILER_SERVER'                => 'Server',
            'KJ_SMTP_MAILER_ENCRYPTION'            => 'Encryption',
            'KJ_SMTP_MAILER_SENDER'                => 'Sender',
            'KJ_SMTP_MAILER_LOGIN'                 => 'Login',
            'KJ_SMTP_MAILER_EDIT_SETTINGS'         => 'Edit settings',
            'KJ_SMTP_MAILER_TEST_TITLE'            => 'Send a test message',
            'KJ_SMTP_MAILER_TEST_HINT'             => 'A test goes through exactly the same path as the rest of your site mail.',
            'KJ_SMTP_MAILER_TEST_TO'               => 'Send to',
            'KJ_SMTP_MAILER_TEST_SEND'             => 'Send test',
            'KJ_SMTP_MAILER_TEST_SUBJECT'          => 'SMTP test message',
            'KJ_SMTP_MAILER_TEST_BODY'             => 'If you are reading this, your Kleeja site can send mail through its SMTP server.',
            'KJ_SMTP_MAILER_TEST_OK'               => 'Test message accepted by the server. Check the inbox you sent it to.',
            'KJ_SMTP_MAILER_TEST_FAILED'           => 'The server refused the test message:',
            'KJ_SMTP_MAILER_TEST_BAD_ADDRESS'      => 'That does not look like an email address.',
            'KJ_SMTP_MAILER_TEST_NOT_CONFIGURED'   => 'Finish the settings before sending a test.',
        ],
        'ar' => [
            'R_KJ_SMTP_MAILER'                     => 'إرسال البريد SMTP',
            'CONFIG_KLJ_MENUS_KJ_SMTP_MAILER'      => 'إرسال البريد SMTP',
            'KJ_SMTP_MAILER_FROM_MAIL'             => 'بريد المُرسِل',
            'KJ_SMTP_MAILER_FROM_MAIL_FORCE'       => 'الإرسال دائمًا من هذا البريد',
            'KJ_SMTP_MAILER_FROM_NAME'             => 'اسم المُرسِل',
            'KJ_SMTP_MAILER_FROM_NAME_FORCE'       => 'الإرسال دائمًا بهذا الاسم',
            'KJ_SMTP_MAILER_SMTP_HOST'             => 'مضيف SMTP',
            'KJ_SMTP_MAILER_SMTP_PORT'             => 'منفذ SMTP',
            'KJ_SMTP_MAILER_SMTP_ENCRYPTION'       => 'تشفير SMTP',
            'KJ_SMTP_MAILER_AUTHENTICATION'        => 'مصادقة SMTP',
            'KJ_SMTP_MAILER_AUTH_USERNAME'         => 'اسم مستخدم SMTP',
            'KJ_SMTP_MAILER_AUTH_PASSWORD'         => 'كلمة مرور SMTP',
            'KJ_SMTP_MAILER_ENCRYPTION_NONE'       => 'بدون',
            'KJ_SMTP_MAILER_ENCRYPTION_SSL'        => 'SSL',
            'KJ_SMTP_MAILER_ENCRYPTION_TLS'        => 'TLS',
            'KJ_SMTP_MAILER_TAB_SETTINGS'          => 'الإعدادات',
            'KJ_SMTP_MAILER_TAB_TEST'              => 'الحالة والاختبار',
            'KJ_SMTP_MAILER_TAB_PRESETS'           => 'إعدادات جاهزة',
            'KJ_SMTP_MAILER_PRESETS_INTRO'         => 'اختر شركة الاستضافة التي تستعملها، وسنضبط إعدادات الخادم أدناه نيابةً عنك.',
            'KJ_SMTP_MAILER_PRESETS_WARNING'       => 'إذا تابعت فسنستبدل إعدادات SMTP الحالية. أمّا بريد المُرسِل واسم المستخدم وكلمة المرور فتبقى كما هي.',
            'KJ_SMTP_MAILER_PRESETS_CONFIRM'       => 'سيؤدي هذا إلى استبدال إعدادات SMTP الحالية، هل تريد المتابعة؟',
            'KJ_SMTP_MAILER_PRESETS_APPLY'         => 'استخدم هذه الإعدادات',
            'KJ_SMTP_MAILER_PRESET_APPLIED'        => 'تم تطبيق إعدادات %s.',
            'KJ_SMTP_MAILER_PRESET_NEEDS_LOGIN'    => 'المصادقة مفعّلة، لذا عليك إدخال اسم المستخدم وكلمة المرور الخاصين بحساب بريدك في %s قبل أن يُرسَل أي بريد.',
            'KJ_SMTP_MAILER_PRESET_UNKNOWN'        => 'لا توجد إعدادات جاهزة بهذا الاسم.',
            'KJ_SMTP_MAILER_PRESET_NOTE_GMAIL'     => 'يجب تفعيل SMTP في حساب Gmail أولًا. وإذا كان التحقق بخطوتين مفعّلًا فلن تقبل Google كلمة مرورك المعتادة هنا، فأنشئ «كلمة مرور للتطبيقات» واستعملها بدلًا منها.',
            'KJ_SMTP_MAILER_STATUS_ACTIVE'         => 'يُرسل بريد الموقع الآن عبر خادم SMTP الخاص بك.',
            'KJ_SMTP_MAILER_STATUS_INACTIVE'       => 'ما زال بريد الموقع يُرسل بدالة mail في PHP، وسيتولى البرنامج المساعد الإرسال بعد معالجة ما يلي:',
            'KJ_SMTP_MAILER_ERR_NO_VENDOR'         => 'مكتبة PHPMailer غير موجودة. ثبّت أرشيف الإصدار بدلًا من نسخة المستودع، أو نفّذ composer install داخل مجلد البرنامج المساعد.',
            'KJ_SMTP_MAILER_ERR_NO_HOST'           => 'لم يُضبط مضيف SMTP.',
            'KJ_SMTP_MAILER_ERR_NO_FROM'           => 'لم يُضبط بريد المُرسِل.',
            'KJ_SMTP_MAILER_ERR_NO_CREDENTIALS'    => 'المصادقة مفعّلة لكن اسم المستخدم أو كلمة المرور فارغة.',
            'KJ_SMTP_MAILER_SERVER'                => 'الخادم',
            'KJ_SMTP_MAILER_ENCRYPTION'            => 'التشفير',
            'KJ_SMTP_MAILER_SENDER'                => 'المُرسِل',
            'KJ_SMTP_MAILER_LOGIN'                 => 'تسجيل الدخول',
            'KJ_SMTP_MAILER_EDIT_SETTINGS'         => 'تعديل الإعدادات',
            'KJ_SMTP_MAILER_TEST_TITLE'            => 'إرسال رسالة تجريبية',
            'KJ_SMTP_MAILER_TEST_HINT'             => 'تسلك الرسالة التجريبية المسار نفسه الذي يسلكه بريد الموقع.',
            'KJ_SMTP_MAILER_TEST_TO'               => 'الإرسال إلى',
            'KJ_SMTP_MAILER_TEST_SEND'             => 'إرسال تجريبي',
            'KJ_SMTP_MAILER_TEST_SUBJECT'          => 'رسالة اختبار SMTP',
            'KJ_SMTP_MAILER_TEST_BODY'             => 'وصول هذه الرسالة يعني أن موقع Kleeja قادر على الإرسال عبر خادم SMTP.',
            'KJ_SMTP_MAILER_TEST_OK'               => 'قبل الخادم الرسالة التجريبية، تحقق من صندوق البريد الذي أرسلتها إليه.',
            'KJ_SMTP_MAILER_TEST_FAILED'           => 'رفض الخادم الرسالة التجريبية:',
            'KJ_SMTP_MAILER_TEST_BAD_ADDRESS'      => 'هذا لا يبدو بريدًا إلكترونيًا صحيحًا.',
            'KJ_SMTP_MAILER_TEST_NOT_CONFIGURED'   => 'أكمل الإعدادات قبل إرسال رسالة تجريبية.',
        ],

        'fa' => [
            'R_KJ_SMTP_MAILER'                     => 'ارسال ایمیل SMTP',
            'CONFIG_KLJ_MENUS_KJ_SMTP_MAILER'      => 'ارسال ایمیل SMTP',
            'KJ_SMTP_MAILER_FROM_MAIL'             => 'ایمیل فرستنده',
            'KJ_SMTP_MAILER_FROM_MAIL_FORCE'       => 'همیشه از این نشانی ارسال کن',
            'KJ_SMTP_MAILER_FROM_NAME'             => 'نام فرستنده',
            'KJ_SMTP_MAILER_FROM_NAME_FORCE'       => 'همیشه با این نام ارسال کن',
            'KJ_SMTP_MAILER_SMTP_HOST'             => 'میزبان SMTP',
            'KJ_SMTP_MAILER_SMTP_PORT'             => 'درگاه SMTP',
            'KJ_SMTP_MAILER_SMTP_ENCRYPTION'       => 'رمزنگاری SMTP',
            'KJ_SMTP_MAILER_AUTHENTICATION'        => 'احراز هویت SMTP',
            'KJ_SMTP_MAILER_AUTH_USERNAME'         => 'نام کاربری SMTP',
            'KJ_SMTP_MAILER_AUTH_PASSWORD'         => 'گذرواژه SMTP',
            'KJ_SMTP_MAILER_ENCRYPTION_NONE'       => 'بدون رمزنگاری',
            'KJ_SMTP_MAILER_ENCRYPTION_SSL'        => 'SSL',
            'KJ_SMTP_MAILER_ENCRYPTION_TLS'        => 'TLS',
            'KJ_SMTP_MAILER_TAB_SETTINGS'          => 'تنظیمات',
            'KJ_SMTP_MAILER_TAB_TEST'              => 'وضعیت و آزمایش',
            'KJ_SMTP_MAILER_TAB_PRESETS'           => 'تنظیمات آماده',
            'KJ_SMTP_MAILER_PRESETS_INTRO'         => 'سرویس میزبانی خود را انتخاب کنید تا تنظیمات سرور به جای شما پر شود.',
            'KJ_SMTP_MAILER_PRESETS_WARNING'       => 'اگر ادامه دهید، تنظیمات SMTP فعلی شما بازنویسی می‌شود. نشانی فرستنده و نام کاربری و گذرواژه دست‌نخورده می‌مانند.',
            'KJ_SMTP_MAILER_PRESETS_CONFIRM'       => 'این کار تنظیمات SMTP فعلی شما را بازنویسی می‌کند. ادامه می‌دهید؟',
            'KJ_SMTP_MAILER_PRESETS_APPLY'         => 'از این تنظیمات استفاده کن',
            'KJ_SMTP_MAILER_PRESET_APPLIED'        => 'تنظیمات %s اعمال شد.',
            'KJ_SMTP_MAILER_PRESET_NEEDS_LOGIN'    => 'احراز هویت روشن است، پس هنوز باید نام کاربری و گذرواژه حساب ایمیل خود در %s را وارد کنید تا ایمیلی ارسال شود.',
            'KJ_SMTP_MAILER_PRESET_UNKNOWN'        => 'چنین تنظیمات آماده‌ای وجود ندارد.',
            'KJ_SMTP_MAILER_PRESET_NOTE_GMAIL'     => 'ابتدا باید SMTP در حساب Gmail فعال شود. و اگر تأیید دومرحله‌ای روشن باشد، Google گذرواژه معمولی شما را اینجا نمی‌پذیرد؛ یک «گذرواژه برنامه» بسازید و از آن استفاده کنید.',
            'KJ_SMTP_MAILER_STATUS_ACTIVE'         => 'ایمیل‌های سایت از طریق سرور SMTP شما ارسال می‌شوند.',
            'KJ_SMTP_MAILER_STATUS_INACTIVE'       => 'ایمیل‌های سایت هنوز از تابع mail در PHP استفاده می‌کنند. این افزونه پس از رفع موارد زیر کار را به دست می‌گیرد:',
            'KJ_SMTP_MAILER_ERR_NO_VENDOR'         => 'کتابخانه PHPMailer موجود نیست. به جای نسخه مخزن، بسته انتشار را نصب کنید یا در پوشه افزونه دستور composer install را اجرا کنید.',
            'KJ_SMTP_MAILER_ERR_NO_HOST'           => 'میزبان SMTP تنظیم نشده است.',
            'KJ_SMTP_MAILER_ERR_NO_FROM'           => 'نشانی فرستنده تنظیم نشده است.',
            'KJ_SMTP_MAILER_ERR_NO_CREDENTIALS'    => 'احراز هویت روشن است ولی نام کاربری یا گذرواژه خالی است.',
            'KJ_SMTP_MAILER_SERVER'                => 'سرور',
            'KJ_SMTP_MAILER_ENCRYPTION'            => 'رمزنگاری',
            'KJ_SMTP_MAILER_SENDER'                => 'فرستنده',
            'KJ_SMTP_MAILER_LOGIN'                 => 'ورود',
            'KJ_SMTP_MAILER_EDIT_SETTINGS'         => 'ویرایش تنظیمات',
            'KJ_SMTP_MAILER_TEST_TITLE'            => 'ارسال پیام آزمایشی',
            'KJ_SMTP_MAILER_TEST_HINT'             => 'پیام آزمایشی دقیقاً همان مسیری را می‌پیماید که بقیه ایمیل‌های سایت می‌پیمایند.',
            'KJ_SMTP_MAILER_TEST_TO'               => 'ارسال به',
            'KJ_SMTP_MAILER_TEST_SEND'             => 'ارسال آزمایشی',
            'KJ_SMTP_MAILER_TEST_SUBJECT'          => 'پیام آزمایشی SMTP',
            'KJ_SMTP_MAILER_TEST_BODY'             => 'اگر این پیام را می‌خوانید، سایت کلیجای شما می‌تواند از طریق سرور SMTP ایمیل ارسال کند.',
            'KJ_SMTP_MAILER_TEST_OK'               => 'سرور پیام آزمایشی را پذیرفت. صندوق ورودی‌ای که به آن ارسال کردید را بررسی کنید.',
            'KJ_SMTP_MAILER_TEST_FAILED'           => 'سرور پیام آزمایشی را رد کرد:',
            'KJ_SMTP_MAILER_TEST_BAD_ADDRESS'      => 'این نشانی شبیه یک ایمیل معتبر نیست.',
            'KJ_SMTP_MAILER_TEST_NOT_CONFIGURED'   => 'پیش از ارسال آزمایشی، تنظیمات را کامل کنید.',
        ],
    ];
}

//ready-made server settings for hosts kleeja sites commonly run on. a preset
//only carries what is identical for every account on that host: the mailbox
//itself - sender address, username, password - differs per account and is left
//alone, which is why each preset switches authentication on and the admin is
//then sent to the settings page to finish the job.
function kj_smtp_mailer_presets(): array
{
    return [
        'hostinger' => [
            'name'   => 'Hostinger',
            'values' => [
                'kj_smtp_mailer_smtp_host'       => 'smtp.hostinger.com',
                'kj_smtp_mailer_smtp_port'       => '465',
                'kj_smtp_mailer_smtp_encryption' => 'ssl',
                'kj_smtp_mailer_authentication'  => '1',
            ],
        ],

        'gmail' => [
            'name'   => 'Gmail',
            'values' => [
                'kj_smtp_mailer_smtp_host'       => 'smtp.gmail.com',
                'kj_smtp_mailer_smtp_port'       => '587',
                'kj_smtp_mailer_smtp_encryption' => 'tls',
                'kj_smtp_mailer_authentication'  => '1',
            ],
            //an olang key: anything the admin has to do on the provider's side
            //before these settings will actually connect
            'note'   => 'KJ_SMTP_MAILER_PRESET_NOTE_GMAIL',
        ],
    ];
}

//only ever reached from the admin page, where the bootstrap is long finished
//and update_config() is safe to call
function kj_smtp_mailer_apply_preset(string $key): bool
{
    $presets = kj_smtp_mailer_presets();

    if (! isset($presets[$key]))
    {
        return false;
    }

    foreach ($presets[$key]['values'] as $name => $value)
    {
        //update_config() reports "nothing affected" when the value it is asked
        //to write is already there, so its return says nothing useful here
        update_config($name, $value);
    }

    delete_cache('data_config');

    return true;
}

//settings are laid out as fixed fields rather than a list of rows because
//kleeja's template engine cannot nest a LOOP inside a LOOP
function kj_smtp_mailer_preset_display(string $key, array $preset): array
{
    global $lang;

    $values     = $preset['values'];
    $encryption = $values['kj_smtp_mailer_smtp_encryption'] ?? 'none';

    return [
        'key'        => htmlspecialchars($key, ENT_QUOTES),
        'name'       => htmlspecialchars($preset['name'], ENT_QUOTES),
        'host'       => htmlspecialchars($values['kj_smtp_mailer_smtp_host'] ?? '-', ENT_QUOTES),
        'port'       => htmlspecialchars((string) ($values['kj_smtp_mailer_smtp_port'] ?? '-'), ENT_QUOTES),
        'encryption' => htmlspecialchars(
            kj_smtp_mailer_word('KJ_SMTP_MAILER_ENCRYPTION_' . strtoupper($encryption)),
            ENT_QUOTES,
        ),
        'auth'       => htmlspecialchars(
            empty($values['kj_smtp_mailer_authentication'])
                ? (string) ($lang['NO'] ?? 'No')
                : (string) ($lang['YES'] ?? 'Yes'),
            ENT_QUOTES,
        ),
        'note'       => isset($preset['note'])
            ? htmlspecialchars(kj_smtp_mailer_word($preset['note']), ENT_QUOTES)
            : '',
    ];
}

function kj_smtp_mailer_config_rows(int $plg_id): array
{
    $rows  = [];
    $order = 0;

    foreach (kj_smtp_mailer_options() as $name => $option)
    {
        $rows[$name] = [
            'value'  => $option['value'],
            'html'   => kj_smtp_mailer_field($name, $option['field']),
            'plg_id' => $plg_id,
            'type'   => 'kj_smtp_mailer',
            'order'  => (string) $order++,
        ];
    }

    return $rows;
}

function kj_smtp_mailer_setting(array $config, string $name, bool $trim = true): string
{
    $value = htmlspecialchars_decode((string) ($config[$name] ?? ''), ENT_QUOTES);

    return $trim ? trim($value) : $value;
}

function kj_smtp_mailer_flag(array $config, string $name): bool
{
    return ! empty($config[$name]) && $config[$name] !== '0';
}

function kj_smtp_mailer_ready(): bool
{
    return class_exists(PHPMailer::class);
}

function kj_smtp_mailer_config_errors(array $config): array
{
    $errors = [];

    if (! kj_smtp_mailer_ready())
    {
        $errors[] = 'KJ_SMTP_MAILER_ERR_NO_VENDOR';
    }

    if (kj_smtp_mailer_setting($config, 'kj_smtp_mailer_smtp_host') === '')
    {
        $errors[] = 'KJ_SMTP_MAILER_ERR_NO_HOST';
    }

    if (kj_smtp_mailer_setting($config, 'kj_smtp_mailer_from_mail') === '')
    {
        $errors[] = 'KJ_SMTP_MAILER_ERR_NO_FROM';
    }

    if (kj_smtp_mailer_flag($config, 'kj_smtp_mailer_authentication') && (
        kj_smtp_mailer_setting($config, 'kj_smtp_mailer_auth_username') === '' ||
        kj_smtp_mailer_setting($config, 'kj_smtp_mailer_auth_password', false) === ''
    ))
    {
        $errors[] = 'KJ_SMTP_MAILER_ERR_NO_CREDENTIALS';
    }

    return $errors;
}

function kj_smtp_mailer_is_configured(array $config): bool
{
    return kj_smtp_mailer_config_errors($config) === [];
}

function kj_smtp_mailer_default_port(string $encryption): int
{
    return $encryption === 'ssl' ? 465 : 587;
}

function kj_smtp_mailer_port(array $config): int
{
    return (int) kj_smtp_mailer_setting($config, 'kj_smtp_mailer_smtp_port')
        ?: kj_smtp_mailer_default_port(kj_smtp_mailer_setting($config, 'kj_smtp_mailer_smtp_encryption'));
}

function kj_smtp_mailer_valid_address(string $address): bool
{
    return kj_smtp_mailer_ready() && PHPMailer::validateAddress($address);
}

function kj_smtp_mailer_transport(array $config): PHPMailer
{
    $encryption = kj_smtp_mailer_setting($config, 'kj_smtp_mailer_smtp_encryption');

    $mail = new PHPMailer(true);

    $mail->isSMTP();
    $mail->Host = kj_smtp_mailer_setting($config, 'kj_smtp_mailer_smtp_host');
    $mail->Port = kj_smtp_mailer_port($config);

    if (kj_smtp_mailer_flag($config, 'kj_smtp_mailer_authentication'))
    {
        $mail->SMTPAuth = true;
        $mail->Username = kj_smtp_mailer_setting($config, 'kj_smtp_mailer_auth_username');
        $mail->Password = kj_smtp_mailer_setting($config, 'kj_smtp_mailer_auth_password', false);
    }

    if ($encryption === 'tls' || $encryption === 'ssl')
    {
        $mail->SMTPSecure = $encryption === 'tls'
            ? PHPMailer::ENCRYPTION_STARTTLS
            : PHPMailer::ENCRYPTION_SMTPS;
    }

    //"none" means "do not insist on a scheme", not "send in the clear": PHPMailer
    //still upgrades the connection when the server offers STARTTLS, and turning
    //SMTPAutoTLS off here would be a silent downgrade.

    $mail->CharSet       = PHPMailer::CHARSET_UTF8;
    $mail->Encoding      = PHPMailer::ENCODING_BASE64;
    $mail->XMailer       = 'Kleeja Mailer';
    $mail->Timeout       = 30;
    $mail->SMTPKeepAlive = false;
    $mail->SMTPDebug     = SMTP::DEBUG_OFF;
    $mail->Debugoutput   = 'error_log';
    $mail->isHTML(false);

    return $mail;
}

function kj_smtp_mailer_resolve_sender(array $config, string $fromAddress, string $fromName): array
{
    $address = kj_smtp_mailer_setting($config, 'kj_smtp_mailer_from_mail');
    $name    = kj_smtp_mailer_setting($config, 'kj_smtp_mailer_from_name');

    if (! kj_smtp_mailer_flag($config, 'kj_smtp_mailer_from_mail_force') && $fromAddress !== '')
    {
        $address = $fromAddress;
    }

    if (! kj_smtp_mailer_flag($config, 'kj_smtp_mailer_from_name_force') && $fromName !== '')
    {
        $name = $fromName;
    }

    return [
        $address !== '' ? $address : $fromAddress,
        $name !== '' ? $name : $fromName,
    ];
}

function kj_smtp_mailer_send(
    array $config,
    string $to,
    string $body,
    string $subject,
    string $fromAddress = '',
    string $fromName = '',
    string $bcc = '',
    ?string &$error = null,
): bool {
    $error = null;
    $mail  = null;

    try
    {
        $mail = kj_smtp_mailer_transport($config);

        [$sender_address, $sender_name] = kj_smtp_mailer_resolve_sender($config, $fromAddress, $fromName);

        $mail->setFrom($sender_address, $sender_name);

        //kleeja's mail() path sets Reply-To to the caller's address; keep that
        //promise so answering a contact form still reaches the visitor
        if ($fromAddress !== ''
            && strcasecmp($fromAddress, $sender_address) !== 0
            && kj_smtp_mailer_valid_address($fromAddress))
        {
            $mail->addReplyTo($fromAddress, $fromName);
        }

        $mail->addAddress($to);

        //a malformed bcc should not cost us the message itself
        foreach (preg_split('/[,;]/', $bcc) as $bcc_address)
        {
            $bcc_address = trim($bcc_address);

            if ($bcc_address !== '' && kj_smtp_mailer_valid_address($bcc_address))
            {
                $mail->addBCC($bcc_address);
            }
        }

        $mail->Subject = $subject;
        $mail->Body    = $body;

        return $mail->send();
    }
    catch (\Throwable $e)
    {
        //every entry point here is a page that was doing something else, so a
        //broken mail server must not be allowed to take the request down
        $error = $mail !== null && $mail->ErrorInfo !== '' ? $mail->ErrorInfo : $e->getMessage();

        return false;
    }
}

/**
 * Keep enough of an address to recognise it, not enough to harvest it.
 */
function kj_smtp_mailer_mask_address(string $address): string
{
    $at = strrpos($address, '@');

    if ($at === false || $at === 0)
    {
        return '***';
    }

    return substr($address, 0, 1) . '***' . substr($address, $at);
}

function kj_smtp_mailer_log_failure(string $to, ?string $error): void
{
    $line = 'kj_smtp_mailer: could not send to ' . kj_smtp_mailer_mask_address($to) . ' - ' .
        (empty($error) ? 'unknown error' : trim(preg_replace('/\s+/', ' ', $error)));

    //kleeja_log() is a no-op unless DEV_STAGE is defined, so also leave a trace
    //where an admin debugging a live server will actually look
    kleeja_log($line);
    error_log($line);
}

function kj_smtp_mailer_word(string $key, string $fallback = ''): string
{
    global $olang;

    if (! empty($olang[$key]))
    {
        return $olang[$key];
    }

    if ($fallback !== '')
    {
        return $fallback;
    }

    return kj_smtp_mailer_translations()['en'][$key] ?? $key;
}
