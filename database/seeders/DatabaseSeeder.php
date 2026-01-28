<?php
//http://127.0.0.1:8001/login
namespace Database\Seeders; 

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use Spatie\Permission\Models\Role; //Importante para Spatie
use Spatie\Permission\Models\Permission;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */

    public function run(): void
    {
        // 1. Creación de Roles y Permisos
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);

        $createPost = Permission::create(['name' => 'create post']);
        $editPost = Permission::create(['name' => 'edit post']);
        $deletePost = Permission::create(['name' => 'delete post']);

        $admin->givePermissionTo([$createPost, $editPost, $deletePost]);
        $editor->givePermissionTo($editPost);

        // 2. Crear usuarios y asignar roles directamente
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'password' => Hash::make('12345678'), // <--- Ponemos la misma
        ]);

        $userNerea = User::factory()->create([
            'name' => 'Nerea Fernandez',
            'email' => 'nerea_fernandez@cifpzonzamas.es',
            'password' => Hash::make('12345678'),
        ]);

        // Asignamos el rol a la variable directamente, sin buscar por ID
        $userNerea->assignRole($admin);

        // 3. ¡LLAMAR A TUS LIBROS!
        $this->call([
            LibroSeeder::class,
        ]);
    }

    /*
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        navegador: /dashboard 
        User::factory()->create([
            'name' => 'Nerea Fernandez',
            'email' => 'nerea_fernandez@cifpzonzamas.es',
            'password' => Hash::make('12345678'),
        ]);


        //Ejemplo de creacion de roles y permisos con Spatie
        $admin = Role::create(['name' => 'admin']);
        $editor = Role::create(['name' => 'editor']);

        $createPost = Permission::create(['name' => 'create post']);
        $editPost = Permission::create(['name' => 'edit post']);
        $deletePost = Permission::create(['name' => 'delete post']);

        $admin->givePermissionTo($createPost, $editPost, $deletePost);
        $editor->givePermissionTo($editPost);

        $user = User::find(2); // Asignar rol admin a Nerea Fernandez
        $user->assignRole('admin');

    }
    */
}
