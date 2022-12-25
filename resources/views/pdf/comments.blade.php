<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>

<head>
  <meta http-equiv="Content-Type" content="charset=utf-8" />
  <style type="text/css">
    * {
      font-family: "DejaVu Sans Mono", monospace;
    }
  </style>
</head>

<div>
    Wszystkie komentarze: {{ $comments->count() }}
</div>

<hr style="margin-top: 50px;">
@foreach ($comments as $comment)
    <!-- General stats about comments -->
    @if ($comment->user)
        Nazwa uzytkownika: {{ $comment->user->name }}
    @else
        Nazwa uzytkownika: Anonim
    @endif
    <br>
    Treść komentarza: {{ $comment->body }}
    <hr>

    
@endforeach