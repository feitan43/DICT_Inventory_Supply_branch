@extends('admin.app')

@section('content')
<body style="background: #11101d;">
    <div class="container-fluid uom-section">
      <div class="row justify-content-center">
        <div class="col-md-8">
          <div class="card">
            <div class="card-header">{{ __('Unit of Measures') }}</div>
            <div class="col-auto d-flex align-items-center ms-auto">
              <div class="d-flex">
                @can('category-create')
                <a href="{{ route('unit_of_measures.create') }}" role="button" class="btn fs-6 btn-primary btn-sm me-3">
                  <i class="bi bi-plus-lg" style="margin-right: 5px;"></i>
                  {{ __('Add Unit of Measure') }}
                </a>
                @endcan
              </div>
            </div>
            <div class="card-body">
              @if (session('success'))
              <div class="alert alert-success">
                {{ session('success') }}
              </div>
              @endif
  
              <table class="table">
                <thead>
                  <tr>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Abbreviation') }}</th>
                    <th>{{ __('Actions') }}</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($unitsOfMeasure as $unitOfMeasure)
                  <tr>
                    <td>{{ $unitOfMeasure->name }}</td>
                    <td>{{ $unitOfMeasure->abbreviation }}</td>
                    <td>
                      <a href="{{ route('unit_of_measures.edit', $unitOfMeasure) }}" class="btn btn-primary btn-sm">{{ __('Edit') }}</a>
                      <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#deleteModal-{{ $unitOfMeasure->id }}">
                        {{ __('Delete') }}
                      </button>
                      <!-- Delete Confirmation Modal -->
                      <div class="modal fade" id="deleteModal-{{ $unitOfMeasure->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="deleteModalLabel">{{ __('Delete Unit of Measure') }}</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                              <p>{{ __('Are you sure you want to delete this unit of measure?') }}</p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('Cancel') }}</button>
                              <form action="{{ route('unit_of_measures.destroy', $unitOfMeasure) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- End Delete Confirmation Modal -->
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  
    <!-- Initialize DataTables -->
    <script>
      $(document).ready(function () {
        $('.table').DataTable();
      });
    </script>
  </body>
  @endsection