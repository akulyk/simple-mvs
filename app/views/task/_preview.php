
<table class="table">
    <thead>
        <th>User Name</th>
        <th>User Email</th>
        <th>Task</th>
        <th>Image</th>
    </thead>
    <tbody>
        <tr>
            <td><?=$data->name;?></td>
            <td><?=$data->email;?></td>
            <td><?=$data->task;?></td>
            <td><a class="fancybox-new" href="<?=$data->image;?>" >
                <img src="<?=$data->image;?>" class="img-thumbnail small">
                </a>
            </td>
        </tr>
    </tbody>
</table>