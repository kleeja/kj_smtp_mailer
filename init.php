<?php
// kleeja plugin
// developer: KLEEJA TEAM

// prevent illegal run
if (! defined('IN_PLUGINS_SYSTEM'))
{
    exit;
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/functions.php';

// plugin basic information
$kleeja_plugin['kj_smtp_mailer']['information'] = [
    // the casual name of this plugin, anything can a human being understands
    'plugin_title' => [
        'en' => 'Kleeja SMTP Mailer',
        'ar' => 'برنامج إرسال البريد الإلكتروني SMTP من Kleeja',
        'fa' => 'ارسال ایمیل SMTP کلیجا'
    ],
    // who wrote this plugin?
    'plugin_developer' => 'Kleeja Team',
    // this plugin version
    'plugin_version' => '1.2',
    // explain what is this plugin, why should i use it?
    'plugin_description' => [
        'en' => 'Send mails through your own SMTP server instead of the PHP mail function',
        'ar' => 'إرسال رسائل البريد الإلكتروني باستخدام خادم SMTP مخصص بدلًا من دالة mail في PHP',
        'fa' => 'ارسال ایمیل از طریق سرور SMTP خودتان به جای تابع mail در PHP',
    ],

    // min version of kleeja that's required to run this plugin
    'plugin_kleeja_version_min' => '3.2.5',
    // max version of kleeja that support this plugin, use 0 for unlimited
    'plugin_kleeja_version_max' => '3.9',
    // should this plugin run before others?, 0 is normal, and higher number has high priority
    'plugin_priority' => 0,
    // setting page to display in plugins page
    'settings_page' => 'cp=options&smt=kj_smtp_mailer'
];

//after installation message, you can remove it, it's not requiered
$kleeja_plugin['kj_smtp_mailer']['first_run']['ar'] = "
يتيح لك هذا البرنامج المساعد إرسال بريد الموقع عبر خادم SMTP خاص بك بدلًا من دالة mail في PHP،
وهو ما يجعل الرسائل تصل بشكل أفضل ولا تنتهي في مجلد البريد المزعج.
<br>
اضبط الخادم واسم المستخدم وكلمة المرور من صفحة الإعدادات، ثم أرسل رسالة تجريبية للتأكد.
<br>
حتى تكتمل الإعدادات يظل الموقع يرسل البريد بالطريقة الاعتيادية.
<br>
<a href='./index.php?cp=options&smt=kj_smtp_mailer'>الإعدادات</a> -
<a href='./index.php?cp=kj_smtp_mailer'>الحالة والاختبار</a>
";

$kleeja_plugin['kj_smtp_mailer']['first_run']['en'] = "
This plugin sends your site's mail through an SMTP server of your own instead of the PHP mail function,
which is what keeps messages out of spam folders.
<br>
Set the host, username and password on the settings page, then send yourself a test message.
<br>
Until the settings are complete the site keeps sending mail the way it always did.
<br>
<a href='./index.php?cp=options&smt=kj_smtp_mailer'>Settings</a> -
<a href='./index.php?cp=kj_smtp_mailer'>Status and test</a>
";

$kleeja_plugin['kj_smtp_mailer']['first_run']['fa'] = "
این افزونه ایمیل‌های سایت شما را به جای تابع mail در PHP از طریق سرور SMTP خودتان ارسال می‌کند،
و همین است که پیام‌ها را از پوشه هرزنامه دور نگه می‌دارد.
<br>
میزبان و نام کاربری و گذرواژه را در صفحه تنظیمات وارد کنید، سپس یک پیام آزمایشی برای خودتان بفرستید.
<br>
تا وقتی تنظیمات کامل نشده باشد، سایت ایمیل‌ها را به همان روش همیشگی ارسال می‌کند.
<br>
<a href='./index.php?cp=options&smt=kj_smtp_mailer'>تنظیمات</a> -
<a href='./index.php?cp=kj_smtp_mailer'>وضعیت و آزمایش</a>
";

// plugin installation function
$kleeja_plugin['kj_smtp_mailer']['install'] = function ($plg_id) {
    add_config_r(kj_smtp_mailer_config_rows($plg_id));

    foreach (kj_smtp_mailer_translations() as $lang_id => $words)
    {
        add_olang($words, $lang_id, $plg_id);
    }
};

$kleeja_plugin['kj_smtp_mailer']['update'] = function ($old_version, $new_version) {};

// plugin uninstalling, function to be called at uninstalling
$kleeja_plugin['kj_smtp_mailer']['uninstall'] = function ($plg_id) {
    delete_config(array_keys(kj_smtp_mailer_options()));

    //a plg_id of 0 makes delete_olang() drop every translation for the language
    if ((int) $plg_id > 0)
    {
        foreach (array_keys(kj_smtp_mailer_translations()) as $lang_id)
        {
            delete_olang(null, $lang_id, (int) $plg_id);
        }
    }
};

// plugin functions
$kleeja_plugin['kj_smtp_mailer']['functions'] = [
    'begin_admin_page' => function ($args) {
        $adm_extensions = $args['adm_extensions'];
        $ext_icons      = $args['ext_icons'];

        $adm_extensions[]            = 'kj_smtp_mailer';
        $ext_icons['kj_smtp_mailer'] = 'envelope';

        return compact('adm_extensions', 'ext_icons');
    },

    'not_exists_kj_smtp_mailer' => function ($args) {
        $include_alternative = __DIR__ . '/kj_smtp_mailer.php';

        return compact('include_alternative');
    },

    'kleeja_begin_send_mail_func' => function ($args) {
        global $config;
        if (! kj_smtp_mailer_is_configured($config))
        {
            return [];
        }

        $error = null;

        $mail_sent = kj_smtp_mailer_send(
            $config,
            $args['to'],
            $args['body'],
            $args['subject'],
            $args['fromAddress'],
            $args['fromName'],
            $args['bcc'],
            $error,
        );

        if (! $mail_sent)
        {
            kj_smtp_mailer_log_failure($args['to'], $error);
        }

        //handled either way: retrying over mail() would only send it twice
        //from a server the admin already chose to stop using
        $sending_mail_handled = true;

        return compact('sending_mail_handled', 'mail_sent');
    },

    //the guide of the plugin on kleeja's help page, its words are in language/help_{code}.php
    'admin_help_guides' => function ($args) {
        $help_guides = $args['help_guides'];
        $words       = kj_smtp_mailer_help_words();

        //keyed by the plugin name, so kleeja shows the plugin's icon with it, and
        //'page' makes the help button of the SMTP Mailer page open it
        $help_guides['kj_smtp_mailer'] = [
            'group'    => 'plugins',
            'title'    => $words['KJ_SMTP_MAILER_HELP_TITLE'],
            'intro'    => $words['KJ_SMTP_MAILER_HELP_INTRO'],
            'page'     => 'kj_smtp_mailer',
            'link'     => './?cp=kj_smtp_mailer',
            //tips and warnings sit beside the rest on wide screens
            'sections' => [
                kj_smtp_mailer_help_section($words, 'features', 'FEATURE'),
                kj_smtp_mailer_help_section($words, 'steps', 'STEP'),
                kj_smtp_mailer_help_section($words, 'features', 'SETTING'),
                kj_smtp_mailer_help_section($words, 'faq', 'FAQ'),
                kj_smtp_mailer_help_section($words, 'tips', 'TIP'),
                kj_smtp_mailer_help_section($words, 'warnings', 'WARNING'),
            ],
        ];

        //the settings of the plugin are a tab of kleeja's settings page, whose help
        //button opens kleeja's own guide, so that guide points to this one
        if (isset($help_guides['settings']))
        {
            $help_guides['settings']['sections'][] = ['type' => 'text', 'text' => $words['KJ_SMTP_MAILER_HELP_NOTE']];
        }

        return compact('help_guides');
    },
];
