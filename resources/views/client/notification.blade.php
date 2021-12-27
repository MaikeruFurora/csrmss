@extends('../layoutClient/app')
@section('content')
@include('administrator/partial/DeleteConfirmation')
<section class="section">

    <div class="section-body">
        <h2 class="section-title">NOTIFICATION</h2>
       <div class="row">
            <div class="col-lg-12 col-md-12 col-sm 12">
                <div class="card">
                    
                    <div class="card-body">
                        <table class="table table-bordered">
                            @forelse (auth()->user()->notifications()->get() as $item)
                            <tr class="@if ($item->read_at == null) bg-secondary @else  @endif">
                                <td>
                                    <i class="fas {{ $item->data['request']['icon'] }}"></i> &nbsp;
                                    {{ $item->data['request']['bodyMessage'] }}
                                    <span class="float-right">{{ $item->created_at->diffForHumans() }}</span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td class="text-center">No notifcation</td>
                            </tr>
                            @endforelse
                        </table>
                    </div>
                </div>
            </div>
       </div>
    </div>
</section>
@endsection