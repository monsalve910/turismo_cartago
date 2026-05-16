<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservación Aprobada</title>
</head>
<body style="margin:0;padding:0;background-color:#f3f4f6;font-family:Arial,sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center" style="padding:40px 20px;">
                <table width="560" cellpadding="0" cellspacing="0" style="background-color:#ffffff;border-radius:16px;overflow:hidden;">
                    <tr>
                        <td align="center" style="padding:40px 30px 20px;">
                            <div style="width:64px;height:64px;background-color:#d1fae5;border-radius:50%;display:inline-flex;align-items:center;justify-content:center;margin-bottom:16px;">
                                <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2">
                                    <path d="M5 13l4 4L19 7"/>
                                </svg>
                            </div>
                            <h1 style="font-size:24px;color:#1f2937;margin:0 0 8px;">¡Reservación Aprobada!</h1>
                            <p style="font-size:16px;color:#6b7280;margin:0 0 24px;">
                                Tu reservación para <strong style="color:#1f2937;"><?php echo e($reservacion->tour->nombre); ?></strong> ha sido aprobada automáticamente.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:0 30px 24px;">
                            <table width="100%" cellpadding="0" cellspacing="0" style="background-color:#f9fafb;border-radius:12px;">
                                <tr>
                                    <td style="padding:20px;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td style="padding-bottom:12px;">
                                                    <p style="font-size:12px;color:#9ca3af;margin:0;">Tour</p>
                                                    <p style="font-size:14px;color:#1f2937;font-weight:600;margin:2px 0 0;"><?php echo e($reservacion->tour->nombre); ?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="padding-bottom:12px;">
                                                    <p style="font-size:12px;color:#9ca3af;margin:0;">Fecha</p>
                                                    <p style="font-size:14px;color:#1f2937;font-weight:600;margin:2px 0 0;"><?php echo e(\Carbon\Carbon::parse($reservacion->fecha_reservacion)->format('d/m/Y')); ?></p>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <p style="font-size:12px;color:#9ca3af;margin:0;">Personas</p>
                                                    <p style="font-size:14px;color:#1f2937;font-weight:600;margin:2px 0 0;"><?php echo e($reservacion->cantidad_personas); ?></p>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding:0 30px 40px;">
                            <a href="<?php echo e(route('reservaciones.index')); ?>" style="display:inline-block;background-color:#059669;color:#ffffff;padding:12px 24px;border-radius:12px;text-decoration:none;font-weight:600;font-size:14px;">
                                Ver mis reservaciones
                            </a>
                        </td>
                    </tr>
                </table>
                <p style="font-size:12px;color:#9ca3af;margin-top:20px;">Turismo Cartago &copy; <?php echo e(date('Y')); ?></p>
            </td>
        </tr>
    </table>
</body>
</html>
<?php /**PATH C:\Users\apesi\turismo-cartago\resources\views/emails/reservacion-aprobada.blade.php ENDPATH**/ ?>