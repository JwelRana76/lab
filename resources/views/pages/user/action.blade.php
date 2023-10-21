
<button type="button" class="btn btn-sm btn-primary mr-2" data-id="{{ $item->id }}" data-toggle="modal" data-target="#set_role">
    <i class="fas fa-fw fa-parachute-box"></i>
</button>
<a href="{{ route('user.edit',$item->id) }}" class="btn btn-sm btn-primary mr-2"><i class="fas fa-fw fa-pen-square"></i></a>
<a href="{{ route('user.delete',$item->id) }}" onclick="return confirm('Are you sure to delete this record')" class="btn btn-sm btn-primary mr-2 bg-danger"><i class="fas fa-fw fa-trash"></i></a>
