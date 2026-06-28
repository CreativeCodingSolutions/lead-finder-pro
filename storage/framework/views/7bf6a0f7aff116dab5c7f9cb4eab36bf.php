<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email bestätigen — LeadFinderPro</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f9fafb; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="max-width: 600px; margin: 0 auto; padding: 40px 20px;">
        <tr>
            <td style="text-align: center; padding-bottom: 30px;">
                <h1 style="font-size: 24px; font-weight: 700; color: #111827; margin: 0;">LeadFinderPro</h1>
            </td>
        </tr>
        <tr>
            <td style="background: #ffffff; border-radius: 8px; padding: 40px; border: 1px solid #e5e7eb;">
                <h2 style="font-size: 20px; font-weight: 600; color: #111827; margin: 0 0 16px 0;">
                    Bestätigen Sie Ihre Email-Adresse
                </h2>
                <p style="font-size: 14px; color: #6b7280; margin: 0 0 24px 0; line-height: 1.6;">
                    Vielen Dank für Ihr Interesse an LeadFinderPro! Um Ihren Lead-Report zu erhalten, bestätigen Sie bitte Ihre Email-Adresse durch Klick auf den folgenden Button:
                </p>
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0">
                    <tr>
                        <td style="text-align: center; padding: 20px 0;">
                            <a href="<?php echo e($verifyUrl); ?>" style="display: inline-block; background-color: #4f46e5; color: #ffffff; text-decoration: none; padding: 12px 32px; border-radius: 6px; font-size: 14px; font-weight: 600;">
                                Email bestätigen
                            </a>
                        </td>
                    </tr>
                </table>
                <p style="font-size: 12px; color: #9ca3af; margin: 24px 0 0 0; line-height: 1.5;">
                    Dieser Link ist 24 Stunden gültig. Falls Sie keine Anfrage gestellt haben, ignorieren Sie diese Email bitte.
                </p>
                <p style="font-size: 12px; color: #9ca3af; margin: 16px 0 0 0; line-height: 1.5;">
                    Wenn der Button nicht funktioniert, kopieren Sie diesen Link in Ihren Browser:<br>
                    <a href="<?php echo e($verifyUrl); ?>" style="color: #4f46e5; word-break: break-all;"><?php echo e($verifyUrl); ?></a>
                </p>
            </td>
        </tr>
        <tr>
            <td style="text-align: center; padding-top: 24px;">
                <p style="font-size: 12px; color: #9ca3af; margin: 0;">
                    © <?php echo e(date('Y')); ?> LeadFinderPro. Ein Projekt von CreativeCodingSolutions.
                </p>
                <p style="font-size: 12px; color: #9ca3af; margin: 8px 0 0 0;">
                    <a href="https://leadfinderpro.creativecoding.cloud/datenschutz" style="color: #6b7280;">Datenschutz</a> &middot;
                    <a href="https://leadfinderpro.creativecoding.cloud/impressum" style="color: #6b7280;">Impressum</a>
                </p>
            </td>
        </tr>
    </table>
</body>
</html>
<?php /**PATH /opt/data/founder/apps/lead-finder-pro/resources/views/emails/lead-verify.blade.php ENDPATH**/ ?>