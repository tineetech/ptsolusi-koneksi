<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>{{ $subjekBalasan }}</title>
</head>
<body style="margin:0;padding:0;background-color:#f1f5f9;font-family:Arial,Helvetica,sans-serif;color:#334155;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" style="background-color:#f1f5f9;padding:24px 0;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellpadding="0" cellspacing="0" style="width:100%;max-width:600px;background-color:#ffffff;border-radius:12px;overflow:hidden;">
                    <tr>
                        <td style="background-color:#4338ca;padding:20px 28px;color:#ffffff;font-size:18px;font-weight:bold;">
                            PT Solusi Koneksi
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:28px;">
                            <img src="{{ asset(\App\Models\Cms::branding()['primary']) ?? asset('images/logo-sk1.png') }}" alt="PT Solusi Koneksi"
                                 style="display:block;height:48px;width:auto;margin:0 0 20px;">
                            <p style="margin:0 0 16px;font-size:14px;">Halo {{ $pesan->nama }},</p>

                            <div style="font-size:14px;line-height:1.7;white-space:pre-line;">{{ $isiBalasan }}</div>

                            <hr style="border:none;border-top:1px solid #e2e8f0;margin:24px 0;">

                            <p style="margin:0 0 8px;font-size:12px;color:#94a3b8;">Pesan yang Anda kirim:</p>
                            <p style="margin:0 0 4px;font-size:13px;color:#475569;"><strong>Subjek:</strong> {{ $pesan->subjek }}</p>
                            <p style="margin:0;font-size:13px;line-height:1.6;color:#475569;white-space:pre-line;">{{ $pesan->pesan }}</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:16px 28px;background-color:#f8fafc;font-size:12px;color:#94a3b8;">
                            Email ini dikirim otomatis dari website PT Solusi Koneksi.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
