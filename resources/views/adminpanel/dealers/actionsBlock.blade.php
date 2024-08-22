@can('dealers-delete')
   @php ($status_class ='fa fa-trash') @endphp
   <button class="btn-delete" value="{{ $id }}"><i class="{{ $status_class }}"></i></button>
 @endcan
