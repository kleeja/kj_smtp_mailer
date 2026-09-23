**English** · [العربية](README.ar.md)

# Kleeja SMTP Mailer

Sends your Kleeja site's mail through an SMTP server you control instead of PHP's
`mail()` function. Messages sent this way authenticate as a real mailbox, which is
what keeps registration and password-reset mail out of spam folders.

Built on [PHPMailer](https://github.com/PHPMailer/PHPMailer).

## Install

Download the `kj_smtp_mailer-*.zip` attached to a [release](../../releases) and
install it from **Admin → Plugins**. The release archive bundles PHPMailer; a
plain clone of this repository does not, because `vendor/` is built at release
time.

If you do want to run it from a checkout:

```bash
composer install --no-dev
```

## Ready-made setups

**Admin → SMTP Mailer → Ready-made setups**

Hit **Use these settings** on your provider's card and the server half is filled
in for you. Applying a setup **overwrites your current SMTP host, port,
encryption and authentication**. It does not touch your sender address, username
or password.

Authentication is on in both setups, so one step is always left: go to
**Admin → Settings → SMTP Mailer**, enter the username and password of the
mailbox, and send yourself a test from **Status and test**.

### Hostinger

| | |
| --- | --- |
| SMTP Host | `smtp.hostinger.com` |
| SMTP Port | `465` |
| SMTP Encryption | SSL |
| SMTP Authentication | On |

Use an email account you created in hPanel (Emails → your domain). The username
is the full address, e.g. `noreply@yourdomain.com`.

### Gmail

| | |
| --- | --- |
| SMTP Host | `smtp.gmail.com` |
| SMTP Port | `587` |
| SMTP Encryption | TLS |
| SMTP Authentication | On |

> [!NOTE]
> SMTP has to be enabled on the Gmail account first. And with 2-step verification
> switched on, Google will not accept your normal password here — create an
> [App Password](https://support.google.com/accounts/answer/185833) and use that
> instead.

The username is your full Gmail address.

## Settings

**Admin → Settings → SMTP Mailer**

| Setting | Notes |
| --- | --- |
| From Mail | The address messages are sent as. Usually the mailbox you authenticate with. |
| Always send as this address | On by default. See *Sender handling* below. |
| From Name | Display name shown to recipients. |
| Always send under this name | On by default. |
| SMTP Host | e.g. `smtp.gmail.com` |
| SMTP Port | Leave empty to use 465 for SSL, 587 otherwise. |
| SMTP Encryption | `TLS` (STARTTLS) for port 587, `SSL` for port 465. |
| SMTP Authentication | Off only for a relay that accepts your server by IP. |
| SMTP Username / Password | Credentials for the mailbox. |

**Admin → SMTP Mailer** has two tabs of its own. *Ready-made setups* fills in the
server settings for a known hosting provider. *Status and test* shows whether the
plugin is actually handling site mail and lets you send yourself a test message —
the test takes the same path as real site mail, and when the server refuses it the
SMTP-level reason is shown on the page.

### Adding another provider

Presets live in one array in `functions.php`:

```php
function kj_smtp_mailer_presets(): array
{
    return [
        'gmail' => [
            'name'   => 'Gmail',
            'values' => [
                'kj_smtp_mailer_smtp_host'       => 'smtp.gmail.com',
                'kj_smtp_mailer_smtp_port'       => '587',
                'kj_smtp_mailer_smtp_encryption' => 'tls',
                'kj_smtp_mailer_authentication'  => '1',
            ],
            'note'   => 'KJ_SMTP_MAILER_PRESET_NOTE_GMAIL',
        ],
    ];
}
```

Add an entry and it shows up as its own card. A preset should only carry settings
that are the same for every account on that host — never the mailbox itself.

`note` is optional. It takes an `olang` key, shown on the card, for anything the
admin has to do on the provider's side before these settings will connect.

## Behaviour worth knowing

**It stays out of the way until it works.** Until the host, sender address and
credentials are all filled in, the plugin leaves mail alone and Kleeja keeps
using `mail()`. That also covers a missing `vendor/`. The status page tells you
which of these is the case.

**Sender handling.** Kleeja passes a sender address to every mail it sends, and
for the contact form and file reports that address is the *visitor's*, not the
site's. Relaying a stranger's address through your mailbox gets the message
dropped for SPF/DMARC reasons, so by default the plugin sends everything as your
configured address and puts the original one in `Reply-To` — replying to a
contact-form mail still reaches the visitor. Turn the two "Always send as"
switches off if your relay genuinely accepts arbitrary senders.

**Failures are not silent.** A refused message is written to the PHP error log
(and to `cache/kleeja_log.log` when `DEV_STAGE` is on) with the SMTP reason and a
masked recipient. The message body is never logged, because Kleeja puts freshly
generated passwords and activation links in it.

## Releasing

Tag a version and push it:

```bash
git tag v1.0 && git push origin v1.0
```

The [release workflow](.github/workflows/release.yml) lints the sources, runs
`build.sh`, and attaches the archive to the GitHub release. `build.sh` can also be
run locally:

```bash
./build.sh 1.0     # -> kj_smtp_mailer-1.0.zip
```

The archive must unpack to a folder named `kj_smtp_mailer`; Kleeja keys every hook
off the plugin's directory name.

### made with ❤ for kleeja ❣
