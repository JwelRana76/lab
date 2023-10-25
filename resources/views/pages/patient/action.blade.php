<!-- Default dropleft button -->
<div class="btn-group dropleft">
    <button type="button" class="action-button dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
        <i class="fas fa-fw fa-ellipsis-v"></i>
    </button>
    <div class="dropdown-menu">
        <a class="dropdown-item" href="{{ route('patient.edit',$item->id) }}"><i class="fa fa-fw fa-pen-square"></i> Edit</a>
        <a class="dropdown-item" href="{{ route('patient.upload_document',$item->id) }}"><i class="fa fa-fw fa-file"></i> Upload Document</a>
        <a class="dropdown-item" href="{{ route('patient.view',$item->id) }}"><i class="fa fa-fw fa-eye"></i> View Details</a>
        <a class="dropdown-item" href="{{ route('patient.delete',$item->id) }}" onclick="return confirm('Are you sure to Delete this record..??')"><i class="fa fa-fw text-danger fa-trash"></i> Delete</a>
    </div>  
</div>
