<!DOCTYPE html>
<html lang="es" dir="ltr">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Código de acceso - AhiTeVoy</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f0f2f5; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased;">

    <!-- Wrapper -->
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f0f2f5; padding: 40px 16px;">
        <tr>
            <td align="center">

                <!-- Card -->
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width: 560px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.10);">

                    <!-- Header gradient -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #1a1a2e 0%, #16213e 50%, #0f3460 100%); padding: 36px 40px 32px; text-align: center;">
                            <!-- Logo placeholder — reemplaza con tu URL real -->
                            <div style="display:inline-block; background: rgba(255,255,255,0.12); border-radius: 12px; padding: 10px 24px; margin-bottom: 20px;">
                                <span style="color: #ffffff; font-size: 22px; font-weight: 800; letter-spacing: 1px;">📍 AhiTeVoy</span>
                            </div>
                            <p style="margin: 0; color: rgba(255,255,255,0.65); font-size: 13px; letter-spacing: 0.5px; text-transform: uppercase;">Verificación de cuenta</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 40px 40px 32px;">

                            <!-- Greeting -->
                            <p style="margin: 0 0 8px; font-size: 24px; font-weight: 700; color: #1a1a2e;">
                                Hola, {{ $user->name }} 👋
                            </p>
                            <p style="margin: 0 0 28px; font-size: 15px; color: #64748b; line-height: 1.6;">
                                Recibimos una solicitud para recuperar el acceso a tu cuenta en <strong style="color: #1a1a2e;">AhiTeVoy</strong>. Usa el código de un solo uso que aparece a continuación para continuar.
                            </p>

                            <!-- OTP Box -->
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="center" style="padding: 8px 0 32px;">
                                        <div style="display: inline-block; background: linear-gradient(135deg, #1a1a2e, #0f3460); border-radius: 14px; padding: 2px;">
                                            <div style="background: #ffffff; border-radius: 12px; padding: 24px 48px; text-align: center;">
                                                <p style="margin: 0 0 4px; font-size: 11px; font-weight: 600; color: #94a3b8; letter-spacing: 2px; text-transform: uppercase;">Tu código OTP</p>
                                                <p style="margin: 0; font-size: 42px; font-weight: 800; letter-spacing: 10px; color: #0f3460;">{{ $otp }}</p>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>

                            <!-- Expiry notice -->
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td style="background-color: #fff7ed; border-left: 4px solid #f97316; border-radius: 0 8px 8px 0; padding: 12px 16px; margin-bottom: 28px;">
                                        <p style="margin: 0; font-size: 13px; color: #9a3412;">
                                            ⚠️ &nbsp;Este código es de <strong>un solo uso</strong>. Si no lo solicitaste, ignora este correo y considera cambiar tu contraseña.
                                        </p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 24px 0 0; font-size: 14px; color: #64748b; line-height: 1.6;">
                                Con gusto,<br>
                                <strong style="color: #1a1a2e;">El equipo de AhiTeVoy</strong>
                            </p>
                        </td>
                    </tr>

                    <!-- Divider -->
                    <tr>
                        <td style="padding: 0 40px;">
                            <div style="height: 1px; background-color: #e2e8f0;"></div>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="padding: 24px 40px 32px; text-align: center;">
                            <p style="margin: 0 0 8px; font-size: 12px; color: #94a3b8;">
                                Este correo fue enviado automáticamente. Por favor no respondas a este mensaje.
                            </p>
                            <p style="margin: 0; font-size: 12px; color: #cbd5e1;">
                                &copy; {{ date('Y') }} AhiTeVoy &mdash; Todos los derechos reservados.
                            </p>
                        </td>
                    </tr>

                </table>
                <!-- /Card -->

            </td>
        </tr>
    </table>

</body>
</html>