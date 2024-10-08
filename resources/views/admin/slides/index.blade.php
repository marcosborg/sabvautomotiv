@extends('layouts.admin')
@section('content')
@can('slide_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.slides.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.slide.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.slide.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Slide">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.slide.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.slide.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.slide.fields.subtitle') }}
                        </th>
                        <th>
                            {{ trans('cruds.slide.fields.button') }}
                        </th>
                        <th>
                            {{ trans('cruds.slide.fields.link') }}
                        </th>
                        <th>
                            {{ trans('cruds.slide.fields.image') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($slides as $key => $slide)
                        <tr data-entry-id="{{ $slide->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $slide->id ?? '' }}
                            </td>
                            <td>
                                {{ $slide->title ?? '' }}
                            </td>
                            <td>
                                {{ $slide->subtitle ?? '' }}
                            </td>
                            <td>
                                {{ $slide->button ?? '' }}
                            </td>
                            <td>
                                {{ $slide->link ?? '' }}
                            </td>
                            <td>
                                @if($slide->image)
                                    <a href="{{ $slide->image->getUrl() }}" target="_blank" style="display: inline-block">
                                        <img src="{{ $slide->image->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('slide_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.slides.show', $slide->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('slide_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.slides.edit', $slide->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('slide_delete')
                                    <form action="{{ route('admin.slides.destroy', $slide->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('slide_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.slides.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-Slide:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection