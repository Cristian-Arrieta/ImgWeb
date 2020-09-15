<div class="modal fade" id="editComment{{$comment->id}}">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				
				<h4>Edit Comment</h4>
				
				<button type="button" class="close" data-dismiss="modal">
					<span>&times;</span>
				</button>
			</div>
			{!!Form::model($comment,['route' =>['comments.update',$comment->id],'method'=>'PUT'])!!}
			<div class="modal-body">
				
					<div class="form-group">
						{{Form::label('Comment')}}
						{{Form::textarea('text',null,['class'=>'form-control'])}}
						
					</div>
								
			</div>
			<div class="modal-footer">
				<input type="submit" class="btn btn-primary" value="Guardar">
			</div>
			{!! Form::close() !!}	
		</div>
	</div>
</div>	