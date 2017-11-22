@extends('partials._main')

@section('title', '| View User')

@section('content')

	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<h3>User: <b>{{ $user->name }}</b></h3>		
			</div>
			<div class="col-md-4" align="right">
				<a href="{{ route('users.index') }}" class="btn btn-info btn-xs">Back</a>				
				<a href="{{ route('users.edit', $user->id) }}" class="btn btn-success btn-xs">Edit</a>
				<a href="{{ route('users.delete', $user->id) }}" class="btn btn-danger btn-xs">Delete</a>				
			</div>
		</div>	

		<div class="well">
			<dl class="dl-horizontal">
				<dt>Id:</dt>
				<dd>{{ $user->id }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Name:</dt>
				<dd>{{ $user->name }}</dd>
			</dl>			
			<dl class="dl-horizontal">
				<dt>Email:</dt>
				<dd>{{ $user->email }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Active:</dt>
				<dd>
					@if ($user->active==true)
						<button type="button" class="btn btn-xs btn-info">Active</button>
					@else
						<button type="button" class="btn btn-xs btn-danger">Inactive</button>
					@endif
				</dd>
			</dl>			
			<dl class="dl-horizontal">
				<dt>Role:</dt>
				<dd>{{ $user->hasRole->name }}</dd>	
			</dl>	
			<dl class="dl-horizontal">
                <dt>Avatar:</dt>
                <dd>
                    @if (! empty($user->avatar))
                        <img src="{{ asset('images/' . $user->avatar) }}" max-height="300px" max-width="200px">
                    @endif
                </dd>
            </dl>
			<dl class="dl-horizontal">
				<dt>Created at:</dt>
				<dd>{{ $user->created_at }}</dd>
			</dl>
			<dl class="dl-horizontal">
				<dt>Last update:</dt>
				<dd>{{ $user->updated_at }}</dd>
			</dl>
		</div>
	</div>
	<div>
	    <div role="tabpanel" class="container">
	        <!-- Nav tabs -->
	        <ul class="nav nav-tabs" role="tablist">
	            <li role="presentation" class="active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"><b>News</b></a></li>
	            <li role="presentation"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab"><b>Posts</b></a></li>
	        </ul>
	        <!-- Tab panes -->
	        <div class="tab-content">
	            <div role="tabpanel" class="tab-pane active" id="tab1">
	                <div class="container">
	                    @if (count($news))
							<table class="table-condensed table-striped table-hover">
								<thead class="thead-inverse">
									<th class="text-right">#&nbsp</th>
									<th>Title</th>
									<th>Body</th>
									<th class="text-center">Active</th>				
									<th>Creator</th>
									<th>Category</th>					
									<th>Created at</th>
									<th>Updated at</th>				
								</thead>
								<tbody>
									@foreach ($news as $newz)
										<tr class="table-tr" data-url="{{ route('news.show', $newz->id) }}">
											<td align="right">{{ $newz->id }}&nbsp</td>
											<td>{{ substr(strip_tags($newz->title), 0, 70) }}{{ strlen(strip_tags($newz->title)) > 70 ? "..." : "" }}</td>
											<td>{{ substr(strip_tags($newz->post), 0, 50) }}{{ strlen(strip_tags($newz->post)) > 50 ? "..." : "" }}</td>
											<td align="center">
												@if ( $newz->active==1 )
													<button type="button" class="btn btn-xs btn-info">Active</button>
												@else
													<button type="button" class="btn btn-xs btn-danger">Inactive</button>
												@endif
											</td>
											<td>{{ $newz->isCreator->name }}</td>
											<td>{{ substr(strip_tags($newz->newsCategory->name), 0, 30) }}{{ strlen(strip_tags($newz->newsCategory->name)) > 30 ? "..." : "" }}</td>
											<td>{{ $newz->created_at }}</td>
											<td>{{ $newz->updated_at }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
	                    @endif
	                </div>            
	            </div>
	            <div role="tabpanel" class="tab-pane active" id="tab2">
	                <div class="container">
	                </div>            
	            </div>            
	        </div>        
	    </div>
	</div>
@endsection

@section('scripts')
<script type="text/javascript">
$(function() {
  $('table.table-condensed').on("click", "tr.table-tr", function() {
    window.location = $(this).data("url");
  });
});
</script>
@endsection