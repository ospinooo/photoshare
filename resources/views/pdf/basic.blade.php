<h1>{{$title}}</h1>
<table class="table table-striped table-hover table-users">
  <thead>
    <tr>
    @foreach (array_keys($data[0]->getAttributes()) as $title)
      @if ($title != 'password')
        <th class="hidden-phone">{{$title}}</th>
      @endif
    @endforeach
    </tr>
  </thead>

  <tbody>
    @foreach ($data as $model)
      <tr>
        @foreach ($model->getAttributes() as $key => $value)
          @if ($key != 'password')
            <td class="hidden-phone">{{$value}}</td>
          @endif
        @endforeach
      </tr>
    @endforeach
  </tbody>
</table>
