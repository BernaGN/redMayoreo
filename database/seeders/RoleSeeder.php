<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Role::create(['name' => 'Administrador']);
        $operador = Role::create(['name' => 'Operador']);

        $permission = Permission::create(['name' => 'home', 'description' => 'Ver el Dashboard'])->syncRoles([$admin, $operador]);

        $permission = Permission::create(['name' => 'usuarios.index', 'description' => 'Ver Lista de Usuarios'])->syncRoles([$admin, $operador]);
        $permission = Permission::create(['name' => 'usuarios.create', 'description' => 'Formulario de creacion de usuarios'])->assignRole($admin);
        $permission = Permission::create(['name' => 'usuarios.store', 'description' => 'Agregar Usuarios'])->assignRole($admin);
        $permission = Permission::create(['name' => 'usuarios.show', 'description' => 'Ver usuario'])->assignRole($admin);
        $permission = Permission::create(['name' => 'usuarios.edit', 'description' => 'Formulario de modificacion de usuarios'])->assignRole($admin);
        $permission = Permission::create(['name' => 'usuarios.update', 'description' => 'Modificar Usuario'])->assignRole($admin);
        $permission = Permission::create(['name' => 'usuarios.destroy', 'description' => 'Eliminar Usuario'])->assignRole($admin);

        $permission = Permission::create(['name' => 'roles.index', 'description' => 'Ver Lista de Roles'])->assignRole($admin);
        $permission = Permission::create(['name' => 'roles.create', 'description' => 'Formulario de creacion de roles'])->assignRole($admin);
        $permission = Permission::create(['name' => 'roles.store', 'description' => 'Agregar rol'])->assignRole($admin);
        $permission = Permission::create(['name' => 'roles.show', 'description' => 'Ver rol'])->assignRole($admin);
        $permission = Permission::create(['name' => 'roles.edit', 'description' => 'Formulario de modificacion de roles'])->assignRole($admin);
        $permission = Permission::create(['name' => 'roles.update', 'description' => 'Modificar rol'])->assignRole($admin);
        $permission = Permission::create(['name' => 'roles.destroy', 'description' => 'Eliminar rol'])->assignRole($admin);

        $permission = Permission::create(['name' => 'proveedores.index', 'description' => 'Ver Lista de Proveedores'])->syncRoles([$admin, $operador]);
        $permission = Permission::create(['name' => 'proveedores.create', 'description' => 'Formulario de creacion de proveedores'])->assignRole($admin);
        $permission = Permission::create(['name' => 'proveedores.store', 'description' => 'Agregar proveedor'])->assignRole($admin);
        $permission = Permission::create(['name' => 'proveedores.show', 'description' => 'Ver proveedor'])->assignRole($admin);
        $permission = Permission::create(['name' => 'proveedores.edit', 'description' => 'Formulario de modificacion de proveedores'])->assignRole($admin);
        $permission = Permission::create(['name' => 'proveedores.update', 'description' => 'Modificar proveedor'])->assignRole($admin);
        $permission = Permission::create(['name' => 'proveedores.destroy', 'description' => 'Eliminar proveedor'])->assignRole($admin);
    }
}
