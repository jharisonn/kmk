<!DOCTYPE html>
<html>
<head>
</head>
<body>
  <form method="post" enctype="multipart/form-data" action="{{route("create_agenda")}}">
    {{ csrf_field() }}
    <input type="text" name="title" /> <br />
    <input type="file" name="picture"/>
    <button type="submit">Upload</button>
  </form>
</body>
</html>
