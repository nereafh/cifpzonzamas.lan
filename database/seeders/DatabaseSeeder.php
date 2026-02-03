<?php

/*
http://127.0.0.1:8001/login
 */
namespace Database\Seeders;

use App\Models\User;
use App\Models\Libro;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Vehiculo;


use App\Models\Socio;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // LIMPIAR CACHÉ DE PERMISOS (Muy importante para evitar errores de Spatie)
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // CREAR USUARIOS
        
        // Usuario Normal (para probar que NO puede entrar a libros)
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('12345678'),
        ]);

        // TU USUARIO (Administradora)
        $userNerea = User::factory()->create([
            'name' => 'Nerea Fernandez',
            'email' => 'nerea_fernandez@cifpzonzamas.es',
            'password' => Hash::make('12345678'),
        ]);

        // NUEVO USUARIO (Juan - Administrador)
        $userJuan = User::factory()->create([
            'name' => 'Juan',
            'email' => 'juan@cifpzonzamas.es',
            'password' => Hash::make('12345678'),
        ]);

        // CREAR LIBROS 
        $libros = [
            ['titulo' => 'El eco del silencio', 'autor' => 'María López', 'anho' => '2001', 'genero' => 'NV', 'descripcion' => 'Una H íntima sobre recuerdos y decisiones pasadas.'],
            ['titulo' => 'Sombras del futuro', 'autor' => 'Carlos Méndez', 'anho' => '2015', 'genero' => 'CF', 'descripcion' => 'La humanidad enfrenta las consecuencias de sus avances tecnológicos.'],
            ['titulo' => 'El último reino', 'autor' => 'Laura Fernández', 'anho' => '1998', 'genero' => 'FN', 'descripcion' => 'Un mundo mágico al borde de la destrucción.'],
            ['titulo' => 'Voces del pasado', 'autor' => 'Antonio Ruiz', 'anho' => '2007', 'genero' => 'H', 'descripcion' => 'Relatos que reconstruyen momentos olvidados.'],
            ['titulo' => 'La noche eterna', 'autor' => 'Sofía Navarro', 'anho' => '2020', 'genero' => 'T', 'descripcion' => 'El miedo se esconde donde menos se espera.'],
            ['titulo' => 'Cartas sin destino', 'autor' => 'Javier Morales', 'anho' => '2012', 'genero' => 'T', 'descripcion' => 'Una H de amor contada a través de cartas.'],
            ['titulo' => 'Más allá del horizonte', 'autor' => 'Elena Torres', 'anho' => '2005', 'genero' => 'NV', 'descripcion' => 'Un viaje que cambia la vida de sus protagonistas.'],
            ['titulo' => 'El código oculto', 'autor' => 'Miguel Santos', 'anho' => '2018', 'genero' => 'NV', 'descripcion' => 'Nada es lo que parece en este thriller tecnológico.'],
            ['titulo' => 'Cenizas del ayer', 'autor' => 'Patricia Gómez', 'anho' => '1995', 'genero' => 'NV', 'descripcion' => 'El pasado vuelve para exigir respuestas.'],
            ['titulo' => 'La ciudad invisible', 'autor' => 'Daniel Herrera', 'anho' => '2010', 'genero' => 'FN', 'descripcion' => 'Una ciudad que solo algunos pueden ver.'],
            ['titulo' => 'Fragmentos de verdad', 'autor' => 'Lucía Peña', 'anho' => '2003', 'genero' => 'FN', 'descripcion' => 'Reflexiones sobre la sociedad moderna.'],
            ['titulo' => 'El guardián del bosque', 'autor' => 'Raúl Castro', 'anho' => '1999', 'genero' => 'FN', 'descripcion' => 'Una antigua promesa protege el equilibrio natural.'],
            ['titulo' => 'Tiempo prestado', 'autor' => 'Isabel Romero', 'anho' => '2016', 'genero' => 'NV', 'descripcion' => 'Cada segundo cuenta cuando el tiempo se agota.'],
            ['titulo' => 'La ruta perdida', 'autor' => 'Fernando León', 'anho' => '2008', 'genero' => 'NV', 'descripcion' => 'Un mapa antiguo guía a lo desconocido.'],
            ['titulo' => 'Sueños de acero', 'autor' => 'Andrea Molina', 'anho' => '2021', 'genero' => 'CF', 'descripcion' => 'Robots y humanos luchan por coexistir.'],
            ['titulo' => 'El reflejo oscuro', 'autor' => 'Hugo Vidal', 'anho' => '2013', 'genero' => 'T', 'descripcion' => 'El verdadero monstruo vive dentro.'],
            ['titulo' => 'Palabras al viento', 'autor' => 'Carmen Salas', 'anho' => '1997', 'genero' => 'NV', 'descripcion' => 'Versos que exploran el alma humana.'],
            ['titulo' => 'La frontera del miedo', 'autor' => 'Óscar Núñez', 'anho' => '2019', 'genero' => 'NV', 'descripcion' => 'Cruzar la línea nunca fue tan peligroso.'],
            ['titulo' => 'Ecos del mar', 'autor' => 'Beatriz Ríos', 'anho' => '2004', 'genero' => 'NV', 'descripcion' => 'El océano guarda secretos profundos.'],
            ['titulo' => 'El pacto', 'autor' => 'Samuel Ortega', 'anho' => '2011', 'genero' => 'NV', 'descripcion' => 'Una decisión que cambia varias vidas.'],
            ['titulo' => 'Horizonte rojo', 'autor' => 'Natalia Cruz', 'anho' => '2022', 'genero' => 'CF', 'descripcion' => 'La colonización de Marte no sale como se esperaba.'],
            ['titulo' => 'El viajero inmóvil', 'autor' => 'Iván Pardo', 'anho' => '1996', 'genero' => 'NV', 'descripcion' => 'Un viaje interior sin moverse del sitio.'],
            ['titulo' => 'Sombras en la pared', 'autor' => 'Marta Aguilar', 'anho' => '2009', 'genero' => 'T', 'descripcion' => 'La casa esconde presencias inquietantes.'],
            ['titulo' => 'La melodía rota', 'autor' => 'Pablo Serrano', 'anho' => '2002', 'genero' => 'NV', 'descripcion' => 'La música como salvación y condena.'],
            ['titulo' => 'El sendero oculto', 'autor' => 'Rosa Valdés', 'anho' => '2014', 'genero' => 'NV', 'descripcion' => 'Un camino secreto lleva a una verdad inesperada.'],
            ['titulo' => 'Luz de invierno', 'autor' => 'Alberto Cano', 'anho' => '1994', 'genero' => 'T', 'descripcion' => 'Un amor que nace en el frío.'],
            ['titulo' => 'El umbral', 'autor' => 'Clara Méndez', 'anho' => '2017', 'genero' => 'NV', 'descripcion' => 'Una puerta que nunca debió abrirse.'],
            ['titulo' => 'Caminos cruzados', 'autor' => 'Diego Fuentes', 'anho' => '2006', 'genero' => 'NV', 'descripcion' => 'Hs que se entrelazan inesperadamente.'],
            ['titulo' => 'La última señal', 'autor' => 'Verónica Gil', 'anho' => '2023', 'genero' => 'CF', 'descripcion' => 'Una transmisión cambia el destino del planeta.'],
            ['titulo' => 'Memorias de polvo', 'autor' => 'Julián Reyes', 'anho' => '1993', 'genero' => 'H', 'descripcion' => 'El paso del tiempo contado desde el olvido.'],
        ];

        foreach ($libros as $item) {
            Libro::create($item);
        }

        // CONFIGURAR ROLES Y PERMISOS
        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'editor']);

        $createPermission = Permission::create(['name' => 'create post']);
        $editPermission = Permission::create(['name' => 'edit post']);
        $deletePermission = Permission::create(['name' => 'delete post']);

        $adminRole->givePermissionTo([$createPermission, $editPermission, $deletePermission]);
        $editorRole->givePermissionTo($editPermission);

        // ASIGNAR ROL ADMIN A NEREA Y A JUAN
        $userNerea->assignRole($adminRole);
        $userJuan->assignRole($adminRole);


        //SOCIOS
        $socios = [
            ['nombre' => 'Ana García', 'dni' => '12345678A', 'edad' => 25, 'categoria' => 'OR', 'iban' => 'ES1234567890123456789012'],
            ['nombre' => 'Juan Pérez', 'dni' => '87654321B', 'edad' => 42, 'categoria' => 'PL', 'iban' => 'ES9876543210987654321098'],
            ['nombre' => 'Elena Blanes', 'dni' => '11223344C', 'edad' => 31, 'categoria' => 'PR', 'iban' => 'ES1111222233334444555566'],
            ['nombre' => 'Marcos Soler', 'dni' => '55667788D', 'edad' => 19, 'categoria' => 'PL', 'iban' => 'ES5555666677778888999900'],
            ['nombre' => 'Lucía Martos', 'dni' => '99001122E', 'edad' => 55, 'categoria' => 'OR', 'iban' => 'ES9999000011112222333344'],
            ['nombre' => 'Ricardo Tormo', 'dni' => '33445566F', 'edad' => 28, 'categoria' => 'PR', 'iban' => 'ES3333444455556666777788'],
            ['nombre' => 'Sara Jiménez', 'dni' => '77889900G', 'edad' => 37, 'categoria' => 'OR', 'iban' => 'ES7777888899990000111122'],
            ['nombre' => 'Pedro Picazo', 'dni' => '22334455H', 'edad' => 64, 'categoria' => 'PL', 'iban' => 'ES2222333344445555666677'],
            ['nombre' => 'Marta Sánchez', 'dni' => '66778899I', 'edad' => 22, 'categoria' => 'PR', 'iban' => 'ES6666777788889999000011'],
            ['nombre' => 'Jorge Valls', 'dni' => '44556677J', 'edad' => 48, 'categoria' => 'OR', 'iban' => 'ES4444555566667777888899'],
        ];

        foreach ($socios as $socio) {
            Socio::create($socio);
        }

        //VEHICULOS
        $vehiculos = [
            ['marca' => 'Toyota', 'modelo' => 'Corolla', 'matricula' => '1234ABC', 'combustible' => 'EL', 'estado' => 'DI', 'anho' => '2021'],
            ['marca' => 'Seat', 'modelo' => 'Ibiza', 'matricula' => '5678DEF', 'combustible' => 'GA', 'estado' => 'AL', 'anho' => '2022'],
            ['marca' => 'Hyundai', 'modelo' => 'Tucson', 'matricula' => '9012GHI', 'combustible' => 'DI', 'estado' => 'TA', 'anho' => '2023'],
            ['marca' => 'Tesla', 'modelo' => 'Model 3', 'matricula' => '1122JKL', 'combustible' => 'EL', 'estado' => 'DI', 'anho' => '2021'],
            ['marca' => 'Renault', 'modelo' => 'Clio', 'matricula' => '3344MNO', 'combustible' => 'GA', 'estado' => 'DI', 'anho' => '2022'],
            ['marca' => 'Kia', 'modelo' => 'Sportage', 'matricula' => '5566PQR', 'combustible' => 'DI', 'estado' => 'AL', 'anho' => '2023'],
            ['marca' => 'Volkswagen', 'modelo' => 'Golf', 'matricula' => '7788STU', 'combustible' => 'GA', 'estado' => 'DI', 'anho' => '2021'],
            ['marca' => 'Peugeot', 'modelo' => '208', 'matricula' => '9900VWX', 'combustible' => 'EL', 'estado' => 'TA', 'anho' => '2022'],
            ['marca' => 'BMW', 'modelo' => 'Serie 1', 'matricula' => '2233YZA', 'combustible' => 'DI', 'estado' => 'DI', 'anho' => '2023'],
            ['marca' => 'Audi', 'modelo' => 'A3', 'matricula' => '4455BCD', 'combustible' => 'GA', 'estado' => 'AL', 'anho' => '2021'],
            ['marca' => 'Ford', 'modelo' => 'Focus', 'matricula' => '6677EFG', 'combustible' => 'DI', 'estado' => 'DI', 'anho' => '2022'],
            ['marca' => 'Mercedes', 'modelo' => 'Clase A', 'matricula' => '8899HIJ', 'combustible' => 'GA', 'estado' => 'DI', 'anho' => '2023'],
            ['marca' => 'Nissan', 'modelo' => 'Leaf', 'matricula' => '0011KLM', 'combustible' => 'EL', 'estado' => 'AL', 'anho' => '2021'],
            ['marca' => 'Dacia', 'modelo' => 'Sandero', 'matricula' => '2233NOP', 'combustible' => 'GA', 'estado' => 'TA', 'anho' => '2022'],
            ['marca' => 'Volvo', 'modelo' => 'XC40', 'matricula' => '4455QRS', 'combustible' => 'EL', 'estado' => 'DI', 'anho' => '2023'],
        ];

        foreach ($vehiculos as $vehiculo) {
            Vehiculo::create($vehiculo);
        }


        
    }



}

