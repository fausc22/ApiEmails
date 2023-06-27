<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';

//CONFIGURACION DE MAILS: LINEA 73



$mail = new PHPMailer(true);
//configuracion PHPMailer
$mail->SMTPDebug = 0;
$mail->isSMTP();
$mail->Host = 'api.rsoftware.com.ar';
$mail->SMTPAuth = true;
$mail->Port = 587;
$mail->SMTPSecure = false;
$mail->SMTPAutoTLS = false;


//CONFIGURACION USUARIO Y CONTRASEÑA DEL MAIL GERENTE
$mail->Username = 'info@rsoftware.com.ar';
$mail->Password = 'nxzOwLLNB7';





//CONFIGURACION MAIL GERENTE TIENE QUE SER IGUAL AL DE ARRIBA
$mail->setFrom('info@rsoftware.com.ar', 'R SOFTWARE');


try {
    
    //DECODIFICACION DEL JSON
    $jsonData = file_get_contents('php://input');
    $data = json_decode($jsonData, true);
    
    





    if(!empty($data)){
        //ciclo para leer el JSON
        foreach ($data as $row) {
            // Leo todos los valores del JSON y los convierto en variables
            $categoria_email = isset($row['categoria_email']) ? $row['categoria_email'] : '';
            $cliente_email = isset($row['cliente_email']) ? $row['cliente_email'] : '';
            $cierre = isset($row['cierre']) ? $row['cierre'] : '';
            $usuario = isset($row['Usuario']) ? $row['Usuario'] : '';
            $ingreso = isset($row['ingreso']) ? $row['ingreso'] : '';
            $salida = isset($row['salida']) ? $row['salida'] : '';
            $retiros_caja = isset($row['retiros_caja']) ? $row['retiros_caja'] : '';
            $retiros_proveedor = isset($row['retiros_proveedor']) ? $row['retiros_proveedor'] : '';
            $ingreso_efectivo = isset($row['ingreso_efectivo']) ? $row['ingreso_efectivo'] : '';
            $devoluciones = isset($row['devoluciones']) ? $row['devoluciones'] : '';
            $declarado = isset($row['declarado']) ? $row['declarado'] : '';
            $copia_email = isset($row['copia_mail']) ? $row['copia_mail'] : '';
            $diferencia = isset($row['diferencia']) ? $row['diferencia'] : '';
            $tick_cant = isset($row['tick_cant']) ? $row['tick_cant'] : '';
            $art_cant = isset($row['art_cant']) ? $row['art_cant'] : '';
            $art_prom = isset($row['art_prom']) ? $row['art_prom'] : '';
            $tick_prom = isset($row['tick_prom']) ? $row['tick_prom'] : '';
            $total_efectivo = isset($row['total_efectivo']) ? $row['total_efectivo'] : '';
            $total_cta_cte = isset($row['total_cta_cte']) ? $row['total_cta_cte'] : '';
            $total_compra = isset($row['total_compra']) ? $row['total_compra'] : '';
            $cliente_nro = isset($row['cliente_nro']) ? $row['cliente_nro'] : '';
            $cliente_nombre = isset($row['cliente_nombre']) ? $row['cliente_nombre'] : '';
            $nombre_cliente = isset($row['nombre_cliente']) ? $row['nombre_cliente'] : '';
            $direccion = isset($row['direccion']) ? $row['direccion'] : '';
            $cupo = isset($row['cupo']) ? $row['cupo'] : '';
            $usado = isset($row['usado']) ? $row['usado'] : '';
            $saldo_actual = isset($row['saldo_actual']) ? $row['saldo_actual'] : '';
            $codigo = isset($row['codigo']) ? $row['codigo'] : '';
            $precio_actual = isset($row['precio_actual']) ? $row['precio_actual'] : '';
            $precio_nuevo = isset($row['precio_nuevo']) ? $row['precio_nuevo'] : '';
            $user = isset($row['user']) ? $row['user'] : '';
            $nro_cajaZ = isset($row['nro_cajaZ']) ? $row['nro_cajaZ'] : '';
            $mensaje = isset($row['mensaje']) ? $row['mensaje'] : '';
            $total_caja = isset($row['Total_caja']) ? $row['Total_caja'] : '';
            $nro_cierreX = isset($row['nro_cierreX']) ? $row['nro_cierreX'] : '';
            $fecha = isset($row['fecha']) ? $row['fecha'] : '';
            $hora = isset($row['hora']) ? $row['hora'] : '';
            $efectivo_gral = isset($row['efectivo_gral']) ? $row['efectivo_gral'] : '';
            $cuerpo = isset($row['cuerpo']) ? $row['cuerpo'] : '';
            $cliente = isset($row['Cliente']) ? $row['Cliente'] : '';
            $version = isset($row['version']) ? $row['version'] : '';
            $id_cliente = isset($row['id_cliente']) ? $row['id_cliente'] : '';
            $pdf = isset($row['pdf']) ? $row['pdf'] : '';
            
            
            
            
            


            

            //VARIABLE DEL MAIL AL QUE SE VA A ENVIAR
            $mail->addAddress($cliente_email);
            if(!empty($copia_email)){
                $mail->addCC($copia_email);
            }
            
                
            

            

            




            //condicional para determinar el tipo de correo
            if($categoria_email == 'cierreX'){
                //llamo el HTML y lo completo conlas variables
                $template = file_get_contents('plantillas_html/cierreX.html');
                //imagen para el HTML
                
                $mail->AddEmbeddedImage('img/CierreX.jpg', 'cierreX_id', 'CierreX.jpg', 'base64', 'image/jpeg');

                $medios = $data[0]['Medios'];

                $rows = '';
                foreach($medios as $key => $value){
                    $rowData = '<tr>';
                    $rowData .= '<td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">' . $key . '</td>';
                    $rowData .= '<td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 13px; font-weight: 400; line-height: 24px; padding: 5px 10px;">$' . $value . '</td>';
                    $rowData .= '</tr>';
                    $rows .= $rowData;
                }

    


                $template = str_replace('{{cierre}}', $cierre, $template);
                $template = str_replace('{{usuario}}', $usuario, $template);
                $template = str_replace('{{ingreso}}', $ingreso, $template);
                $template = str_replace('{{salida}}', $salida, $template);
                $template = str_replace('{{retiros_caja}}', $retiros_caja, $template);
                $template = str_replace('{{retiros_proveedor}}', $retiros_proveedor, $template);
                $template = str_replace('{{ingreso_efectivo}}', $ingreso_efectivo, $template);
                $template = str_replace('{{devoluciones}}', $devoluciones, $template);
                $template = str_replace('{{declarado}}', $declarado, $template);
                $template = str_replace('{{diferencia}}', $diferencia, $template);
                $template = str_replace('{{tick_cant}}', $tick_cant, $template);
                $template = str_replace('{{art_cant}}', $art_cant, $template);
                $template = str_replace('{{art_prom}}', $art_prom, $template);
                $template = str_replace('{{tick_prom}}', $tick_prom, $template);
                $template = str_replace('%data%', $rows, $template);
                $template = str_replace('{{total_caja}}', $total_caja, $template);

                //contenido
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'CIERRE DE CAJA X N: ' . $cierre;
                $mail->Body = $template;



            } elseif($categoria_email == 'cierreZ'){
                $template = file_get_contents('plantillas_html/cierreZ.html');
                
                $mail->AddEmbeddedImage('img/CierreZ.jpg', 'cierreX_id', 'CierreZ.jpg', 'base64', 'image/jpeg');

                $medios = $data[0]['Medios'];

                $rows = '';
                foreach($medios as $key => $value){
                    $rowData = '<tr>';
                    $rowData .= '<td width="25%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 16px; font-weight: 400; line-height: 24px; padding: 5px 10px;">' . $key . '</td>';
                    $rowData .= '<td width="75%" align="left" style="font-family: Open Sans, Helvetica, Arial, sans-serif; font-size: 13px; font-weight: 400; line-height: 24px; padding: 5px 10px;">$' . $value . '</td>';
                    $rowData .= '</tr>';
                    $rows .= $rowData;
                }

                
                $template = str_replace('{{retiros_caja}}', $retiros_caja, $template);
                $template = str_replace('{{retiros_proveedor}}', $retiros_proveedor, $template);
                $template = str_replace('{{ingreso_efectivo}}', $ingreso_efectivo, $template);
                $template = str_replace('{{devoluciones}}', $devoluciones, $template);
                $template = str_replace('{{tick_cant}}', $tick_cant, $template);
                $template = str_replace('{{art_cant}}', $art_cant, $template);
                $template = str_replace('{{art_prom}}', $art_prom, $template);
                $template = str_replace('{{tick_prom}}', $tick_prom, $template);
                $template = str_replace('%data%', $rows, $template);
                $template = str_replace('{{total_caja}}', $total_caja, $template);
                $template = str_replace('{{efectivo_gral}}', $efectivo_gral, $template);

                //contenido
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'INFORME CIERRE Z';
                $mail->Body = $template;
            
                
                
            } elseif($categoria_email == 'compra_cta_cte'){
                $template = file_get_contents('plantillas_html/compra_cta_cte.html');

                
                $mail->AddEmbeddedImage('img/compra.png', 'cierreX_id', 'compra.png', 'base64', 'image/png');

                $template = str_replace('{{total_compra}}', $total_compra, $template);
                $template = str_replace('{{cliente_nro}}', $cliente_nro, $template);
                $template = str_replace('{{cliente_nombre}}', $cliente_nombre, $template);
                $template = str_replace('{{direccion}}', $direccion, $template);
                $template = str_replace('{{cupo}}', $cupo, $template);
                $template = str_replace('{{usado}}', $usado, $template);
                $template = str_replace('{{saldo_actual}}', $saldo_actual, $template);

                //contenido
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'COMPRA CTA CTE';
                $mail->Body = $template;
            


            } elseif($categoria_email == 'cobro_cta_cte'){
                $template = file_get_contents('plantillas_html/cobro_cta_cte.html');
                $mail->AddEmbeddedImage('img/cobro.jpg', 'cierreX_id', 'conbro.jpg', 'base64', 'image/jpeg');

                $template = str_replace('{{total_compra}}', $total_compra, $template);
                $template = str_replace('{{cliente_nro}}', $cliente_nro, $template);
                $template = str_replace('{{cliente_nombre}}', $cliente_nombre, $template);
                $template = str_replace('{{direccion}}', $direccion, $template);
                $template = str_replace('{{cupo}}', $cupo, $template);
                $template = str_replace('{{usado}}', $usado, $template);
                $template = str_replace('{{saldo_actual}}', $saldo_actual, $template);

                //contenido
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'COBRO CTA CTE';
                $mail->Body = $template;

            } elseif($categoria_email == 'cambio_precio'){
                $template = file_get_contents('plantillas_html/notificacion_cambio_precio.html');

                
                $mail->AddEmbeddedImage('img/cambio_precio.png', 'cierreX_id', 'cambio_precio.png', 'base64', 'image/png');

                $template = str_replace('{{usuario}}', $usuario, $template);
                $template = str_replace('{{codigo}}', $codigo, $template);
                $template = str_replace('{{precio_actual}}', $precio_actual, $template);
                $template = str_replace('{{precio_nuevo}}', $precio_nuevo, $template);
                

                //contenido
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Notificacion / TPV';
                $mail->Body = $template;


            } elseif($categoria_email == 'ingreso_cajero'){
                $template = file_get_contents('plantillas_html/ingreso_cajero.html');

                
                $mail->AddEmbeddedImage('img/cajero.jpg', 'cierreX_id', 'cajero.jpg', 'base64', 'image/jpeg');

                $template = str_replace('{{usuario}}', $usuario, $template);
                $template = str_replace('{{user}}', $user, $template);
                $template = str_replace('{{nro_cajaZ}}', $nro_cajaZ, $template);
                $template = str_replace('{{nro_cierreX}}', $nro_cierreX, $template);
                $template = str_replace('{{fecha}}', $fecha, $template);
                $template = str_replace('{{hora}}', $hora, $template);
                
                

                //contenido
                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'Informe Ingreso Cajero';
                $mail->Body = $template;
                
            } elseif($categoria_email == 'cumpleanios'){
                $template = file_get_contents('plantillas_html/cumpleanios.html');

                $mail->addEmbeddedImage('img/birthday.jpg', 'birthday_id', 'birthday.jgp', 'base64', 'image/jpeg');

                $template = str_replace('{{nombre_cliente}}', $nombre_cliente, $template);
                $template = str_replace('{{mensaje}}', $mensaje, $template);

                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'FELIZ CUMPLEAÑOS!';
                $mail->Body = $template;
            } elseif($categoria_email == 'comprobante'){
                $contenidoPDF = base64_decode($pdf);
                file_put_contents('archivo.pdf', $contenidoPDF);
                $mail->addStringAttachment($contenidoPDF, 'comprobante.pdf');


                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'COMPROBANTE DE VENTA';
                $mail->Body = 'COMPROBANTE DE VENTA';
            } elseif($categoria_email == 'soporte'){
                $template = file_get_contents('plantillas_html/soporte.html');
                $contenidoTXT = base64_decode($mensaje);
                file_put_contents('archivo.txt', $contenidoTXT);
                $mail->AddEmbeddedImage('img/BugSend.png', 'cierreX_id', 'BugSend.png', 'base64', 'image/png');

                $template = str_replace('{{cliente}}', $cliente, $template);
                $template = str_replace('{{fecha}}', $fecha, $template);
                $template = str_replace('{{version}}', $version, $template);
                $template = str_replace('{{id_cliente}}', $id_cliente, $template);
                $template = str_replace('{{usuario}}', $usuario, $template);

                $mail->addStringAttachment($contenidoTXT, 'error.txt');

                $mail->isHTML(true);
                $mail->CharSet = 'UTF-8';
                $mail->Subject = 'REPORTE DE ERROR';
                $mail->Body = $template;
            }







        }
            
    
        } 
    

    
    
        if($mail->send()){
            echo 'El correo se ha enviado correctamente';
            if(file_exists('archivo.pdf')){
                unlink('archivo.pdf');
            }
        
            if(file_exists('archivo.txt')){
                unlink('archivo.txt');
            }
            
        }   
    


} catch (Exception $e){
    echo 'Hubo un error al enviar el mensaje: ', $mail->ErrorInfo;
}

?>