<table>
    <thead class="bg-success">
        <th></th>
        <th>Role</th>
        <th>Registro</th>
        <th>Actualizado</th>
        <th>Activo</th>
        <th></th>
        <th></th>
        <th></th>
    </thead>

    <tbody>
        <?php foreach ($users as $user) { ?>
            <tr>
                <td>
                    <a href="<?=base_url() . route_to('admin_panel_user_show', $user->id)?>">
                        <div>
                            <div><?=$user->name . " " . $user->firstname . " " . $user->lastname?></div>
                            <div><?=$user->email?></div>
                        </div>
                    </a>
                </td>
                <td><?=$user->role?></td>
                <td><?=$user->created_at?></td>
                <td><?=$user->updated_at?></td>
                <td><?=$user->active?></td>
                <td><a href="<?=base_url() . route_to('admin_panel_user_edit', $user->id)?>">edit</a></td>
                <td><a href="<?=base_url() . route_to('admin_panel_user_delete', $user->id)?>">delete</a></td>
                <td></td>
            </tr>
        <?php } ?>
    </tbody>
</table>