<img src="{{asset('uploads/'.$event->image)}}" />
<form method="post" action="{{url()->current()}}" enctype="multipart/form-data">
  {{ csrf_field() }}
<input name="title" type="text" value="{{$event->title}}" /> <br />
<input name="picture" type="file" />
<button type="submit">Edit!</button>
</form>
