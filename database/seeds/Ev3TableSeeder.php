<?php

use Illuminate\Database\Seeder;
use App\Ev3;
class Ev3TableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $statement = "ALTER TABLE introev3 AUTO_INCREMENT = 1;";
        DB::unprepared($statement);

        DB::table('introev3')->delete();
        #Accion  
        Ev3::create(array('id_menu'=>9,'ruta'=>'BloqueMotormediano.pdf',));
        Ev3::create(array('id_menu'=>10,'ruta'=>'BloqueMotorgrande.pdf',));
        Ev3::create(array('id_menu'=>11,'ruta'=>'BloqueMoverladirección.pdf',));
        Ev3::create(array('id_menu'=>12,'ruta'=>'BloqueMovertanque.pdf',));
        Ev3::create(array('id_menu'=>13,'ruta'=>'BloquePantalla.pdf',));
        Ev3::create(array('id_menu'=>14,'ruta'=>'BloqueSonido.pdf',));
        Ev3::create(array('id_menu'=>15,'ruta'=>'BloqueLuzdeestado.pdf',));
        #Sensores
        Ev3::create(array('id_menu'=>21,'ruta'=>'Bloque Sensor ultrasónico.pdf',));
        Ev3::create(array('id_menu'=>22,'ruta'=>'Bloque Sensor infrarrojo.pdf',));
        Ev3::create(array('id_menu'=>23,'ruta'=>'Bloque Girosensor.pdf',));
        Ev3::create(array('id_menu'=>24,'ruta'=>'Bloque Sensor de color.pdf',));
        Ev3::create(array('id_menu'=>25,'ruta'=>'Bloque Rotación del motor.pdf',));
        Ev3::create(array('id_menu'=>26,'ruta'=>'Bloque Sensor táctil.pdf',));
        Ev3::create(array('id_menu'=>27,'ruta'=>'Bloque Temporizador.pdf',));
        Ev3::create(array('id_menu'=>28,'ruta'=>'Bloque Botones del Bloque EV3.pdf',));
        Ev3::create(array('id_menu'=>29,'ruta'=>'Bloque Sensor de sonido NXT.pdf',));
        #Flujo
        Ev3::create(array('id_menu'=>16,'ruta'=>'Bloque de inicio.pdf',));
        Ev3::create(array('id_menu'=>17,'ruta'=>'Bloque Esperar.pdf',));
        Ev3::create(array('id_menu'=>18,'ruta'=>'Bloque de bucle.pdf',));
        Ev3::create(array('id_menu'=>19,'ruta'=>'Bloque Interruptor.pdf',));
        Ev3::create(array('id_menu'=>20,'ruta'=>'Bloque Interrupción del bucle.pdf',));
        #Datos
        Ev3::create(array('id_menu'=>30,'ruta'=>'Bloque Constante.pdf',));
        Ev3::create(array('id_menu'=>31,'ruta'=>'Bloque Variable.pdf',));
        Ev3::create(array('id_menu'=>32,'ruta'=>'Bloque Operaciones secuenciales.pdf',));
        Ev3::create(array('id_menu'=>33,'ruta'=>'Bloque Operaciones lógicas.pdf',));
        Ev3::create(array('id_menu'=>34,'ruta'=>'Bloque Matemática.pdf',));
        Ev3::create(array('id_menu'=>35,'ruta'=>'Bloque Redondear.pdf',));
        Ev3::create(array('id_menu'=>36,'ruta'=>'Bloque Comparar.pdf',));
        Ev3::create(array('id_menu'=>37,'ruta'=>'Bloque Alcance.pdf',));
        Ev3::create(array('id_menu'=>38,'ruta'=>'Bloque Texto.pdf',));
        Ev3::create(array('id_menu'=>39,'ruta'=>'Bloque Aleatorio.pdf',));
        #Avanzado
        Ev3::create(array('id_menu'=>40,'ruta'=>'Bloque Acceso al archivo.pdf',));
        Ev3::create(array('id_menu'=>41,'ruta'=>'Bloque Mandar mensajes.pdf',));
        Ev3::create(array('id_menu'=>42,'ruta'=>'Bloque Conexión Bluetooth.pdf',));
        Ev3::create(array('id_menu'=>43,'ruta'=>'Bloque Mantener activo.pdf',));
        Ev3::create(array('id_menu'=>44,'ruta'=>'Bloque Comentario.pdf',));
        Ev3::create(array('id_menu'=>45,'ruta'=>'Bloque Valor del sensor sin procesar.pdf',));
        Ev3::create(array('id_menu'=>46,'ruta'=>'Bloque Detener.pdf',));
        Ev3::create(array('id_menu'=>47,'ruta'=>'Bloque Invertir el motor.pdf',));
        Ev3::create(array('id_menu'=>48,'ruta'=>'Bloque Motor sin regular.pdf',));
    }
}
