<?php
// kleeja plugin
// developer: KLEEJA TEAM

// not for directly open
if (! defined('IN_ADMIN'))
{
    exit;
}

// this page can make the server send mail, it rewrites the SMTP settings, and
// it links straight to the credentials, so it stays with the rest of the
// plugin administration
if (intval($userinfo['founder']) !== 1)
{
    kleeja_admin_err($lang['HV_NOT_PRVLG_ACCESS'], basename(ADMIN_PATH));

    exit;
}

// The settings themselves live on kleeja's own configs page, built from the
// rows this plugin installs. This page is the half kleeja cannot generate:
// ready-made settings per hosting provider, whether the plugin is actually in
// charge of site mail, and a way to prove it.
$stylee     = 'kj_smtp_mailer';
$styleePath = __DIR__;

$kjsm_status_url   = basename(ADMIN_PATH) . '?cp=kj_smtp_mailer';
$kjsm_presets_url  = $kjsm_status_url . '&amp;smt=presets';
$kjsm_settings_url = basename(ADMIN_PATH) . '?cp=options&amp;smt=kj_smtp_mailer';

$kjsm_view = preg_replace('/[^a-z0-9_]/i', '', g('smt', 'str', 'status'));

if (! in_array($kjsm_view, ['status', 'presets'], true))
{
    $kjsm_view = 'status';
}

$kjsm_is_presets = $kjsm_view === 'presets';
$kjsm_is_status  = ! $kjsm_is_presets;

$H_FORM_KEYS            = kleeja_add_form_key('kj_smtp_mailer_test');
$kjsm_preset_form_keys  = kleeja_add_form_key('kj_smtp_mailer_preset');

$kjsm_alert      = '';
$kjsm_alert_role = 'info';

//
//apply a ready-made setup. this runs before the status below is worked out, so
//the page that comes back already reflects what was just written.
//
if (ip('kjsm_apply_preset'))
{
    if (! kleeja_check_form_key('kj_smtp_mailer_preset'))
    {
        kleeja_admin_err($lang['INVALID_FORM_KEY'], $kjsm_presets_url);

        exit;
    }

    $kjsm_preset_key = preg_replace('/[^a-z0-9_]/i', '', p('kjsm_apply_preset'));
    $kjsm_presets    = kj_smtp_mailer_presets();

    if (! isset($kjsm_presets[$kjsm_preset_key]))
    {
        $kjsm_alert      = kj_smtp_mailer_word('KJ_SMTP_MAILER_PRESET_UNKNOWN');
        $kjsm_alert_role = 'danger';
    }
    else
    {
        $kjsm_preset_name = $kjsm_presets[$kjsm_preset_key]['name'];

        //update_config() writes into $config as it goes, so everything below
        //reads the new values without a round trip
        kj_smtp_mailer_apply_preset($kjsm_preset_key);

        //the preset cannot supply the mailbox, only the server, so say so and
        //put the link to finish the job right in the message
        $kjsm_alert =
            sprintf(kj_smtp_mailer_word('KJ_SMTP_MAILER_PRESET_APPLIED'), htmlspecialchars($kjsm_preset_name, ENT_QUOTES)) . ' ' .
            sprintf(kj_smtp_mailer_word('KJ_SMTP_MAILER_PRESET_NEEDS_LOGIN'), htmlspecialchars($kjsm_preset_name, ENT_QUOTES)) .
            ' <a href="' . $kjsm_settings_url . '">' . kj_smtp_mailer_word('KJ_SMTP_MAILER_EDIT_SETTINGS') . '</a>';

        $kjsm_alert_role = 'success';
    }
}

//what still stands between us and a working connection, as readable sentences
$kjsm_problems = [];

foreach (kj_smtp_mailer_config_errors($config) as $problem)
{
    $kjsm_problems[] = ['text' => htmlspecialchars(kj_smtp_mailer_word($problem), ENT_QUOTES)];
}

$kjsm_active = empty($kjsm_problems);

//what the plugin would dial right now
$kjsm_host       = kj_smtp_mailer_setting($config, 'kj_smtp_mailer_smtp_host');
$kjsm_server     = $kjsm_host === '' ? '-' : $kjsm_host . ':' . kj_smtp_mailer_port($config);
$kjsm_encryption = strtoupper(kj_smtp_mailer_setting($config, 'kj_smtp_mailer_smtp_encryption')) ?: 'NONE';
$kjsm_sender     = kj_smtp_mailer_setting($config, 'kj_smtp_mailer_from_mail') ?: '-';
$kjsm_login      = kj_smtp_mailer_flag($config, 'kj_smtp_mailer_authentication')
    ? (kj_smtp_mailer_setting($config, 'kj_smtp_mailer_auth_username') ?: '-')
    : $lang['NO'];

$kjsm_site_mail = kj_smtp_mailer_setting($config, 'sitemail');
$kjsm_site_name = kj_smtp_mailer_setting($config, 'sitename');
$kjsm_test_to   = $kjsm_site_mail;

//
//send a test message down the same road the rest of the site's mail takes
//
if (ip('kjsm_send_test'))
{
    if (! kleeja_check_form_key('kj_smtp_mailer_test'))
    {
        kleeja_admin_err($lang['INVALID_FORM_KEY'], $kjsm_status_url);

        exit;
    }

    //p() hands back html entities, and an address has to reach the server raw
    $kjsm_test_to = htmlspecialchars_decode(p('kjsm_test_to'), ENT_QUOTES);

    if (! $kjsm_active)
    {
        $kjsm_alert      = kj_smtp_mailer_word('KJ_SMTP_MAILER_TEST_NOT_CONFIGURED');
        $kjsm_alert_role = 'warning';
    }
    elseif (! kj_smtp_mailer_valid_address($kjsm_test_to))
    {
        $kjsm_alert      = kj_smtp_mailer_word('KJ_SMTP_MAILER_TEST_BAD_ADDRESS');
        $kjsm_alert_role = 'danger';
    }
    else
    {
        $kjsm_error = null;

        $kjsm_sent = kj_smtp_mailer_send(
            $config,
            $kjsm_test_to,
            kj_smtp_mailer_word('KJ_SMTP_MAILER_TEST_BODY'),
            kj_smtp_mailer_word('KJ_SMTP_MAILER_TEST_SUBJECT'),
            $kjsm_site_mail,
            $kjsm_site_name,
            '',
            $kjsm_error,
        );

        if ($kjsm_sent)
        {
            $kjsm_alert      = kj_smtp_mailer_word('KJ_SMTP_MAILER_TEST_OK');
            $kjsm_alert_role = 'success';
        }
        else
        {
            //the reason is the whole point of this page, so unlike a live send
            //it is shown rather than filed away in the log
            $kjsm_alert = kj_smtp_mailer_word('KJ_SMTP_MAILER_TEST_FAILED') . ' ' .
                htmlspecialchars((string) $kjsm_error, ENT_QUOTES);

            $kjsm_alert_role = 'danger';
        }
    }
}

$kjsm_preset_list = [];

foreach (kj_smtp_mailer_presets() as $kjsm_key => $kjsm_preset)
{
    $kjsm_preset_list[] = kj_smtp_mailer_preset_display($kjsm_key, $kjsm_preset);
}

//addslashes first: the attribute parser turns &#039; back into a bare quote
//before the javascript string is read, which would end it early
$kjsm_preset_confirm = htmlspecialchars(
    addslashes(kj_smtp_mailer_word('KJ_SMTP_MAILER_PRESETS_CONFIRM')),
    ENT_QUOTES,
);

//the template prints these raw
$kjsm_server     = htmlspecialchars($kjsm_server, ENT_QUOTES);
$kjsm_encryption = htmlspecialchars($kjsm_encryption, ENT_QUOTES);
$kjsm_sender     = htmlspecialchars($kjsm_sender, ENT_QUOTES);
$kjsm_login      = htmlspecialchars($kjsm_login, ENT_QUOTES);
$kjsm_test_to    = htmlspecialchars($kjsm_test_to, ENT_QUOTES);
