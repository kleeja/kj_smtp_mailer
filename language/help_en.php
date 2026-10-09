<?php
//
// kj_smtp_mailer, its guide on the help page of the control panel
// English
//
// The guide is built by the admin_help_guides hook in init.php, the texts here can have HTML.
//  - a list is numbered: KJ_SMTP_MAILER_HELP_TIP_1, KJ_SMTP_MAILER_HELP_TIP_2 ... it ends at the first missing number,
//    so an item can be added or removed without touching the code
//  - KJ_SMTP_MAILER_HELP_{LIST}_TITLE is the title of the list, a list without it takes the title that Kleeja gives its type
//  - questions and answers are KJ_SMTP_MAILER_HELP_FAQ_Q_1 and KJ_SMTP_MAILER_HELP_FAQ_A_1
//  - names in <strong> are written as the control panel shows them: the words of Kleeja are in lang/en/,
//    the words of the plugin in kj_smtp_mailer_translations() of functions.php
//

return [
    'KJ_SMTP_MAILER_HELP_TITLE' => 'SMTP Mailer',
    'KJ_SMTP_MAILER_HELP_INTRO' =>
        'Send the mail of your site through an SMTP server of your own instead of the PHP mail function. Each message signs in to a real mailbox, which keeps password recovery messages and your replies out of spam folders, and works on hosts that block the PHP mail function.',

    //
    // what the plugin does
    //
    'KJ_SMTP_MAILER_HELP_FEATURE_1' =>
        'Sends every message of Kleeja: password recovery, your replies from <strong>Messages</strong> and <strong>Reports</strong>, and the alerts about new messages and reports.',
    'KJ_SMTP_MAILER_HELP_FEATURE_2' =>
        'The <strong>Ready-made setups</strong> tab fills in the server settings of Hostinger or Gmail in one click.',
    'KJ_SMTP_MAILER_HELP_FEATURE_3' =>
        'The <strong>Status and test</strong> tab shows whether the plugin sends the mail of the site, lists what is still missing, and sends a test message. When the server refuses the test, the page shows the reason that the server gives.',
    'KJ_SMTP_MAILER_HELP_FEATURE_4' =>
        'Until its settings are complete, the plugin leaves the mail alone, and Kleeja keeps sending it with the PHP mail function.',
    'KJ_SMTP_MAILER_HELP_FEATURE_5' =>
        'The alerts about new messages and reports carry the address of the visitor. The plugin sends them from your own address, and adds the address of the visitor as the reply address, so that you can answer the visitor directly.',
    'KJ_SMTP_MAILER_HELP_FEATURE_6' =>
        'Messages keep the design of the mail of Kleeja, with a plain text version for mail apps that don\'t show HTML.',

    //
    // how to use it
    //
    'KJ_SMTP_MAILER_HELP_STEP_TITLE' => 'Set up SMTP Mailer',
    'KJ_SMTP_MAILER_HELP_STEP_1' =>
        'Create a mailbox for the site at your host or mail provider, such as <code>noreply@yourdomain.com</code>, and note its SMTP server, port, username and password.',
    'KJ_SMTP_MAILER_HELP_STEP_2' =>
        'If your provider is on the <strong>Ready-made setups</strong> tab of the <strong>SMTP Mailer</strong> page, click <strong>Use these settings</strong> on its card.',
    'KJ_SMTP_MAILER_HELP_STEP_3' =>
        'Open <strong>Settings</strong>, then <strong>SMTP Mailer</strong>. Fill in the fields that are still empty, as the list below explains, and click <strong>Update Settings</strong>.',
    'KJ_SMTP_MAILER_HELP_STEP_4' =>
        'On the <strong>Status and test</strong> tab, check that the page says that site mail is going out through your SMTP server.',
    'KJ_SMTP_MAILER_HELP_STEP_5' =>
        'Enter your own address in <strong>Send to</strong>, click <strong>Send test</strong>, and check that the message arrives in your inbox.',

    //
    // the settings, on the SMTP Mailer tab of the settings page
    //
    'KJ_SMTP_MAILER_HELP_SETTING_TITLE' => 'The settings',
    'KJ_SMTP_MAILER_HELP_SETTING_1' =>
        '<strong>From Mail</strong> and <strong>From Name</strong>: the address and the name that your messages are sent from. Most servers accept only the address of the mailbox that signs in, or an address of the same domain.',
    'KJ_SMTP_MAILER_HELP_SETTING_2' =>
        '<strong>Always send as this address</strong> and <strong>Always send under this name</strong>: when <strong>Yes</strong>, every message is sent from the address and the name above. When <strong>No</strong>, a message is sent from the address and the name that Kleeja gives it, which are those of the visitor for the alerts about new messages and reports.',
    'KJ_SMTP_MAILER_HELP_SETTING_3' => '<strong>SMTP Host</strong>: the address of the mail server, such as <code>smtp.gmail.com</code>.',
    'KJ_SMTP_MAILER_HELP_SETTING_4' =>
        '<strong>SMTP Port</strong> and <strong>SMTP Encryption</strong>: use port 587 with <strong>TLS</strong>, or port 465 with <strong>SSL</strong>. An empty port means 465 with <strong>SSL</strong> and 587 otherwise. <strong>None</strong> still encrypts the connection when the server supports it.',
    'KJ_SMTP_MAILER_HELP_SETTING_5' =>
        '<strong>SMTP Authentication</strong>: keep it on <strong>Yes</strong>, unless your server accepts mail from your site without a sign-in.',
    'KJ_SMTP_MAILER_HELP_SETTING_6' =>
        '<strong>SMTP Username</strong> and <strong>SMTP Password</strong>: the sign-in of the mailbox. The username is usually the full email address.',

    //
    // common questions
    //
    'KJ_SMTP_MAILER_HELP_FAQ_Q_1' => 'The Status and test tab says that the site mail still uses the PHP mail function. Why?',
    'KJ_SMTP_MAILER_HELP_FAQ_A_1' =>
        'The settings are not complete yet, and the page lists what is missing: <strong>SMTP Host</strong>, <strong>From Mail</strong>, or <strong>SMTP Username</strong> and <strong>SMTP Password</strong> while <strong>SMTP Authentication</strong> is on. If it says that the PHPMailer library is missing, install the plugin again from its release archive: a copy of the source code of the plugin doesn\'t include it.',
    'KJ_SMTP_MAILER_HELP_FAQ_Q_2' => 'The test fails with "Could not authenticate". What should I check?',
    'KJ_SMTP_MAILER_HELP_FAQ_A_2' =>
        'The server refused the username or the password. Enter the full email address as <strong>SMTP Username</strong>, and enter the password again. Gmail doesn\'t accept the password of the account here: turn on 2-Step Verification in your Google account, create an App Password, and enter it as <strong>SMTP Password</strong>.',
    'KJ_SMTP_MAILER_HELP_FAQ_Q_3' => 'The test fails with "Could not connect to SMTP host". What should I check?',
    'KJ_SMTP_MAILER_HELP_FAQ_A_3' =>
        'Kleeja couldn\'t reach the server. Check <strong>SMTP Host</strong>, and check that <strong>SMTP Port</strong> and <strong>SMTP Encryption</strong> belong together: 587 with <strong>TLS</strong>, 465 with <strong>SSL</strong>. Many hosts block outgoing mail ports. Try the other port, or ask your host to open it. A blocked port can make the test wait up to 30 seconds before it fails.',
    'KJ_SMTP_MAILER_HELP_FAQ_Q_4' => 'The server accepted the test, but the message didn\'t arrive. Why?',
    'KJ_SMTP_MAILER_HELP_FAQ_A_4' =>
        'Look in the spam folder first. Then check that <strong>From Mail</strong> is the address of the mailbox that signs in, or an address of the same domain, and that the domain has SPF and DKIM records. Your host or mail provider explains how to add them.',
    'KJ_SMTP_MAILER_HELP_FAQ_Q_5' => 'Where can I see why a message of the site wasn\'t sent?',
    'KJ_SMTP_MAILER_HELP_FAQ_A_5' =>
        'In the PHP error log of your server, on a line that begins with <code>kj_smtp_mailer:</code>. It has the reason that the server gave and a part of the address. The content of the message isn\'t written there, since it can hold a new password.',

    //
    // beside the guide
    //
    'KJ_SMTP_MAILER_HELP_TIP_1' =>
        'Send mail from a mailbox made for the site, such as <code>noreply@yourdomain.com</code>, rather than your personal address.',
    'KJ_SMTP_MAILER_HELP_TIP_2' => 'After you change a setting, send a test message again.',
    'KJ_SMTP_MAILER_HELP_TIP_3' =>
        'Free mail accounts, like Gmail, send a limited number of messages each day. For a busy site, use the mailbox of your host or a mail delivery service.',

    'KJ_SMTP_MAILER_HELP_WARNING_1' =>
        'A ready-made setup replaces <strong>SMTP Host</strong>, <strong>SMTP Port</strong>, <strong>SMTP Encryption</strong> and <strong>SMTP Authentication</strong>. Your sender, username and password stay as they are.',
    'KJ_SMTP_MAILER_HELP_WARNING_2' =>
        'Kleeja saves <strong>SMTP Password</strong> in its database as it is. Use a password that no other account shares.',
    'KJ_SMTP_MAILER_HELP_WARNING_3' =>
        'Set <strong>Always send as this address</strong> to <strong>No</strong> only if your server accepts any sender. Otherwise the alerts about new messages and reports are refused or end up in spam.',
    'KJ_SMTP_MAILER_HELP_WARNING_4' =>
        'Only a founder can open the <strong>SMTP Mailer</strong> page, since it sends mail and changes the server settings.',

    //
    // in the guide of the settings, whose page has the tab of the plugin
    //
    'KJ_SMTP_MAILER_HELP_NOTE' =>
        'The <strong>SMTP Mailer</strong> tab belongs to the <strong>SMTP Mailer</strong> plugin, which sends the mail of the site through your own mail server. <a href="#help-kj_smtp_mailer">Read its guide</a>.',
];
