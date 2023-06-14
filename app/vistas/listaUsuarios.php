<?php
ob_start();
?>
<main>
    <div id="cajaListaUsers">
        <div id="busqueda">
            <h1><a id="iconoVolverLisUsers" href="index.php?action=OpcionesAdmim"><i class="fa-solid fa-circle-left"></i></a>Lista de Usuarios</h1>
            <div id="parte1">
                Buscar por
                <select name="atributo" id="filtro">
                    <option value="id" selected>Id</option>
                    <option value="usuario">Usuario</option>
                    <option value="email">Correo electrónico</option>
                    <option value="nombre">Nombre</option>
                    <option value="dni">DNI</option>
                    <option value="telefono">Teléfono</option>
                    <option value="poblacion">Población</option>
                    <option value="rol">Rol</option>
                    <option value="estado">Estado</option>
                </select>
                <input type="text" id="buscador">
            </div>
            <div id="parte2">
                <button class="btn btn-primary" id="btnRegistrarUsuario">Registrar usuario</button>
            </div>
        </div>

        <table id="tabla">
            <tr class="fondoAzulTabla">
                <th>Id</th>
                <th>Usuario</th>
                <th>Correo electrónico</th>
                <th>Nombre</th>
                <th>DNI</th>
                <th>Teléfono</th>
                <th>Población</th>
                <th>Rol</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
            <?php foreach ($usuarios as $user) : ?>
                <tr id="<?= $user->getId() ?>" class="userFiltro">
                    <td><?= $user->getId() ?></td>
                    <?php if ($user->getUsuario() == "") : ?>
                        <td>No registrado</td>
                    <?php else : ?>
                        <td><?= $user->getUsuario() ?></td>
                    <?php endif; ?>
                    <td><?= $user->getEmail() ?></td>
                    <td><?= $user->getNombre() ?></td>
                    <td><?= $user->getDni() ?></td>
                    <td><?= $user->getTelefono() ?></td>
                    <td><?= $user->getPoblacion() ?></td>
                    <?php if ($user->getId() == $_SESSION['idUsuario']) : ?>
                        <td>
                            Administrador
                        </td>
                        <td>
                            <?= $user->getEstado() ?>
                        </td>
                        <td class="fondoAzulTabla">
                            <i class="fa-solid fa-user-pen editar" title="Editar usuario"></i>
                        </td>
                    <?php else : ?>
                        <?php if ($user->getRol() == "admin") : ?>
                            <td>
                                <select name="rol" class="select">
                                    <option value="admin" selected>Administrador</option>
                                    <option value="user">Usuario</option>
                                </select>
                            </td>
                        <?php else : ?>
                            <td>
                                <select name="rol" class="select">
                                    <option value="admin">Administrador</option>
                                    <option value="user" selected>Usuario</option>
                                </select>
                            </td>
                        <?php endif; ?>
                            
                        <?php if ($user->getEstado() == "activo") : ?>
                            <td>
                                <select name="estado" class="select">
                                    <option value="activo" selected>Activo</option>
                                    <option value="inactivo">Inactivo</option>
                                </select>
                            </td>
                        <?php else : ?>
                            <td>
                                <select name="estado" class="select">
                                    <option value="activo">Activo</option>
                                    <option value="inactivo" selected>Inactivo</option>
                                </select>
                            </td>
                        <?php endif; ?>
                        <td class="fondoAzulTabla">
                            <i class="fa-solid fa-user-pen editar" title="Editar usuario"></i>
                            <i class="fa-solid fa-user-slash borrar" title="Borrar usuario"></i>
                        </td>
                    <?php endif; ?>

                    
                </tr>
            <?php endforeach; ?>
        </table>
        <a href="index.php?action=OpcionesAdmim">Volver</a>
    </div>
</main>

<?php
$vista = ob_get_clean();

require 'app/vistas/plantilla.php';
