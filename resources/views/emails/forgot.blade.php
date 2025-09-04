
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8" />
        <title>Recuperación de Contraseña</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta content="Tailwind CSS Saas & Software Landing Page Template" name="description" />
        <meta name="author" content="Shreethemes" />
        <meta name="website" content="https://shreethemes.in" />
        <meta name="email" content="support@shreethemes.in" />
        <meta name="version" content="1.0.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <!-- favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico" />
        <!-- Font -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">
    </head>
    <body style="font-family: Nunito, sans-serif; font-size: 15px; font-weight: 400;">
        <!-- Hero Start -->
        <div style="margin-top: 50px;">
            <table cellpadding="0" cellspacing="0" style="font-family: Nunito, sans-serif; font-size: 15px; font-weight: 400; max-width: 600px; border: none; margin: 0 auto; border-radius: 6px; overflow: hidden; background-color: #fff; box-shadow-sm: 0 0 3px rgba(60, 72, 88, 0.15);">
                <thead>
                    <tr style="padding: 3px 0; line-height: 68px; text-align: center; color: #fff; font-size: 24px; font-weight: 700; letter-spacing: 1px;">
                        <th scope="col"><img src="{{ asset('assets/img/logo.png') }}" alt="Logo"></th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td style="padding: 48px 24px 0; color: #161c2d; font-size: 18px; font-weight: 600;">
                           Hola {{ $user->name }}
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 15px 24px 15px; color: #8492a6;">
                           Un gusto saludarte, se ha pedido un código de recuperación para acceder a tu cuenta en AhiTeVoy
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 15px 24px;">
                            <a href="" style="padding: 8px 20px; outline: none; text-decoration: none; font-size: 25px; letter-spacing: 0.5px; transition: all 0.3s; font-weight: 600; border-radius: 6px; background-color: #4f46e5; border: 1px solid #4f46e5; color: #ffffff;">
                                {{ $otp }}
                            </a>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 15px 24px 0; color: #8492a6;">
                           Recuerda, si no lo has solicitado haz caso omiso a este mensaje y te recomendamos hacer un cambio en tu contraseña.
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 15px 24px 15px; color: #8492a6;">
                            Equipo de <br> AhiTeVoy
                        </td>
                    </tr>

                    <tr>
                        <td style="padding: 16px 8px; color: #8492a6; background-color: #f8f9fc; text-align: center;">
                            © <script>document.write(new Date().getFullYear())</script> AhiTeVoy.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <!-- Hero End -->
    </body>
</html>