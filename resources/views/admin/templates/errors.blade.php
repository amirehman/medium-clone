@if (count($errors))
      <ul>
        @foreach ($errors->all() as $error)
        <li class="text-red-dark">{{ $error }}</li>
        @endforeach
      </ul>
@endif
