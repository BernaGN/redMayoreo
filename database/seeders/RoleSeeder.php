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
        $permission = Permission::create(['name' => 'usuarios.store', 'description' => 'Agregar Usuarios'])->assignRole($admin);
        $permission = Permission::create(['name' => 'usuarios.update', 'description' => 'Modificar Usuario'])->assignRole($admin);
        $permission = Permission::create(['name' => 'usuarios.destroy', 'description' => 'Eliminar Usuario'])->assignRole($admin);

        $permission = Permission::create(['name' => 'roles.index', 'description' => 'Ver Lista de Roles'])->assignRole($admin);
        $permission = Permission::create(['name' => 'roles.store', 'description' => 'Agregar rol'])->assignRole($admin);
        $permission = Permission::create(['name' => 'roles.update', 'description' => 'Modificar rol'])->assignRole($admin);
        $permission = Permission::create(['name' => 'roles.destroy', 'description' => 'Eliminar rol'])->assignRole($admin);

        $permission = Permission::create(['name' => 'proveedores.index', 'description' => 'Ver Lista de Proveedores'])->syncRoles([$admin, $operador]);
        $permission = Permission::create(['name' => 'proveedores.store', 'description' => 'Agregar proveedor'])->assignRole($admin);
        $permission = Permission::create(['name' => 'proveedores.update', 'description' => 'Modificar proveedor'])->assignRole($admin);
        $permission = Permission::create(['name' => 'proveedores.destroy', 'description' => 'Eliminar proveedor'])->assignRole($admin);

        $permission = Permission::create(['name' => 'clientes.index', 'description' => 'Ver Lista de Clientes'])->syncRoles([$admin, $operador]);
        $permission = Permission::create(['name' => 'clientes.store', 'description' => 'Agregar Clientes'])->assignRole($admin);
        $permission = Permission::create(['name' => 'clientes.update', 'description' => 'Modificar Clientes'])->assignRole($admin);
        $permission = Permission::create(['name' => 'clientes.destroy', 'description' => 'Eliminar Clientes'])->assignRole($admin);

        $permission = Permission::create(['name' => 'productos.index', 'description' => 'Ver Lista de Productos'])->syncRoles([$admin, $operador]);
        $permission = Permission::create(['name' => 'productos.store', 'description' => 'Agregar Productos'])->assignRole($admin);
        $permission = Permission::create(['name' => 'productos.update', 'description' => 'Modificar Productos'])->assignRole($admin);
        $permission = Permission::create(['name' => 'productos.destroy', 'description' => 'Eliminar Productos'])->assignRole($admin);

        $permission = Permission::create(['name' => 'series.index', 'description' => 'Ver Lista de Series Entregadas'])->syncRoles([$admin, $operador]);
        $permission = Permission::create(['name' => 'series.store', 'description' => 'Agregar Serie'])->assignRole($admin);
        $permission = Permission::create(['name' => 'series.update', 'description' => 'Modificar Serie'])->assignRole($admin);
        $permission = Permission::create(['name' => 'series.destroy', 'description' => 'Eliminar Serie'])->assignRole($admin);
    }
}
